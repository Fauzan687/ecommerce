@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Banner -->
<div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl p-8 md:p-12 mb-8 text-white">
    <div class="max-w-2xl">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Selamat Datang di TokoOnlineSMK!</h1>
        <p class="text-lg md:text-xl mb-6 text-blue-100">Temukan produk berkualitas dengan harga terbaik</p>
        <a href="{{ route('products.index') }}" class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition transform hover:scale-105">
            Belanja Sekarang →
        </a>
    </div>
</div>

<!-- Featured Products -->
<div class="mb-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800">✨ Produk Terbaru</h2>
        <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-700 font-semibold">
            Lihat Semua →
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($products as $product)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition transform hover:-translate-y-1">
            <!-- Product Image -->
            <div class="relative h-48 bg-gray-200 overflow-hidden group">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                        <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif
                
                <!-- Stock Badge -->
                @if($product->stock > 0)
                    <span class="absolute top-2 right-2 bg-green-500 text-white text-xs px-2 py-1 rounded-full">
                        Stok: {{ $product->stock }}
                    </span>
                @else
                    <span class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                        Habis
                    </span>
                @endif
            </div>

            <!-- Product Info -->
            <div class="p-4">
                <span class="text-xs text-blue-600 font-semibold">{{ $product->category->name }}</span>
                <h3 class="font-semibold text-lg mb-2 text-gray-800 line-clamp-2">{{ $product->name }}</h3>
                <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $product->description }}</p>
                
                <div class="flex justify-between items-center mb-3">
                    <span class="text-green-600 font-bold text-xl">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                </div>

                <!-- Actions -->
                <div class="flex gap-2">
                    <a href="{{ route('products.show', $product) }}" 
                       class="flex-1 text-center bg-gray-100 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-200 transition">
                        Detail
                    </a>
                    @auth
                        @if($product->stock > 0)
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" 
                                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition transform active:scale-95">
                                    🛒 Beli
                                </button>
                            </form>
                        @else
                            <button disabled class="flex-1 bg-gray-300 text-gray-500 py-2 px-4 rounded-lg cursor-not-allowed">
                                Habis
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" 
                           class="flex-1 text-center bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <svg class="w-20 h-20 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
            </svg>
            <p class="text-gray-500 text-lg">Belum ada produk tersedia</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Features Section -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
    <div class="bg-white p-6 rounded-xl shadow-md text-center">
        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <h3 class="font-bold text-lg mb-2">Produk Berkualitas</h3>
        <p class="text-gray-600">Semua produk dijamin kualitas terbaik</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md text-center">
        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <h3 class="font-bold text-lg mb-2">Harga Terjangkau</h3>
        <p class="text-gray-600">Dapatkan harga terbaik setiap hari</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md text-center">
        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
        </div>
        <h3 class="font-bold text-lg mb-2">Pengiriman Cepat</h3>
        <p class="text-gray-600">Pesanan sampai dengan aman dan cepat</p>
    </div>
</div>
@endsection