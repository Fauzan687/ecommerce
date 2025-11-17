@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Animated Hero Banner -->
<div class="relative bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-700 rounded-3xl p-8 md:p-12 mb-12 text-white overflow-hidden">
    <!-- Background Animation -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-10 -left-10 w-32 h-32 bg-white/10 rounded-full animate-pulse"></div>
        <div class="absolute top-1/4 -right-10 w-24 h-24 bg-white/10 rounded-full animate-pulse" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-10 left-1/4 w-20 h-20 bg-white/10 rounded-full animate-pulse" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-20 right-1/4 w-28 h-28 bg-white/10 rounded-full animate-pulse" style="animation-delay: 1.5s;"></div>
    </div>
    
    <div class="relative max-w-2xl">
        <h1 class="text-4xl md:text-6xl font-bold mb-4 leading-tight animate-slide-in">
            Selamat Datang di <span class="text-yellow-300">TokoOnlineSMK</span>
        </h1>
        <p class="text-xl md:text-2xl mb-6 text-blue-100 leading-relaxed">
            Temukan produk <span class="font-semibold text-yellow-300">berkualitas</span> dengan harga terbaik untuk kebutuhan Anda
        </p>
        <div class="flex flex-col sm:flex-row gap-4">
            <a href="{{ route('products.index') }}" 
               class="group bg-white text-blue-600 px-8 py-4 rounded-2xl font-bold hover:bg-blue-50 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl flex items-center justify-center space-x-2">
                <span>Belanja Sekarang</span>
                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
            <a href="#featured-products" 
               class="group border-2 border-white text-white px-8 py-4 rounded-2xl font-bold hover:bg-white/10 transition-all duration-300 transform hover:scale-105 flex items-center justify-center space-x-2">
                <span>Lihat Produk</span>
                <svg class="w-5 h-5 transform group-hover:translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </a>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white text-center transform hover:scale-105 transition duration-300">
        <div class="text-3xl font-bold mb-2">50+</div>
        <div class="text-blue-100">Produk Tersedia</div>
    </div>
    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white text-center transform hover:scale-105 transition duration-300">
        <div class="text-3xl font-bold mb-2">100%</div>
        <div class="text-green-100">Original</div>
    </div>
    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white text-center transform hover:scale-105 transition duration-300">
        <div class="text-3xl font-bold mb-2">24/7</div>
        <div class="text-purple-100">Support</div>
    </div>
    <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl p-6 text-white text-center transform hover:scale-105 transition duration-300">
        <div class="text-3xl font-bold mb-2">🚚</div>
        <div class="text-orange-100">Gratis Ongkir</div>
    </div>
</div>

<!-- Featured Products -->
<div id="featured-products" class="mb-16">
    <div class="text-center mb-12">
        <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
            ✨ Produk Unggulan
        </h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            Temukan koleksi produk terbaru dan terpopuler kami dengan kualitas terbaik
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        @forelse($products as $product)
        <div class="group bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 border border-gray-100 overflow-hidden">
            <!-- Product Image -->
            <div class="relative h-56 bg-gradient-to-br from-gray-50 to-gray-100 overflow-hidden">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif
                
                <!-- Overlay on Hover -->
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition duration-300"></div>
                
                <!-- Stock Badge -->
                @if($product->stock > 0)
                    <span class="absolute top-4 right-4 bg-green-500 text-white text-xs px-3 py-2 rounded-full font-semibold shadow-lg">
                        ✅ Stok: {{ $product->stock }}
                    </span>
                @else
                    <span class="absolute top-4 right-4 bg-red-500 text-white text-xs px-3 py-2 rounded-full font-semibold shadow-lg">
                        ❌ Habis
                    </span>
                @endif

                <!-- Category Badge -->
                <span class="absolute top-4 left-4 bg-blue-500/90 text-white text-xs px-3 py-2 rounded-full font-semibold backdrop-blur-sm">
                    {{ $product->category->name }}
                </span>
            </div>

            <!-- Product Info -->
            <div class="p-6">
                <h3 class="font-bold text-xl mb-3 text-gray-800 line-clamp-2 group-hover:text-blue-600 transition-colors">
                    {{ $product->name }}
                </h3>
                <p class="text-gray-600 text-sm mb-4 line-clamp-2 leading-relaxed">
                    {{ $product->description }}
                </p>
                
                <div class="flex justify-between items-center mb-4">
                    <span class="text-green-600 font-bold text-2xl">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                    @if($product->stock > 0)
                        <span class="text-sm text-green-600 font-semibold bg-green-50 px-3 py-1 rounded-full">
                            🚀 Tersedia
                        </span>
                    @else
                        <span class="text-sm text-red-600 font-semibold bg-red-50 px-3 py-1 rounded-full">
                            ⏳ Stok Habis
                        </span>
                    @endif
                </div>

                <!-- Actions -->
                <div class="flex gap-3">
                    <a href="{{ route('products.show', $product) }}" 
                       class="flex-1 text-center bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 py-3 px-4 rounded-xl hover:from-gray-200 hover:to-gray-300 transition-all duration-300 transform hover:scale-105 font-semibold group">
                        <span class="group-hover:underline">Detail</span>
                    </a>
                    @auth
                        @if($product->stock > 0)
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" 
                                        class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 px-4 rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 active:scale-95 font-semibold shadow-lg hover:shadow-xl flex items-center justify-center space-x-2">
                                    <span>🛒</span>
                                    <span>Beli</span>
                                </button>
                            </form>
                        @else
                            <button disabled class="flex-1 bg-gray-300 text-gray-500 py-3 px-4 rounded-xl cursor-not-allowed font-semibold">
                                Habis
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" 
                           class="flex-1 text-center bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 px-4 rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 font-semibold shadow-lg">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
        @empty
        <!-- Empty State -->
        <div class="col-span-full text-center py-16">
            <div class="w-32 h-32 mx-auto mb-6 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-3">Belum ada produk tersedia</h3>
            <p class="text-gray-600 text-lg mb-6">Kami sedang menyiapkan produk terbaik untuk Anda</p>
            <a href="{{ route('products.index') }}" 
               class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold rounded-2xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                <span>Refresh Halaman</span>
            </a>
        </div>
        @endforelse
    </div>

    <!-- View All Button -->
    @if($products->count() > 0)
    <div class="text-center mt-12">
        <a href="{{ route('products.index') }}" 
           class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-purple-500 to-purple-600 text-white font-bold rounded-2xl hover:from-purple-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl group">
            <span>Lihat Semua Produk</span>
            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
        </a>
    </div>
    @endif
</div>

<!-- Features Section -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16">
    <div class="group bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-3xl text-center transform hover:scale-105 transition duration-500 border border-blue-200">
        <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition duration-300 shadow-lg">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <h3 class="font-bold text-2xl mb-4 text-gray-800">Produk Berkualitas</h3>
        <p class="text-gray-600 leading-relaxed">Semua produk dijamin kualitas terbaik dengan standar internasional</p>
    </div>

    <div class="group bg-gradient-to-br from-green-50 to-green-100 p-8 rounded-3xl text-center transform hover:scale-105 transition duration-500 border border-green-200">
        <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition duration-300 shadow-lg">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <h3 class="font-bold text-2xl mb-4 text-gray-800">Harga Terjangkau</h3>
        <p class="text-gray-600 leading-relaxed">Dapatkan harga terbaik dengan promo menarik setiap harinya</p>
    </div>

    <div class="group bg-gradient-to-br from-purple-50 to-purple-100 p-8 rounded-3xl text-center transform hover:scale-105 transition duration-500 border border-purple-200">
        <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition duration-300 shadow-lg">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
        </div>
        <h3 class="font-bold text-2xl mb-4 text-gray-800">Pengiriman Cepat</h3>
        <p class="text-gray-600 leading-relaxed">Pesanan sampai dengan aman dan cepat ke seluruh Indonesia</p>
    </div>
</div>

<!-- Newsletter Section -->
<div class="mt-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-3xl p-8 md:p-12 text-center text-white">
    <h2 class="text-3xl md:text-4xl font-bold mb-4">📧 Tetap Terhubung</h2>
    <p class="text-xl text-blue-100 mb-6 max-w-2xl mx-auto">
        Dapatkan update produk terbaru dan promo eksklusif langsung di inbox Anda
    </p>
    <div class="max-w-md mx-auto flex gap-4">
        <input type="email" placeholder="email@anda.com" 
               class="flex-1 px-4 py-3 rounded-xl border-0 focus:ring-2 focus:ring-yellow-300 text-gray-800">
        <button class="bg-yellow-400 text-gray-800 px-6 py-3 rounded-xl font-bold hover:bg-yellow-300 transition transform hover:scale-105">
            Subscribe
        </button>
    </div>
</div>

<style>
.animate-slide-in {
    animation: slideIn 1s ease-out;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Smooth scrolling for anchor links */
html {
    scroll-behavior: smooth;
}
</style>

<script>
// Add intersection observer for scroll animations
document.addEventListener('DOMContentLoaded', function() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, observerOptions);

    // Observe product cards for animation
    document.querySelectorAll('.group.bg-white').forEach(card => {
        card.style.animation = 'slideIn 0.6s ease-out backwards paused';
        observer.observe(card);
    });
});
</script>
@endsection