@extends('layouts.app')

@section('title', 'Home - TokoOnlineSMK')

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
                <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
            </a>
            <a href="#featured-products" 
               class="group border-2 border-white text-white px-8 py-4 rounded-2xl font-bold hover:bg-white/10 transition-all duration-300 transform hover:scale-105 flex items-center justify-center space-x-2">
                <span>Lihat Produk</span>
                <i class="fas fa-arrow-down transform group-hover:translate-y-1 transition-transform"></i>
            </a>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
    @php
        $totalProducts = \App\Models\Product::count();
        $totalCategories = \App\Models\Category::count();
        $totalOrders = \App\Models\Order::count();
        $totalUsers = \App\Models\User::count();
    @endphp
    
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white text-center transform hover:scale-105 transition duration-300 hover-lift">
        <div class="text-3xl font-bold mb-2">{{ $totalProducts }}+</div>
        <div class="text-blue-100 flex items-center justify-center gap-2">
            <i class="fas fa-box"></i>
            <span>Produk Tersedia</span>
        </div>
    </div>
    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white text-center transform hover:scale-105 transition duration-300 hover-lift">
        <div class="text-3xl font-bold mb-2">{{ $totalCategories }}+</div>
        <div class="text-green-100 flex items-center justify-center gap-2">
            <i class="fas fa-tags"></i>
            <span>Kategori</span>
        </div>
    </div>
    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white text-center transform hover:scale-105 transition duration-300 hover-lift">
        <div class="text-3xl font-bold mb-2">{{ $totalOrders }}+</div>
        <div class="text-purple-100 flex items-center justify-center gap-2">
            <i class="fas fa-shopping-bag"></i>
            <span>Pesanan</span>
        </div>
    </div>
    <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl p-6 text-white text-center transform hover:scale-105 transition duration-300 hover-lift">
        <div class="text-3xl font-bold mb-2">{{ $totalUsers }}+</div>
        <div class="text-orange-100 flex items-center justify-center gap-2">
            <i class="fas fa-users"></i>
            <span>Pelanggan</span>
        </div>
    </div>
</div>

<!-- Featured Products -->
<div id="featured-products" class="mb-16">
    <div class="text-center mb-12">
        <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
            <i class="fas fa-star mr-3"></i>Produk Unggulan
        </h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            Temukan koleksi produk terbaru dan terpopuler kami dengan kualitas terbaik
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        @forelse($products as $product)
        <div class="group bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 border border-gray-100 overflow-hidden animate-fade-in">
            <!-- Product Image -->
            <div class="relative h-56 bg-gradient-to-br from-gray-50 to-gray-100 overflow-hidden">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                        <i class="fas fa-image text-4xl"></i>
                    </div>
                @endif
                
                <!-- Overlay on Hover -->
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition duration-300"></div>
                
                <!-- Stock Badge -->
                @if($product->isInStock())
                    @if($product->stock > 10)
                        <span class="absolute top-4 right-4 bg-green-500 text-white text-xs px-3 py-2 rounded-full font-semibold shadow-lg flex items-center gap-1">
                            <i class="fas fa-check"></i>
                            Tersedia
                        </span>
                    @else
                        <span class="absolute top-4 right-4 bg-yellow-500 text-white text-xs px-3 py-2 rounded-full font-semibold shadow-lg flex items-center gap-1">
                            <i class="fas fa-exclamation"></i>
                            Stok Menipis
                        </span>
                    @endif
                @else
                    <span class="absolute top-4 right-4 bg-red-500 text-white text-xs px-3 py-2 rounded-full font-semibold shadow-lg flex items-center gap-1">
                        <i class="fas fa-times"></i>
                        Habis
                    </span>
                @endif

                <!-- Category Badge -->
                <span class="absolute top-4 left-4 bg-blue-500/90 text-white text-xs px-3 py-2 rounded-full font-semibold backdrop-blur-sm flex items-center gap-1">
                    <i class="fas fa-tag"></i>
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
                        {{ $product->formatted_price }}
                    </span>
                    @if($product->isInStock())
                        <span class="text-sm text-green-600 font-semibold bg-green-50 px-3 py-1 rounded-full flex items-center gap-1">
                            <i class="fas fa-check"></i>
                            Tersedia
                        </span>
                    @else
                        <span class="text-sm text-red-600 font-semibold bg-red-50 px-3 py-1 rounded-full flex items-center gap-1">
                            <i class="fas fa-times"></i>
                            Habis
                        </span>
                    @endif
                </div>

                <!-- Actions -->
                <div class="flex gap-3">
                    <a href="{{ route('products.show', $product) }}" 
                       class="flex-1 text-center bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 py-3 px-4 rounded-xl hover:from-gray-200 hover:to-gray-300 transition-all duration-300 transform hover:scale-105 font-semibold group flex items-center justify-center gap-2">
                        <i class="fas fa-eye"></i>
                        <span>Detail</span>
                    </a>
                    @auth
                        @if($product->isInStock())
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" 
                                        class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 px-4 rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 active:scale-95 font-semibold shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                                    <i class="fas fa-cart-plus"></i>
                                    <span>Beli</span>
                                </button>
                            </form>
                        @else
                            <button disabled class="flex-1 bg-gray-300 text-gray-500 py-3 px-4 rounded-xl cursor-not-allowed font-semibold flex items-center justify-center gap-2">
                                <i class="fas fa-ban"></i>
                                <span>Habis</span>
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" 
                           class="flex-1 text-center bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 px-4 rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 font-semibold shadow-lg flex items-center justify-center gap-2">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>Login</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
        @empty
        <!-- Empty State -->
        <div class="col-span-full text-center py-16 animate-fade-in">
            <div class="w-32 h-32 mx-auto mb-6 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                <i class="fas fa-box-open text-gray-400 text-4xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-3">Belum ada produk tersedia</h3>
            <p class="text-gray-600 text-lg mb-6">Kami sedang menyiapkan produk terbaik untuk Anda</p>
            <a href="{{ route('products.index') }}" 
               class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold rounded-2xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 shadow-lg gap-2">
                <i class="fas fa-redo"></i>
                <span>Refresh Halaman</span>
            </a>
        </div>
        @endforelse
    </div>

    <!-- View All Button -->
    @if($products->count() > 0)
    <div class="text-center mt-12">
        <a href="{{ route('products.index') }}" 
           class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-purple-500 to-purple-600 text-white font-bold rounded-2xl hover:from-purple-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl group gap-2">
            <span>Lihat Semua Produk</span>
            <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
        </a>
    </div>
    @endif
</div>

<!-- Features Section -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16">
    <div class="group bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-3xl text-center transform hover:scale-105 transition duration-500 border border-blue-200 hover-lift">
        <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition duration-300 shadow-lg">
            <i class="fas fa-award text-white text-2xl"></i>
        </div>
        <h3 class="font-bold text-2xl mb-4 text-gray-800">Produk Berkualitas</h3>
        <p class="text-gray-600 leading-relaxed">Semua produk dijamin kualitas terbaik dengan standar internasional</p>
    </div>

    <div class="group bg-gradient-to-br from-green-50 to-green-100 p-8 rounded-3xl text-center transform hover:scale-105 transition duration-500 border border-green-200 hover-lift">
        <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition duration-300 shadow-lg">
            <i class="fas fa-tag text-white text-2xl"></i>
        </div>
        <h3 class="font-bold text-2xl mb-4 text-gray-800">Harga Terjangkau</h3>
        <p class="text-gray-600 leading-relaxed">Dapatkan harga terbaik dengan promo menarik setiap harinya</p>
    </div>

    <div class="group bg-gradient-to-br from-purple-50 to-purple-100 p-8 rounded-3xl text-center transform hover:scale-105 transition duration-500 border border-purple-200 hover-lift">
        <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition duration-300 shadow-lg">
            <i class="fas fa-shipping-fast text-white text-2xl"></i>
        </div>
        <h3 class="font-bold text-2xl mb-4 text-gray-800">Pengiriman Cepat</h3>
        <p class="text-gray-600 leading-relaxed">Pesanan sampai dengan aman dan cepat ke seluruh Indonesia</p>
    </div>
</div>

<!-- Newsletter Section -->
<div class="mt-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-3xl p-8 md:p-12 text-center text-white">
    <h2 class="text-3xl md:text-4xl font-bold mb-4"><i class="fas fa-envelope mr-3"></i>Tetap Terhubung</h2>
    <p class="text-xl text-blue-100 mb-6 max-w-2xl mx-auto">
        Dapatkan update produk terbaru dan promo eksklusif langsung di inbox Anda
    </p>
    <div class="max-w-md mx-auto flex gap-4">
        <input type="email" placeholder="email@anda.com" 
               class="flex-1 px-4 py-3 rounded-xl border-0 focus:ring-2 focus:ring-yellow-300 text-gray-800">
        <button class="bg-yellow-400 text-gray-800 px-6 py-3 rounded-xl font-bold hover:bg-yellow-300 transition transform hover:scale-105 flex items-center gap-2">
            <i class="fas fa-paper-plane"></i>
            <span>Subscribe</span>
        </button>
    </div>
</div>

<style>
.animate-slide-in {
    animation: slideIn 1s ease-out;
}

.animate-fade-in {
    animation: fadeIn 0.6s ease-out;
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

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
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
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe product cards for animation
    document.querySelectorAll('.animate-fade-in').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.6s ease';
        observer.observe(card);
    });

    // Add loading state to add to cart buttons
    const addToCartForms = document.querySelectorAll('form[action*="cart.add"]');
    addToCartForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const button = this.querySelector('button[type="submit"]');
            const originalHTML = button.innerHTML;
            
            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menambahkan...';
            button.disabled = true;
            
            // Reset after 3 seconds (in case of error)
            setTimeout(() => {
                button.innerHTML = originalHTML;
                button.disabled = false;
            }, 3000);
        });
    });
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});
</script>
@endsection