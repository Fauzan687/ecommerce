@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('orders.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Daftar Pesanan
        </a>
    </div>

    <!-- Order Header -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Pesanan #{{ $order->id }}</h1>
                <p class="text-gray-600">{{ $order->created_at->format('d F Y, H:i') }} WIB</p>
            </div>
            <span class="px-4 py-2 rounded-lg font-semibold
                @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                @elseif($order->status == 'completed') bg-green-100 text-green-800
                @else bg-red-100 text-red-800
                @endif">
                @if($order->status == 'pending') ⏳ Menunggu Konfirmasi
                @elseif($order->status == 'processing') 📦 Sedang Diproses
                @elseif($order->status == 'completed') ✅ Selesai
                @else ❌ Dibatalkan
                @endif
            </span>
        </div>

        <!-- Order Status Timeline -->
        <div class="mt-6">
            <div class="flex items-center justify-between relative">
                <div class="absolute top-5 left-0 right-0 h-1 bg-gray-200"></div>
                <div class="absolute top-5 left-0 h-1 bg-blue-600 transition-all duration-500"
                     style="width: 
                        @if($order->status == 'pending') 25%
                        @elseif($order->status == 'processing') 50%
                        @elseif($order->status == 'completed') 100%
                        @else 0%
                        @endif">
                </div>
                
                @foreach(['pending' => 'Diterima', 'processing' => 'Diproses', 'completed' => 'Selesai'] as $status => $label)
                <div class="relative z-10 text-center">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center mb-2 transition
                        {{ $order->status == $status || ($status == 'pending' || ($status == 'processing' && in_array($order->status, ['processing', 'completed'])) || ($status == 'completed' && $order->status == 'completed')) ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-400' }}">
                        @if($status == 'pending')
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        @elseif($status == 'processing')
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                            </svg>
                        @else
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z"/>
                                <path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"/>
                            </svg>
                        @endif
                    </div>
                    <p class="text-xs font-medium">{{ $label }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Order Items -->
        <div class="md:col-span-2 bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold mb-4">📦 Item Pesanan</h2>
            <div class="space-y-4">
                @foreach($order->orderItems as $item)
                <div class="flex items-center gap-4 pb-4 border-b last:border-0">
                    <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : 'https://via.placeholder.com/80' }}" 
                         alt="{{ $item->product->name }}"
                         class="w-20 h-20 object-cover rounded-lg">
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-800">{{ $item->product->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-gray-800">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Total -->
            <div class="mt-6 pt-4 border-t">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-semibold">Total Pembayaran</span>
                    <span class="text-2xl font-bold text-green-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Shipping Info -->
        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold mb-4">📍 Info Pengiriman</h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">Nama Penerima</p>
                        <p class="font-semibold">{{ $order->customer_name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">No. Telepon</p>
                        <p class="font-semibold">{{ $order->customer_phone }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Alamat</p>
                        <p class="font-semibold">{{ $order->shipping_address }}</p>
                    </div>
                </div>
            </div>

            <!-- Help Section -->
            <div class="bg-blue-50 rounded-xl p-6 border-2 border-blue-200">
                <h3 class="font-bold text-blue-900 mb-2">💬 Butuh Bantuan?</h3>
                <p class="text-sm text-blue-800 mb-3">Hubungi customer service kami jika ada pertanyaan</p>
                <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold text-sm">
                    Hubungi CS →
                </a>
            </div>
        </div>
    </div>
</div>
@endsection