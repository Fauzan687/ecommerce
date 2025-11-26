@extends('layouts.app')

@section('title', 'Kelola Produk - TokoOnlineSMK')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2">
                📦 Kelola Produk
            </h1>
            <p class="text-gray-600">Kelola semua produk di toko online Anda</p>
        </div>
        
        <a href="{{ route('admin.products.create') }}" 
           class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 font-semibold shadow-lg hover:shadow-xl flex items-center justify-center gap-2 group">
            <i class="fas fa-plus-circle group-hover:scale-110 transition"></i>
            <span>Tambah Produk Baru</span>
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white p-4 rounded-2xl shadow-lg mb-6" role="alert">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <i class="fas fa-check-circle text-xl"></i>
                    <p class="font-semibold">{{ session('success') }}</p>
                </div>
                <button type="button" onclick="this.parentElement.parentElement.remove()" class="text-white hover:text-green-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white text-center transform hover:scale-105 transition duration-300 shadow-lg cursor-pointer" onclick="filterProducts('all')">
            <div class="text-3xl font-bold mb-2">{{ $products->total() }}</div>
            <div class="text-blue-100 flex items-center justify-center gap-2">
                <i class="fas fa-box"></i>
                <span>Total Produk</span>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white text-center transform hover:scale-105 transition duration-300 shadow-lg cursor-pointer" onclick="filterProducts('in_stock')">
            @php
                $inStockCount = $products->where('stock', '>', 0)->count();
            @endphp
            <div class="text-3xl font-bold mb-2">{{ $inStockCount }}</div>
            <div class="text-green-100 flex items-center justify-center gap-2">
                <i class="fas fa-check-circle"></i>
                <span>Stok Tersedia</span>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl p-6 text-white text-center transform hover:scale-105 transition duration-300 shadow-lg cursor-pointer" onclick="filterProducts('low_stock')">
            @php
                $lowStockCount = $products->where('stock', '>', 0)->where('stock', '<=', 10)->count();
            @endphp
            <div class="text-3xl font-bold mb-2">{{ $lowStockCount }}</div>
            <div class="text-yellow-100 flex items-center justify-center gap-2">
                <i class="fas fa-exclamation-triangle"></i>
                <span>Stok Menipis</span>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-2xl p-6 text-white text-center transform hover:scale-105 transition duration-300 shadow-lg cursor-pointer" onclick="filterProducts('out_of_stock')">
            @php
                $outOfStockCount = $products->where('stock', 0)->count();
            @endphp
            <div class="text-3xl font-bold mb-2">{{ $outOfStockCount }}</div>
            <div class="text-red-100 flex items-center justify-center gap-2">
                <i class="fas fa-times-circle"></i>
                <span>Stok Habis</span>
            </div>
        </div>
    </div>

    @if($products->count() > 0)
    <!-- Products Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @foreach($products as $product)
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden product-card" 
             data-stock="{{ $product->stock }}" 
             data-category="{{ $product->category->name }}">
            <!-- Product Image -->
            <div class="relative h-48 bg-gradient-to-br from-gray-50 to-gray-100 overflow-hidden">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-full object-cover transition duration-700 product-image">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                        <i class="fas fa-image text-4xl"></i>
                    </div>
                @endif
                
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

                <!-- Category Badge -->
                <div class="absolute top-4 left-4">
                    <span class="bg-blue-500/90 text-white text-xs px-3 py-2 rounded-full font-semibold backdrop-blur-sm flex items-center gap-1">
                        <i class="fas fa-tag"></i>
                        {{ $product->category->name }}
                    </span>
                </div>

                <!-- Quick Actions Overlay -->
                <div class="absolute inset-0 bg-black/0 hover:bg-black/10 transition duration-300 flex items-end justify-center pb-4 opacity-0 hover:opacity-100">
                    <div class="flex justify-center gap-2">
                        <a href="{{ route('admin.products.edit', $product) }}" 
                           class="bg-white/90 text-blue-600 px-4 py-2 rounded-full text-sm font-semibold backdrop-blur-sm hover:bg-white transition flex items-center gap-2">
                            <i class="fas fa-edit"></i>
                            <span>Edit</span>
                        </a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-white/90 text-red-600 px-4 py-2 rounded-full text-sm font-semibold backdrop-blur-sm hover:bg-white transition flex items-center gap-2 delete-product"
                                    data-name="{{ $product->name }}">
                                <i class="fas fa-trash"></i>
                                <span>Hapus</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="p-6">
                <h3 class="font-bold text-xl mb-3 text-gray-800 line-clamp-2">
                    {{ $product->name }}
                </h3>
                <p class="text-gray-600 text-sm mb-4 line-clamp-2 leading-relaxed">
                    {{ $product->description }}
                </p>
                
                <!-- Price & Stock -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <span class="text-2xl font-bold text-green-600">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </span>
                        <p class="text-sm text-gray-500 mt-1">
                            Stok: <span class="font-semibold {{ $product->stock > 10 ? 'text-green-600' : ($product->stock > 0 ? 'text-yellow-600' : 'text-red-600') }}">
                                {{ $product->stock }} unit
                            </span>
                        </p>
                    </div>
                    @if($product->stock > 0)
                        <div class="text-right">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-green-600 text-lg"></i>
                            </div>
                        </div>
                    @else
                        <div class="text-right">
                            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-times text-red-600 text-lg"></i>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.products.edit', $product) }}" 
                       class="flex-1 text-center bg-gradient-to-r from-yellow-500 to-yellow-600 text-white py-3 px-4 rounded-xl hover:from-yellow-600 hover:to-yellow-700 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                        <i class="fas fa-edit"></i>
                        <span>Edit</span>
                    </a>
                    
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-red-500 to-red-600 text-white py-3 px-4 rounded-xl hover:from-red-600 hover:to-red-700 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl flex items-center justify-center gap-2 delete-product"
                                data-name="{{ $product->name }}">
                            <i class="fas fa-trash"></i>
                            <span>Hapus</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
    <div class="mt-8 flex justify-center">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            {{ $products->links() }}
        </div>
    </div>
    @endif

    @else
    <!-- Empty State -->
    <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
        <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
            <i class="fas fa-box-open text-gray-400 text-3xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-3">Belum Ada Produk</h3>
        <p class="text-gray-600 text-lg mb-8 max-w-md mx-auto">
            Mulai dengan menambahkan produk pertama Anda untuk dijual di toko online.
        </p>
        <a href="{{ route('admin.products.create') }}" 
           class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-lg group">
            <i class="fas fa-plus-circle mr-3"></i>
            <span>Tambah Produk Pertama</span>
        </a>
        
        <!-- Quick Tips -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
            <div class="text-center p-6 bg-blue-50 rounded-2xl">
                <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-upload text-white"></i>
                </div>
                <h4 class="font-semibold text-gray-800 mb-2">Upload Gambar</h4>
                <p class="text-gray-600 text-sm">Gunakan gambar produk yang jelas dan menarik</p>
            </div>
            
            <div class="text-center p-6 bg-green-50 rounded-2xl">
                <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-tags text-white"></i>
                </div>
                <h4 class="font-semibold text-gray-800 mb-2">Kategori yang Tepat</h4>
                <p class="text-gray-600 text-sm">Kelompokkan produk dalam kategori yang sesuai</p>
            </div>
            
            <div class="text-center p-6 bg-purple-50 rounded-2xl">
                <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-chart-line text-white"></i>
                </div>
                <h4 class="font-semibold text-gray-800 mb-2">Update Stok</h4>
                <p class="text-gray-600 text-sm">Pantau dan perbarui stok secara berkala</p>
            </div>
        </div>
    </div>
    @endif
</div>

<style>
/* Smooth transitions */
.product-card {
    transition: all 0.3s ease;
    transform: translateY(0);
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

/* Ensure images are properly contained */
.product-image {
    object-fit: cover;
    width: 100%;
    height: 100%;
    display: block;
}

/* Image container fix */
.relative.h-48 {
    position: relative;
    height: 12rem; /* 48 * 0.25rem = 12rem */
    overflow: hidden;
}

/* Line clamp utilities */
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

/* Animation for new elements */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in-up {
    animation: fadeInUp 0.5s ease-out;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced delete confirmation
    const deleteButtons = document.querySelectorAll('.delete-product');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const productName = this.getAttribute('data-name');
            const confirmation = confirm(`Apakah Anda yakin ingin menghapus produk "${productName}"?`);
            
            if (confirmation) {
                // Add loading state
                const originalHTML = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menghapus...';
                this.disabled = true;
                
                // Submit the form
                this.closest('form').submit();
            }
        });
    });

    // Filter products by stock status
    window.filterProducts = function(status) {
        const productCards = document.querySelectorAll('.product-card');
        
        productCards.forEach(card => {
            const stock = parseInt(card.getAttribute('data-stock'));
            let show = false;
            
            switch(status) {
                case 'all':
                    show = true;
                    break;
                case 'in_stock':
                    show = stock > 0;
                    break;
                case 'low_stock':
                    show = stock > 0 && stock <= 10;
                    break;
                case 'out_of_stock':
                    show = stock === 0;
                    break;
            }
            
            if (show) {
                card.style.display = 'block';
                card.classList.add('fade-in-up');
            } else {
                card.style.display = 'none';
            }
        });
        
        // Update active filter indicator
        document.querySelectorAll('.bg-gradient-to-br').forEach(card => {
            card.classList.remove('ring-2', 'ring-white', 'ring-offset-2');
        });
        event.currentTarget.classList.add('ring-2', 'ring-white', 'ring-offset-2');
    };

    // Auto-hide success message after 5 seconds
    const successMessage = document.querySelector('[role="alert"]');
    if (successMessage) {
        setTimeout(() => {
            successMessage.style.transition = 'all 0.5s ease';
            successMessage.style.opacity = '0';
            successMessage.style.transform = 'translateY(-20px)';
            setTimeout(() => successMessage.remove(), 500);
        }, 5000);
    }

    // Add smooth scroll behavior
    document.documentElement.style.scrollBehavior = 'smooth';

    // Initialize product cards with fade-in animation
    const productCards = document.querySelectorAll('.product-card');
    productCards.forEach(card => {
        card.classList.add('fade-in-up');
    });
});

// Simple intersection observer for basic animations
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, {
    threshold: 0.1
});

// Observe product cards
document.querySelectorAll('.product-card').forEach(card => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(20px)';
    card.style.transition = 'all 0.6s ease';
    observer.observe(card);
});
</script>
@endsection