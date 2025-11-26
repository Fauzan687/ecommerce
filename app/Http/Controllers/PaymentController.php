<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Webhook;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['webhook']);
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Create Stripe Checkout Session
     */
    public function createCheckoutSession(Order $order)
    {
        // Pastikan user hanya bisa bayar ordernya sendiri
         if ($order->user_id != Auth::id()) {
        abort(403);
    }
 // Validasi stok sebelum pembayaran
    foreach ($order->orderItems as $item) {
        if ($item->product->stock < $item->quantity) {
            return redirect()->route('orders.show', $order)
                ->with('error', 'Stok produk "' . $item->product->name . '" tidak mencukupi.');
        }
    }
        // Check jika sudah ada payment pending/completed
        if ($order->payment && $order->payment->isCompleted()) {
            return redirect()->route('orders.show', $order)
                ->with('error', 'Pesanan ini sudah dibayar!');
        }

        try {
            // Prepare line items untuk Stripe
            $lineItems = [];
            
            foreach ($order->orderItems as $item) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'idr',
                        'product_data' => [
                            'name' => $item->product->name,
                            'description' => $item->product->description,
                        ],
                        'unit_amount' => (int)($item->price * 100), // Stripe uses cents
                    ],
                    'quantity' => $item->quantity,
                ];
            }

            // Create Stripe Checkout Session
            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('payment.success', ['order' => $order->id]) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('payment.cancel', ['order' => $order->id]),
                'customer_email' => Auth::user()?->email,
                'metadata' => [
                    'order_id' => $order->id,
                ],
            ]);

            // Create or update payment record
            Payment::updateOrCreate(
                ['order_id' => $order->id],
                [
                    'stripe_session_id' => $session->id,
                    'amount' => $order->total_amount,
                    'currency' => 'IDR',
                    'status' => 'pending',
                    'payment_method' => 'stripe',
                ]
            );

            // Update order
            $order->update([
                'payment_method' => 'stripe',
            ]);

            return redirect($session->url);
            
        } catch (\Exception $e) {
            Log::error('Stripe Checkout Error: ' . $e->getMessage());
            
            return redirect()->route('orders.show', $order)
                ->with('error', 'Terjadi kesalahan saat membuat pembayaran. Silakan coba lagi.');
        }
    }

    /**
     * Payment Success Handler
     */
    public function success(Request $request, Order $order)
    {
         if ($order->user_id != Auth::id()) {
        abort(403);
    }

        $sessionId = $request->query('session_id');

        if (!$sessionId) {
            return redirect()->route('orders.show', $order)
                ->with('error', 'Session tidak ditemukan.');
        }

        try {
            // Retrieve the session from Stripe
            $session = StripeSession::retrieve($sessionId);

            if ($session->payment_status === 'paid') {
                $payment = Payment::where('stripe_session_id', $sessionId)->first();
                
                if ($payment && $payment->isPending()) {
                    $payment->update([
                        'stripe_payment_id' => $session->payment_intent,
                        'status' => 'completed',
                        'paid_at' => now(),
                        'metadata' => json_encode($session),
                    ]);

                    $order->update([
                        'payment_status' => 'paid',
                        'status' => 'processing',
                    ]);
                }

                return view('payment.success', compact('order'));
            }

            return redirect()->route('orders.show', $order)
                ->with('error', 'Pembayaran belum selesai.');
                
        } catch (\Exception $e) {
            Log::error('Payment Success Error: ' . $e->getMessage());
            
            return redirect()->route('orders.show', $order)
                ->with('error', 'Terjadi kesalahan saat memverifikasi pembayaran.');
        }
    }

    /**
     * Payment Cancel Handler
     */
    public function cancel(Order $order)
    {
         if ($order->user_id != Auth::id()) {
        abort(403);
    }

        return view('payment.cancel', compact('order'));
    }

    /**
     * Stripe Webhook Handler
     */
    public function webhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $webhookSecret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $webhookSecret);
        } catch (\UnexpectedValueException $e) {
            Log::error('Webhook Error: Invalid payload');
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (SignatureVerificationException $e) {
            Log::error('Webhook Error: Invalid signature');
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                $this->handleCheckoutSessionCompleted($session);
                break;

            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                Log::info('Payment succeeded: ' . $paymentIntent->id);
                break;

            case 'payment_intent.payment_failed':
                $paymentIntent = $event->data->object;
                $this->handlePaymentFailed($paymentIntent);
                break;

            default:
                Log::info('Received unknown event type: ' . $event->type);
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Handle Checkout Session Completed
     */
    private function handleCheckoutSessionCompleted($session)
    {
        $payment = Payment::where('stripe_session_id', $session->id)->first();

        if ($payment && $payment->isPending()) {
            $payment->update([
                'stripe_payment_id' => $session->payment_intent,
                'status' => 'completed',
                'paid_at' => now(),
                'metadata' => $session ? json_encode($session) : null,
            ]);

            $payment->order->update([
                'payment_status' => 'paid',
                'status' => 'processing',
            ]);

            Log::info('Payment completed for order: ' . $payment->order_id);
        }
    }

    /**
     * Handle Payment Failed
     */
    private function handlePaymentFailed($paymentIntent)
    {
        $payment = Payment::where('stripe_payment_id', $paymentIntent->id)->first();

        if ($payment) {
            $payment->markAsFailed();
            Log::info('Payment failed for order: ' . $payment->order_id);
        }
    }
}
