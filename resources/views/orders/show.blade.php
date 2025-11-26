@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6 animate-fade-in">
        <a href="{{ route('orders.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 transition group">
            <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Daftar Pesanan
        </a>
    </div>

    <!-- Order Header -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-6 hover-lift animate-slide-in">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4 mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Pesanan #{{ $order->id }}</h1>
                <div class="flex items-center gap-3 text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>{{ $order->created_at->format('d F Y, H:i') }} WIB</span>
                </div>
            </div>
            
            <div class="flex flex-col gap-2">
                <!-- Payment Status -->
                <span class="px-4 py-2 rounded-lg font-semibold text-center
                    @if($order->payment_status == 'paid') bg-green-100 text-green-800 border-2 border-green-200
                    @elseif($order->payment_status == 'failed') bg-red-100 text-red-800 border-2 border-red-200
                    @else bg-yellow-100 text-yellow-800 border-2 border-yellow-200
                    @endif">
                    @if($order->payment_status == 'paid')
                        <i class="fas fa-check-circle mr-2"></i>Pembayaran Lunas
                    @elseif($order->payment_status == 'failed')
                        <i class="fas fa-times-circle mr-2"></i>Pembayaran Gagal
                    @else
                        <i class="fas fa-clock mr-2"></i>Menunggu Pembayaran
                    @endif
                </span>

                <!-- Order Status -->
                <span class="px-4 py-2 rounded-lg font-semibold text-center
                    @if($order->status == 'pending') bg-yellow-100 text-yellow-800 border-2 border-yellow-200
                    @elseif($order->status == 'processing') bg-blue-100 text-blue-800 border-2 border-blue-200
                    @elseif($order->status == 'completed') bg-green-100 text-green-800 border-2 border-green-200
                    @else bg-red-100 text-red-800 border-2 border-red-200
                    @endif">
                    @if($order->status == 'pending') ⏳ Menunggu Konfirmasi
                    @elseif($order->status == 'processing') 📦 Sedang Diproses
                    @elseif($order->status == 'completed') ✅ Selesai
                    @else ❌ Dibatalkan
                    @endif
                </span>
            </div>
        </div>

        <!-- Order Status Timeline -->
        <div class="mt-8">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Status Pesanan</h3>
            <div class="flex items-center justify-between relative">
                <div class="absolute top-5 left-0 right-0 h-1 bg-gray-200 rounded-full"></div>
                <div class="absolute top-5 left-0 h-1 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full transition-all duration-500"
                     style="width: 
                        @if($order->status == 'pending') 25%
                        @elseif($order->status == 'processing') 50%
                        @elseif($order->status == 'completed') 100%
                        @else 0%
                        @endif">
                </div>
                
                @foreach(['pending' => 'Diterima', 'processing' => 'Diproses', 'completed' => 'Selesai'] as $status => $label)
                <div class="relative z-10 text-center">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center mb-2 transition-all duration-300 shadow-lg
                        {{ $order->status == $status || ($status == 'pending' || ($status == 'processing' && in_array($order->status, ['processing', 'completed'])) || ($status == 'completed' && $order->status == 'completed')) ? 'bg-gradient-to-br from-blue-500 to-purple-600 text-white scale-110' : 'bg-gray-200 text-gray-400' }}">
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
                    <p class="text-xs font-medium text-gray-700">{{ $label }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Order Items -->
        <div class="md:col-span-2 bg-white rounded-2xl shadow-lg p-6 hover-lift animate-slide-in" style="animation-delay: 0.1s;">
            <h2 class="text-xl font-bold mb-6 flex items-center text-gray-900">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center mr-3">
                    <i class="fas fa-box text-white"></i>
                </div>
                Item Pesanan
            </h2>
            
            <div class="space-y-4">
                @foreach($order->orderItems as $item)
                <div class="flex items-center gap-4 pb-4 border-b last:border-0 hover:bg-gray-50 p-3 rounded-xl transition">
                    <div class="w-20 h-20 bg-gray-100 rounded-xl overflow-hidden flex-shrink-0">
                        @if($item->product->image)
                            <img src="{{ asset('storage/' . $item->product->image) }}" 
                                 alt="{{ $item->product->name }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <i class="fas fa-image text-2xl"></i>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-900">{{ $item->product->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        <span class="inline-block mt-1 text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full">
                            {{ $item->product->category->name }}
                        </span>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-gray-900 text-lg">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Total -->
            <div class="mt-6 pt-6 border-t-2 border-gray-200 bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-4">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-bold text-gray-900">Total Pembayaran</span>
                    <span class="text-3xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">
                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="space-y-6">
            <!-- Payment Section -->
            @if($order->payment_status != 'paid' && $order->status != 'cancelled')
                <div class="bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl p-6 text-white shadow-xl hover-lift animate-slide-in" style="animation-delay: 0.2s;">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-3">
                            <i class="fas fa-credit-card text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">Pembayaran</h3>
                            <p class="text-sm text-blue-100">Selesaikan pembayaran Anda</p>
                        </div>
                    </div>
                    
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 mb-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-blue-100">Total:</span>
                            <span class="font-bold text-xl">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-100">Status:</span>
                            <span class="px-3 py-1 bg-yellow-400 text-yellow-900 rounded-full text-sm font-semibold">
                                Belum Dibayar
                            </span>
                        </div>
                    </div>
                    
                    <form action="{{ route('payment.checkout', $order) }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="w-full bg-white text-blue-600 font-bold py-4 px-6 rounded-xl hover:bg-blue-50 transition duration-300 flex items-center justify-center gap-3 shadow-lg transform hover:scale-105 group">
                            <svg class="w-6 h-6 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                            <span>Bayar dengan Stripe</span>
                            <i class="fas fa-arrow-right group-hover:translate-x-1 transition"></i>
                        </button>
                    </form>

                    <div class="mt-4 flex items-center justify-center gap-2 text-sm text-blue-100">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>Pembayaran Aman & Terenkripsi</span>
                    </div>
                </div>
            @elseif($order->payment_status == 'paid')
                <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl p-6 text-white shadow-xl animate-slide-in" style="animation-delay: 0.2s;">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-3">
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">Pembayaran Lunas</h3>
                            <p class="text-sm text-green-100">Terima kasih atas pembayaran Anda!</p>
                        </div>
                    </div>
                    
                    @if($order->payment)
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-green-100">Metode:</span>
                                <span class="font-semibold">{{ ucfirst($order->payment->payment_method) }}</span>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-green-100">Dibayar pada:</span>
                                <span class="font-semibold">{{ $order->payment->paid_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-green-100">Total:</span>
                                <span class="font-bold text-xl">Rp {{ number_format($order->payment->amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Shipping Info -->
            <div class="bg-white rounded-2xl shadow-lg p-6 hover-lift animate-slide-in" style="animation-delay: 0.3s;">
                <h2 class="text-xl font-bold mb-4 flex items-center text-gray-900">
                    <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center mr-3">
                        <i class="fas fa-map-marker-alt text-white"></i>
                    </div>
                    Info Pengiriman
                </h2>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-user text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Nama Penerima</p>
                            <p class="font-semibold text-gray-900">{{ $order->customer_name }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">No. Telepon</p>
                            <p class="font-semibold text-gray-900">{{ $order->customer_phone }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-purple-50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-location-dot text-purple-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Alamat Pengiriman</p>
                            <p class="font-semibold text-gray-900">{{ $order->shipping_address }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Help Section -->
            <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-6 border-2 border-blue-200 animate-slide-in" style="animation-delay: 0.4s;">
                <div class="flex items-center mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center mr-3">
                        <i class="fas fa-headset text-white"></i>
                    </div>
                    <h3 class="font-bold text-gray-900">Butuh Bantuan?</h3>
                </div>
                <p class="text-sm text-gray-700 mb-4">Hubungi customer service kami jika ada pertanyaan seputar pesanan Anda</p>
                <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold text-sm group">
                    <span>Hubungi CS</span>
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-slide-in {
    animation: slideIn 0.6s ease-out;
}

.animate-fade-in {
    animation: fadeIn 0.6s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
</style>
@endsection