@extends('layouts.app')

@section('title', 'Produk - TokoOnlineSMK')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-12 animate-fade-in">
            <h1 class="text-4xl md:text-6xl font-black bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent mb-4 leading-tight">
                🛍️ Katalog Produk
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto font-medium">
                Temukan produk terbaik dengan kualitas premium dan harga terjangkau
            </p>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-xl shadow-lg animate-slide-down flex items-center gap-3">
            <i class="fas fa-check-circle text-2xl"></i>
            <span class="font-medium">{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="ml-auto text-green-600 hover:text-green-800">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-xl shadow-lg animate-slide-down flex items-center gap-3">
            <i class="fas fa-exclamation-circle text-2xl"></i>
            <span class="font-medium">{{ session('error') }}</span>
            <button onclick="this.parentElement.remove()" class="ml-auto text-red-600 hover:text-red-800">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @endif

        <!-- Search & Filter Section -->
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl p-6 mb-8 border border-white/20">
            <div class="flex flex-col lg:flex-row gap-6 items-center">
                <!-- Search Bar -->
                <div class="flex-1 w-full">
                    <form action="{{ route('products.index') }}" method="GET" class="relative group">
                        <div class="relative">
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}" 
                                   placeholder="Cari produk, kategori, atau merek..." 
                                   class="w-full pl-14 pr-12 py-5 bg-gray-50 border-2 border-transparent rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:bg-white focus:border-blue-500 transition-all duration-300 shadow-sm text-lg"
                                   autocomplete="off">
                            <i class="fas fa-search absolute left-5 top-1/2 transform -translate-y-1/2 text-gray-400 text-xl group-focus-within:text-blue-500 transition-colors"></i>
                            @if(request('search'))
                                <button type="button" 
                                        onclick="window.location='{{ route('products.index', ['category' => request('category')]) }}'" 
                                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-red-500 transition-colors p-2">
                                    <i class="fas fa-times-circle text-xl"></i>
                                </button>
                            @endif
                        </div>
                        <!-- Hidden category input to preserve filter -->
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                    </form>
                </div>

                <!-- Results Count & Sort -->
                <div class="flex items-center gap-4">
                    <div class="text-sm text-gray-700 bg-gradient-to-r from-blue-50 to-purple-50 px-6 py-3 rounded-full font-semibold border border-blue-100">
                        <i class="fas fa-box text-blue-500 mr-2"></i>
                        <span class="text-blue-600 font-bold">{{ $products->total() }}</span> 
                        <span class="text-gray-600">produk</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar Categories -->
            <div class="lg:col-span-1">
                <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-2xl p-6 sticky top-24 border border-white/20 transition-all duration-300 hover:shadow-3xl">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-900 flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-tags text-white"></i>
                            </div>
                            <span>Kategori</span>
                        </h3>
                        <span class="bg-gradient-to-r from-blue-100 to-purple-100 text-blue-700 text-sm px-3 py-1 rounded-full font-bold">
                            {{ $categories->count() }}
                        </span>
                    </div>
                    
                    <div class="space-y-2">
                        <a href="{{ route('products.index', ['search' => request('search')]) }}" 
                           class="flex items-center justify-between p-4 rounded-xl transition-all duration-300 group {{ !request('category') ? 'bg-gradient-to-r from-blue-500 via-purple-600 to-pink-600 text-white shadow-lg scale-105' : 'bg-gray-50 hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 text-gray-700 hover:scale-105' }}">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg {{ !request('category') ? 'bg-white/20' : 'bg-blue-100' }} flex items-center justify-center">
                                    <i class="fas fa-layer-group {{ !request('category') ? 'text-white' : 'text-blue-600' }}"></i>
                                </div>
                                <span class="font-semibold">Semua Kategori</span>
                            </div>
                            <span class="{{ !request('category') ? 'bg-white/20 text-white' : 'bg-blue-100 text-blue-600' }} px-3 py-1 rounded-full text-sm font-bold">
                                {{ \App\Models\Product::count() }}
                            </span>
                        </a>
                        
                        @foreach($categories as $category)
                        <a href="{{ route('products.index', ['category' => $category->slug, 'search' => request('search')]) }}" 
                           class="flex items-center justify-between p-4 rounded-xl transition-all duration-300 group {{ request('category') == $category->slug ? 'bg-gradient-to-r from-blue-500 via-purple-600 to-pink-600 text-white shadow-lg scale-105' : 'bg-gray-50 hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 text-gray-700 hover:scale-105' }}">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg {{ request('category') == $category->slug ? 'bg-white/20' : 'bg-blue-100' }} flex items-center justify-center">
                                    <i class="fas fa-folder {{ request('category') == $category->slug ? 'text-white' : 'text-blue-600' }}"></i>
                                </div>
                                <span class="font-semibold">{{ $category->name }}</span>
                            </div>
                            <span class="{{ request('category') == $category->slug ? 'bg-white/20 text-white' : 'bg-blue-100 text-blue-600' }} px-3 py-1 rounded-full text-sm font-bold">
                                {{ $category->products_count }}
                            </span>
                        </a>
                        @endforeach
                    </div>

                    <!-- Quick Stats -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-chart-line text-green-500"></i>
                            <span>Statistik</span>
                        </h4>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-4 rounded-xl border border-green-100 hover:scale-105 transition-transform">
                                <div class="text-green-600 font-bold text-2xl">{{ $products->total() }}</div>
                                <div class="text-gray-600 text-sm font-medium">Produk</div>
                            </div>
                            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-4 rounded-xl border border-blue-100 hover:scale-105 transition-transform">
                                <div class="text-blue-600 font-bold text-2xl">{{ $categories->count() }}</div>
                                <div class="text-gray-600 text-sm font-medium">Kategori</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="lg:col-span-3">
                @if($products->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($products as $index => $product)
                    <div class="product-card bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 group border border-gray-100 overflow-hidden" 
                         style="animation-delay: {{ $index * 0.1 }}s">
                        <!-- Product Image -->
                        <div class="relative h-64 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                     loading="lazy">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <i class="fas fa-image text-6xl"></i>
                                </div>
                            @endif
                            
                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <!-- Category Badge -->
                            <div class="absolute top-4 left-4">
                                <span class="bg-gradient-to-r from-blue-500 to-purple-600 text-white text-xs px-4 py-2 rounded-full font-bold shadow-lg backdrop-blur-sm flex items-center gap-2">
                                    <i class="fas fa-tag"></i>
                                    {{ $product->category->name }}
                                </span>
                            </div>

                            <!-- Stock Badge -->
                            <div class="absolute top-4 right-4">
                                @if($product->stock > 10)
                                    <span class="bg-green-500 text-white text-xs px-4 py-2 rounded-full font-bold shadow-lg flex items-center gap-2 animate-pulse-slow">
                                        <i class="fas fa-check-circle"></i>
                                        Tersedia
                                    </span>
                                @elseif($product->stock > 0)
                                    <span class="bg-yellow-500 text-white text-xs px-4 py-2 rounded-full font-bold shadow-lg flex items-center gap-2">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        Terbatas
                                    </span>
                                @else
                                    <span class="bg-red-500 text-white text-xs px-4 py-2 rounded-full font-bold shadow-lg flex items-center gap-2">
                                        <i class="fas fa-times-circle"></i>
                                        Habis
                                    </span>
                                @endif
                            </div>

                            <!-- Quick View Button -->
                            <div class="absolute bottom-4 left-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-4 group-hover:translate-y-0">
                                <a href="{{ route('products.show', $product) }}" 
                                   class="block w-full bg-white/95 backdrop-blur-sm text-gray-800 px-6 py-3 rounded-xl text-sm font-bold text-center hover:bg-white transition-all shadow-lg">
                                    <i class="fas fa-eye mr-2"></i> Lihat Detail
                                </a>
                            </div>
                        </div>

                        <!-- Product Info -->
                        <div class="p-6">
                            <h3 class="font-bold text-xl mb-3 text-gray-900 line-clamp-2 group-hover:text-blue-600 transition-colors leading-tight min-h-[3.5rem]">
                                {{ $product->name }}
                            </h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2 leading-relaxed">
                                {{ $product->description }}
                            </p>
                            
                            <!-- Price & Stock Info -->
                            <div class="flex justify-between items-center mb-5 pb-5 border-b border-gray-100">
                                <div>
                                    <div class="text-3xl font-black bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </div>
                                    @if($product->stock > 0)
                                        <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                                            <i class="fas fa-box text-blue-500"></i>
                                            <span class="font-semibold">{{ $product->stock }}</span> unit tersedia
                                        </p>
                                    @else
                                        <p class="text-xs text-red-500 mt-2 font-semibold">
                                            <i class="fas fa-times-circle"></i> Stok habis
                                        </p>
                                    @endif
                                </div>
                                @if($product->stock > 0)
                                    <div class="w-14 h-14 bg-gradient-to-br from-green-100 to-emerald-100 rounded-2xl flex items-center justify-center shadow-lg">
                                        <i class="fas fa-check text-green-600 text-2xl"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-3">
                                <a href="{{ route('products.show', $product) }}" 
                                   class="flex-1 text-center bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 py-3.5 px-4 rounded-xl hover:from-gray-200 hover:to-gray-300 transition-all duration-300 transform hover:scale-105 active:scale-95 font-bold group flex items-center justify-center gap-2 shadow-md">
                                    <i class="fas fa-info-circle group-hover:rotate-12 transition-transform"></i>
                                    <span>Detail</span>
                                </a>
                                
                                @auth
                                    @if($product->stock > 0)
                                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1 add-to-cart-form">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" 
                                                    class="w-full bg-gradient-to-r from-blue-500 via-blue-600 to-purple-600 text-white py-3.5 px-4 rounded-xl hover:from-blue-600 hover:via-purple-600 hover:to-pink-600 transition-all duration-300 transform hover:scale-105 active:scale-95 font-bold shadow-lg hover:shadow-2xl flex items-center justify-center gap-2">
                                                <i class="fas fa-cart-plus"></i>
                                                <span>Beli</span>
                                            </button>
                                        </form>
                                    @else
                                        <button disabled 
                                                class="flex-1 bg-gray-200 text-gray-400 py-3.5 px-4 rounded-xl cursor-not-allowed font-bold flex items-center justify-center gap-2">
                                            <i class="fas fa-ban"></i>
                                            <span>Habis</span>
                                        </button>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" 
                                       class="flex-1 text-center bg-gradient-to-r from-blue-500 via-blue-600 to-purple-600 text-white py-3.5 px-4 rounded-xl hover:from-blue-600 hover:via-purple-600 hover:to-pink-600 transition-all duration-300 transform hover:scale-105 active:scale-95 font-bold shadow-lg flex items-center justify-center gap-2">
                                        <i class="fas fa-sign-in-alt"></i>
                                        <span>Login</span>
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                <div class="mt-12 bg-white/90 backdrop-blur-lg rounded-3xl shadow-2xl p-6 border border-white/20">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="text-sm text-gray-600 font-medium">
                            Menampilkan <span class="font-bold text-blue-600">{{ $products->firstItem() }}</span> - 
                            <span class="font-bold text-blue-600">{{ $products->lastItem() }}</span> dari 
                            <span class="font-bold text-blue-600">{{ $products->total() }}</span> produk
                        </div>
                        <div class="pagination-wrapper">
                            {{ $products->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
                @endif

                @else
                <!-- Empty State -->
                <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-2xl p-16 text-center animate-fade-in border border-white/20">
                    <div class="max-w-md mx-auto">
                        <div class="w-32 h-32 mx-auto mb-8 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center shadow-xl">
                            <i class="fas fa-search text-gray-400 text-5xl"></i>
                        </div>
                        <h3 class="text-3xl font-black text-gray-900 mb-4">Produk Tidak Ditemukan</h3>
                        <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                            @if(request('search') || request('category'))
                                Maaf, tidak ada produk yang sesuai dengan pencarian Anda. <br>
                                <span class="font-semibold text-gray-700">Coba kata kunci lain atau lihat semua kategori.</span>
                            @else
                                Belum ada produk yang tersedia saat ini. <br>
                                <span class="font-semibold text-gray-700">Silakan kembali nanti.</span>
                            @endif
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('products.index') }}" 
                               class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-500 via-blue-600 to-purple-600 text-white font-bold rounded-xl hover:from-blue-600 hover:via-purple-600 hover:to-pink-600 transition-all duration-300 transform hover:scale-105 shadow-xl">
                                <i class="fas fa-redo mr-2"></i>
                                Lihat Semua Produk
                            </a>
                            <a href="{{ route('home') }}" 
                               class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 font-bold rounded-xl hover:from-gray-200 hover:to-gray-300 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                <i class="fas fa-home mr-2"></i>
                                Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
/* Text truncation */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Animations */
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slide-down {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes pulse-slow {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.8;
    }
}

.animate-fade-in {
    animation: fade-in 0.6s ease-out;
}

.animate-slide-down {
    animation: slide-down 0.4s ease-out;
}

.animate-pulse-slow {
    animation: pulse-slow 3s ease-in-out infinite;
}

/* Product card animation */
.product-card {
    opacity: 0;
    animation: fade-in 0.6s ease-out forwards;
}

/* Custom pagination */
.pagination {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.page-item {
    display: inline-block;
}

.page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 2.75rem;
    height: 2.75rem;
    padding: 0 0.75rem;
    border-radius: 0.75rem;
    font-weight: 700;
    transition: all 0.3s ease;
    font-size: 0.875rem;
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #3b82f6, #8b5cf6, #ec4899);
    color: white;
    box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
    transform: scale(1.1);
}

.page-item:not(.active):not(.disabled) .page-link {
    background: linear-gradient(135deg, #f8fafc, #f1f5f9);
    color: #64748b;
    border: 2px solid #e2e8f0;
}

.page-item:not(.active):not(.disabled) .page-link:hover {
    background: linear-gradient(135deg, #3b82f6, #8b5cf6);
    color: white;
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
    border-color: transparent;
}

.page-item.disabled .page-link {
    background: #f1f5f9;
    color: #cbd5e1;
    cursor: not-allowed;
    border: 2px solid #e2e8f0;
}

/* Hover effects */
.hover-lift:hover {
    transform: translateY(-4px);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
}

/* Loading spinner */
@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.fa-spinner {
    animation: spin 1s linear infinite;
}

/* Scrollbar styling */
::-webkit-scrollbar {
    width: 10px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, #3b82f6, #8b5cf6);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(180deg, #2563eb, #7c3aed);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Intersection Observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe product cards
    document.querySelectorAll('.product-card').forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = `all 0.6s ease ${index * 0.1}s`;
        observer.observe(card);
    });

    // Add to cart form handling
    const cartForms = document.querySelectorAll('.add-to-cart-form');
    cartForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const button = this.querySelector('button[type="submit"]');
            const originalHTML = button.innerHTML;
            
            // Disable button and show loading state
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menambahkan...';
            button.classList.add('opacity-75');
            
            // Reset after timeout (in case of error)
            setTimeout(() => {
                button.innerHTML = originalHTML;
                button.disabled = false;
                button.classList.remove('opacity-75');
            }, 3000);
        });
    });

    // Auto-hide alert messages
    const alerts = document.querySelectorAll('[role="alert"]');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'all 0.5s ease-out';
            alert.style.opacity = '0';
            alert.style.transform = 'translateX(100%)';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });

    // Search input auto-focus enhancement
    const searchInput = document.querySelector('input[name="search"]');
    if (searchInput) {
        searchInput.addEventListener('focus', function() {
            this.parentElement.classList.add('ring-4', 'ring-blue-500/20');
        });
        searchInput.addEventListener('blur', function() {
            this.parentElement.classList.remove('ring-4', 'ring-blue-500/20');
        });
    }

    // Category hover effect
    const categoryLinks = document.querySelectorAll('a[href*="category"]');
    categoryLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05) translateX(5px)';
        });
        link.addEventListener('mouseleave', function() {
            if (!this.classList.contains('scale-105')) {
                this.style.transform = 'scale(1) translateX(0)';
            }
        });
    });
});

// Add smooth scroll behavior
document.documentElement.style.scrollBehavior = 'smooth';
</script>
@endsection