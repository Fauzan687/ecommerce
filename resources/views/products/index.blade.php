@extends('layouts.app')

@section('title', 'Produk - TokoOnlineSMK')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="text-center mb-12 animate-fade-in">
        <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-4">
            🛍️ Katalog Produk
        </h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            Temukan produk terbaik dengan kualitas premium dan harga terjangkau
        </p>
    </div>

    <!-- Search & Filter Section -->
    <div class="bg-white rounded-2xl shadow-xl p-6 mb-8 glass hover-lift">
        <div class="flex flex-col lg:flex-row gap-6 items-center">
            <!-- Search Bar -->
            <div class="flex-1 w-full">
                <form action="{{ route('products.index') }}" method="GET" class="relative">
                    <div class="relative">
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Cari produk, kategori, atau merek..." 
                               class="w-full pl-12 pr-4 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all duration-300 shadow-sm">
                        <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg"></i>
                        @if(request('search'))
                            <a href="{{ route('products.index') }}" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-red-500 transition">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Results Count -->
            <div class="text-sm text-gray-600 bg-blue-50 px-4 py-2 rounded-full">
                <span class="font-semibold text-blue-600">{{ $products->total() }}</span> produk ditemukan
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Categories -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-xl p-6 sticky top-24 hover-lift transition-all duration-300">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                        <i class="fas fa-tags text-blue-500"></i>
                        Kategori
                    </h3>
                    <span class="bg-blue-100 text-blue-600 text-sm px-2 py-1 rounded-full">
                        {{ $categories->count() }}
                    </span>
                </div>
                
                <div class="space-y-2">
                    <a href="{{ route('products.index') }}" 
                       class="flex items-center justify-between p-4 rounded-xl transition-all duration-300 group {{ !request('category') ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg' : 'bg-gray-50 hover:bg-blue-50 text-gray-700' }}">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-layer-group {{ !request('category') ? 'text-white' : 'text-blue-500' }}"></i>
                            <span class="font-medium">Semua Kategori</span>
                        </div>
                        <span class="bg-white/20 px-2 py-1 rounded-full text-sm">
                            {{ \App\Models\Product::count() }}
                        </span>
                    </a>
                    
                    @foreach($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}" 
                       class="flex items-center justify-between p-4 rounded-xl transition-all duration-300 group {{ request('category') == $category->slug ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg' : 'bg-gray-50 hover:bg-blue-50 text-gray-700' }}">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-folder {{ request('category') == $category->slug ? 'text-white' : 'text-blue-500' }}"></i>
                            <span class="font-medium">{{ $category->name }}</span>
                        </div>
                        <span class="{{ request('category') == $category->slug ? 'bg-white/20' : 'bg-blue-100 text-blue-600' }} px-2 py-1 rounded-full text-sm">
                            {{ $category->products_count }}
                        </span>
                    </a>
                    @endforeach
                </div>

                <!-- Quick Stats -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h4 class="font-semibold text-gray-700 mb-4 flex items-center gap-2">
                        <i class="fas fa-chart-bar text-green-500"></i>
                        Statistik Cepat
                    </h4>
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div class="bg-green-50 p-3 rounded-lg text-center">
                            <div class="text-green-600 font-bold">{{ $products->total() }}</div>
                            <div class="text-gray-600">Total Produk</div>
                        </div>
                        <div class="bg-blue-50 p-3 rounded-lg text-center">
                            <div class="text-blue-600 font-bold">{{ $categories->count() }}</div>
                            <div class="text-gray-600">Kategori</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="lg:col-span-3">
            @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach($products as $product)
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover-lift group border border-gray-100 overflow-hidden">
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
                        
                        <!-- Category Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="bg-blue-500/90 text-white text-xs px-3 py-2 rounded-full font-semibold backdrop-blur-sm flex items-center gap-1">
                                <i class="fas fa-tag text-xs"></i>
                                {{ $product->category->name }}
                            </span>
                        </div>

                        <!-- Stock Badge -->
                        <div class="absolute top-4 right-4">
                            @if($product->stock > 10)
                                <span class="bg-green-500 text-white text-xs px-3 py-2 rounded-full font-semibold shadow-lg flex items-center gap-1">
                                    <i class="fas fa-check"></i>
                                    Tersedia
                                </span>
                            @elseif($product->stock > 0)
                                <span class="bg-yellow-500 text-white text-xs px-3 py-2 rounded-full font-semibold shadow-lg flex items-center gap-1">
                                    <i class="fas fa-exclamation"></i>
                                    Stok Menipis
                                </span>
                            @else
                                <span class="bg-red-500 text-white text-xs px-3 py-2 rounded-full font-semibold shadow-lg flex items-center gap-1">
                                    <i class="fas fa-times"></i>
                                    Habis
                                </span>
                            @endif
                        </div>

                        <!-- Quick Actions -->
                        <div class="absolute bottom-4 left-4 right-4 opacity-0 group-hover:opacity-100 transition duration-300">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('products.show', $product) }}" 
                                   class="bg-white/90 text-gray-700 px-4 py-2 rounded-full text-sm font-semibold backdrop-blur-sm hover:bg-white transition">
                                    <i class="fas fa-eye mr-1"></i> Preview
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2 text-gray-800 line-clamp-2 group-hover:text-blue-600 transition-colors">
                            {{ $product->name }}
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2 leading-relaxed">
                            {{ $product->description }}
                        </p>
                        
                        <!-- Price & Stock -->
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <span class="text-2xl font-bold text-green-600">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                                @if($product->stock > 0)
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $product->stock }} unit tersedia
                                    </p>
                                @endif
                            </div>
                            @if($product->stock > 0)
                                <div class="text-right">
                                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-check text-green-600 text-lg"></i>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3">
                            <a href="{{ route('products.show', $product) }}" 
                               class="flex-1 text-center bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 py-3 px-4 rounded-xl hover:from-gray-200 hover:to-gray-300 transition-all duration-300 transform hover:scale-105 font-semibold group flex items-center justify-center gap-2">
                                <i class="fas fa-info-circle"></i>
                                <span>Detail</span>
                            </a>
                            
                            @auth
                                @if($product->stock > 0)
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
                @endforeach
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
            <div class="mt-12 bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        Menampilkan {{ $products->firstItem() }} - {{ $products->lastItem() }} dari {{ $products->total() }} produk
                    </div>
                    <div class="flex gap-2">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
            @endif

            @else
            <!-- Empty State -->
            <div class="bg-white rounded-2xl shadow-xl p-12 text-center animate-fade-in">
                <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                    <i class="fas fa-search text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Produk Tidak Ditemukan</h3>
                <p class="text-gray-600 text-lg mb-8 max-w-md mx-auto">
                    @if(request('search') || request('category'))
                        Maaf, tidak ada produk yang sesuai dengan pencarian Anda. Coba kata kunci lain atau lihat semua kategori.
                    @else
                        Belum ada produk yang tersedia saat ini. Silakan kembali nanti.
                    @endif
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('products.index') }}" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-redo mr-2"></i>
                        Lihat Semua Produk
                    </a>
                    <a href="{{ route('home') }}" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 font-semibold rounded-xl hover:from-gray-200 hover:to-gray-300 transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-home mr-2"></i>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Custom pagination styles */
.pagination {
    display: flex;
    gap: 0.5rem;
}

.page-item {
    display: inline-block;
}

.page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 0.75rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #3b82f6, #8b5cf6);
    color: white;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.page-item:not(.active) .page-link {
    background: #f8fafc;
    color: #64748b;
    border: 1px solid #e2e8f0;
}

.page-item:not(.active) .page-link:hover {
    background: #3b82f6;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
}

.page-item.disabled .page-link {
    background: #f1f5f9;
    color: #94a3b8;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
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
    document.querySelectorAll('.bg-white.rounded-2xl').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.6s ease';
        observer.observe(card);
    });

    // Add loading state to buttons
    const buyButtons = document.querySelectorAll('form button[type="submit"]');
    buyButtons.forEach(button => {
        button.addEventListener('click', function() {
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menambahkan...';
            this.disabled = true;
            
            // Reset after 3 seconds (in case of error)
            setTimeout(() => {
                this.innerHTML = originalText;
                this.disabled = false;
            }, 3000);
        });
    });
});
</script>
@endsection