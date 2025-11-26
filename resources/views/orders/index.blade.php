@extends('layouts.app')

@section('title', 'Pesanan Saya - TokoOnlineSMK')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="text-center mb-12 animate-fade-in">
        <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-4">
            📦 Pesanan Saya
        </h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            Kelola dan lacak pesanan Anda dengan mudah
        </p>
    </div>

    @if($orders->count() > 0)
    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8 animate-fade-in" style="animation-delay: 0.1s;">
        @php
            $pendingCount = $orders->where('status', 'pending')->count();
            $processingCount = $orders->where('status', 'processing')->count();
            $completedCount = $orders->where('status', 'completed')->count();
            $unpaidCount = $orders->where('payment_status', 'unpaid')->count();
        @endphp
        
        <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl p-6 text-white text-center transform hover:scale-105 transition duration-300 shadow-lg">
            <div class="text-3xl font-bold mb-2">{{ $pendingCount }}</div>
            <div class="text-yellow-100 flex items-center justify-center gap-2">
                <i class="fas fa-clock"></i>
                <span>Menunggu</span>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white text-center transform hover:scale-105 transition duration-300 shadow-lg">
            <div class="text-3xl font-bold mb-2">{{ $processingCount }}</div>
            <div class="text-blue-100 flex items-center justify-center gap-2">
                <i class="fas fa-cog"></i>
                <span>Diproses</span>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white text-center transform hover:scale-105 transition duration-300 shadow-lg">
            <div class="text-3xl font-bold mb-2">{{ $completedCount }}</div>
            <div class="text-green-100 flex items-center justify-center gap-2">
                <i class="fas fa-check-circle"></i>
                <span>Selesai</span>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-2xl p-6 text-white text-center transform hover:scale-105 transition duration-300 shadow-lg">
            <div class="text-3xl font-bold mb-2">{{ $unpaidCount }}</div>
            <div class="text-red-100 flex items-center justify-center gap-2">
                <i class="fas fa-credit-card"></i>
                <span>Belum Bayar</span>
            </div>
        </div>
    </div>

    <!-- Orders List -->
    <div class="space-y-6 animate-fade-in" style="animation-delay: 0.2s;">
        @foreach($orders as $order)
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-500 hover-lift border border-gray-100 overflow-hidden">
            <!-- Order Header -->
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-receipt text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-lg">Pesanan #{{ $order->id }}</h3>
                            <p class="text-sm text-gray-600">{{ $order->created_at->format('d F Y, H:i') }} WIB</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap items-center gap-3">
                        <!-- Payment Status Badge -->
                        <span class="px-4 py-2 rounded-full text-sm font-semibold
                            @if($order->payment_status == 'paid') 
                                bg-green-100 text-green-800 border border-green-200
                            @elseif($order->payment_status == 'failed') 
                                bg-red-100 text-red-800 border border-red-200
                            @else 
                                bg-yellow-100 text-yellow-800 border border-yellow-200
                            @endif">
                            @if($order->payment_status == 'paid') 
                                <i class="fas fa-check-circle mr-2"></i>Lunas
                            @elseif($order->payment_status == 'failed') 
                                <i class="fas fa-times-circle mr-2"></i>Gagal
                            @else 
                                <i class="fas fa-clock mr-2"></i>Belum Bayar
                            @endif
                        </span>

                        <!-- Order Status Badge -->
                        <span class="px-4 py-2 rounded-full text-sm font-semibold
                            @if($order->status == 'pending') 
                                bg-yellow-100 text-yellow-800 border border-yellow-200
                            @elseif($order->status == 'processing') 
                                bg-blue-100 text-blue-800 border border-blue-200
                            @elseif($order->status == 'completed') 
                                bg-green-100 text-green-800 border border-green-200
                            @elseif($order->status == 'cancelled') 
                                bg-red-100 text-red-800 border border-red-200
                            @endif">
                            @if($order->status == 'pending') 
                                <i class="fas fa-clock mr-2"></i>Menunggu Konfirmasi
                            @elseif($order->status == 'processing') 
                                <i class="fas fa-cog mr-2"></i>Sedang Diproses
                            @elseif($order->status == 'completed') 
                                <i class="fas fa-check-circle mr-2"></i>Selesai
                            @elseif($order->status == 'cancelled') 
                                <i class="fas fa-times-circle mr-2"></i>Dibatalkan
                            @endif
                        </span>
                        
                        <span class="text-2xl font-bold text-green-600">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($order->orderItems as $item)
                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                        <div class="w-16 h-16 bg-white rounded-lg border border-gray-200 flex items-center justify-center overflow-hidden">
                            @if($item->product->image)
                                <img src="{{ asset('storage/' . $item->product->image) }}" 
                                     alt="{{ $item->product->name }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <i class="fas fa-image text-gray-400 text-xl"></i>
                            @endif
                        </div>
                        
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900">{{ $item->product->name }}</h4>
                            <p class="text-sm text-gray-600">{{ $item->product->category->name }}</p>
                        </div>
                        
                        <div class="text-right">
                            <p class="font-semibold text-gray-900">{{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            <p class="text-lg font-bold text-green-600">Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Order Footer -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mt-6 pt-6 border-t border-gray-200">
                    <div class="space-y-2">
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <i class="fas fa-user"></i>
                            <span>{{ $order->customer_name }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <i class="fas fa-phone"></i>
                            <span>{{ $order->customer_phone }}</span>
                        </div>
                        <div class="flex items-start gap-2 text-sm text-gray-600">
                            <i class="fas fa-map-marker-alt mt-1"></i>
                            <span class="flex-1">{{ Str::limit($order->shipping_address, 100) }}</span>
                        </div>
                    </div>
                    
                    <div class="flex gap-3">
                        <!-- Payment Button (if unpaid) -->
                        @if($order->payment_status != 'paid' && $order->status != 'cancelled')
                            <form action="{{ route('payment.checkout', $order) }}" method="POST">
                                @csrf
                                <button type="submit" 
                                        class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-3 rounded-xl hover:from-green-600 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105 font-semibold shadow-lg hover:shadow-xl flex items-center gap-2 group">
                                    <i class="fas fa-credit-card group-hover:scale-110 transition"></i>
                                    <span>Bayar Sekarang</span>
                                </button>
                            </form>
                        @endif

                        <!-- View Detail Button -->
                        <a href="{{ route('orders.show', $order) }}" 
                           class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 font-semibold shadow-lg hover:shadow-xl flex items-center gap-2 group">
                            <i class="fas fa-eye group-hover:scale-110 transition"></i>
                            <span>Detail Pesanan</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    @if($orders->hasPages())
    <div class="mt-8 flex justify-center animate-fade-in" style="animation-delay: 0.3s;">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            {{ $orders->links() }}
        </div>
    </div>
    @endif

    @else
    <!-- Empty State -->
    <div class="bg-white rounded-2xl shadow-xl p-12 text-center animate-fade-in">
        <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
            <i class="fas fa-shopping-bag text-gray-400 text-3xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-3">Belum Ada Pesanan</h3>
        <p class="text-gray-600 text-lg mb-8 max-w-md mx-auto">
            Mulai jelajahi produk kami dan temukan barang-barang menarik untuk pesanan pertama Anda!
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('products.index') }}" 
               class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 shadow-lg group">
                <i class="fas fa-store mr-3 group-hover:scale-110 transition"></i>
                <span>Jelajahi Produk</span>
            </a>
            <a href="{{ route('home') }}" 
               class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 font-semibold rounded-xl hover:from-gray-200 hover:to-gray-300 transition-all duration-300 transform hover:scale-105 group">
                <i class="fas fa-home mr-3 group-hover:scale-110 transition"></i>
                <span>Kembali ke Beranda</span>
            </a>
        </div>
    </div>
    @endif
</div>

<style>
.animate-fade-in {
    animation: fadeIn 0.6s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
}
</style>
@endsection