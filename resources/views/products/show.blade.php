@extends('layouts.app')

@section('title', $product->name . ' - TokoOnlineSMK')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-8 animate-fade-in" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-2 text-sm">
            <li>
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-blue-600 transition flex items-center gap-1">
                    <i class="fas fa-home"></i>
                    Beranda
                </a>
            </li>
            <li class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            </li>
            <li>
                <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-blue-600 transition flex items-center gap-1">
                    <i class="fas fa-box"></i>
                    Produk
                </a>
            </li>
            <li class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            </li>
            <li>
                <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="text-gray-500 hover:text-blue-600 transition">
                    {{ $product->category->name }}
                </a>
            </li>
            <li class="flex items-center">
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            </li>
            <li class="text-gray-700 font-medium truncate max-w-xs">
                {{ $product->name }}
            </li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
        <!-- Product Images -->
        <div class="space-y-4 animate-fade-in">
            <!-- Main Image -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden group">
                <div class="relative h-96 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-700"
                             id="mainImage">
                    @else
                        <div class="text-center text-gray-400">
                            <i class="fas fa-image text-6xl mb-4"></i>
                            <p class="text-lg">Gambar tidak tersedia</p>
                        </div>
                    @endif
                    
                    <!-- Image Overlay Actions -->
                    <div class="absolute top-4 right-4 flex gap-2">
                        @if($product->isInStock())
                            @if($product->stock > 10)
                                <span class="bg-green-500 text-white px-3 py-2 rounded-full text-sm font-semibold shadow-lg flex items-center gap-1">
                                    <i class="fas fa-check"></i>
                                    Tersedia
                                </span>
                            @else
                                <span class="bg-yellow-500 text-white px-3 py-2 rounded-full text-sm font-semibold shadow-lg flex items-center gap-1">
                                    <i class="fas fa-exclamation"></i>
                                    Stok Menipis
                                </span>
                            @endif
                        @else
                            <span class="bg-red-500 text-white px-3 py-2 rounded-full text-sm font-semibold shadow-lg flex items-center gap-1">
                                <i class="fas fa-times"></i>
                                Habis
                            </span>
                        @endif
                    </div>

                    <!-- Category Badge -->
                    <div class="absolute top-4 left-4">
                        <span class="bg-blue-500/90 text-white px-4 py-2 rounded-full font-semibold backdrop-blur-sm flex items-center gap-2">
                            <i class="fas fa-tag"></i>
                            {{ $product->category->name }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Info -->
        <div class="space-y-6 animate-fade-in" style="animation-delay: 0.2s;">
            <!-- Product Header -->
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                    {{ $product->name }}
                </h1>

                <!-- Price -->
                <div class="flex items-baseline gap-3 mb-4">
                    <span class="text-4xl font-bold text-green-600">
                        {{ $product->formatted_price }}
                    </span>
                </div>

                <!-- Stock Info -->
                <div class="flex items-center gap-4 text-sm text-gray-600 mb-6">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-box text-blue-500"></i>
                        <span>{{ $product->stock }} unit tersedia</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-cube text-purple-500"></i>
                        <span>Kategori: {{ $product->category->name }}</span>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="bg-gray-50 rounded-2xl p-6">
                <h3 class="font-semibold text-lg mb-3 text-gray-900 flex items-center gap-2">
                    <i class="fas fa-file-alt text-blue-500"></i>
                    Deskripsi Produk
                </h3>
                <p class="text-gray-700 leading-relaxed">
                    {{ $product->description }}
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-4 pt-4">
                @if($product->isInStock())
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <!-- Quantity Selector -->
                    <div class="flex items-center gap-4">
                        <label class="font-semibold text-gray-700">Jumlah:</label>
                        <div class="flex items-center border border-gray-300 rounded-xl overflow-hidden">
                            <button type="button" class="w-12 h-12 flex items-center justify-center bg-gray-100 hover:bg-gray-200 transition" onclick="decreaseQuantity()">
                                <i class="fas fa-minus text-gray-600"></i>
                            </button>
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                   class="w-16 h-12 text-center border-0 focus:ring-0 focus:outline-none text-lg font-semibold">
                            <button type="button" class="w-12 h-12 flex items-center justify-center bg-gray-100 hover:bg-gray-200 transition" onclick="increaseQuantity()">
                                <i class="fas fa-plus text-gray-600"></i>
                            </button>
                        </div>
                        <span class="text-sm text-gray-500">Maks: {{ $product->stock }} unit</span>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4">
                        <button type="submit" 
                                class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 text-white py-4 px-6 rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 font-semibold shadow-lg hover:shadow-xl flex items-center justify-center gap-3 group">
                            <i class="fas fa-cart-plus text-xl group-hover:scale-110 transition"></i>
                            <span class="text-lg">Tambah ke Keranjang</span>
                        </button>
                    </div>
                </form>
                @else
                <div class="text-center space-y-4">
                    <div class="bg-red-50 border border-red-200 rounded-2xl p-6">
                        <i class="fas fa-times-circle text-red-500 text-4xl mb-3"></i>
                        <p class="text-red-600 font-semibold text-lg">Produk Sedang Habis</p>
                        <p class="text-red-500 text-sm mt-1">Silakan cek kembali nanti</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
    <section class="mt-16 animate-fade-in" style="animation-delay: 0.4s;">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
                <i class="fas fa-cube text-blue-500"></i>
                Produk Lainnya di Kategori {{ $product->category->name }}
            </h2>
            <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" 
               class="text-blue-600 hover:text-blue-700 font-semibold flex items-center gap-2">
                Lihat Semua
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedProducts as $relatedProduct)
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover-lift group border border-gray-100 overflow-hidden">
                <div class="relative h-48 bg-gradient-to-br from-gray-50 to-gray-100 overflow-hidden">
                    @if($relatedProduct->image)
                        <img src="{{ asset('storage/' . $relatedProduct->image) }}" 
                             alt="{{ $relatedProduct->name }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <i class="fas fa-image text-2xl"></i>
                        </div>
                    @endif
                    
                    <div class="absolute top-3 left-3">
                        <span class="bg-blue-500/90 text-white text-xs px-2 py-1 rounded-full font-semibold backdrop-blur-sm">
                            {{ $relatedProduct->category->name }}
                        </span>
                    </div>
                </div>

                <div class="p-4">
                    <h3 class="font-semibold text-gray-800 mb-2 line-clamp-2 text-sm">
                        {{ $relatedProduct->name }}
                    </h3>
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-green-600 font-bold">{{ $relatedProduct->formatted_price }}</span>
                        @if($relatedProduct->isInStock())
                            <span class="text-xs text-green-600 bg-green-50 px-2 py-1 rounded-full">
                                <i class="fas fa-check mr-1"></i>Tersedia
                            </span>
                        @else
                            <span class="text-xs text-red-600 bg-red-50 px-2 py-1 rounded-full">
                                <i class="fas fa-times mr-1"></i>Habis
                            </span>
                        @endif
                    </div>
                    <a href="{{ route('products.show', $relatedProduct) }}" 
                       class="w-full bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 py-2 px-4 rounded-xl hover:from-gray-200 hover:to-gray-300 transition-all duration-300 text-sm font-semibold text-center block">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Product Details -->
    <div class="mt-16 bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in" style="animation-delay: 0.6s;">
        <div class="border-b border-gray-200">
            <nav class="flex overflow-x-auto">
                <button class="tab-button active px-6 py-4 font-semibold text-gray-900 border-b-2 border-blue-500 transition whitespace-nowrap">
                    <i class="fas fa-info-circle mr-2"></i>Informasi Produk
                </button>
            </nav>
        </div>

        <div class="p-8">
            <div class="tab-content active">
                <h3 class="text-xl font-bold mb-6 text-gray-900">Detail Produk</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex justify-between py-3 border-b border-gray-100">
                            <span class="font-semibold text-gray-600">Nama Produk</span>
                            <span class="text-gray-900">{{ $product->name }}</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-100">
                            <span class="font-semibold text-gray-600">Kategori</span>
                            <span class="text-gray-900">{{ $product->category->name }}</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-100">
                            <span class="font-semibold text-gray-600">Harga</span>
                            <span class="text-gray-900 font-bold">{{ $product->formatted_price }}</span>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between py-3 border-b border-gray-100">
                            <span class="font-semibold text-gray-600">Stok Tersedia</span>
                            <span class="text-gray-900">{{ $product->stock }} unit</span>
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-100">
                            <span class="font-semibold text-gray-600">Status Stok</span>
                            @if($product->isInStock())
                                <span class="text-green-600 font-semibold">Tersedia</span>
                            @else
                                <span class="text-red-600 font-semibold">Habis</span>
                            @endif
                        </div>
                        <div class="flex justify-between py-3 border-b border-gray-100">
                            <span class="font-semibold text-gray-600">Ditambahkan</span>
                            <span class="text-gray-900">{{ $product->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Full Description -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h4 class="font-semibold text-lg mb-4 text-gray-900">Deskripsi Lengkap</h4>
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                        {{ $product->description }}
                    </p>
                </div>
            </div>
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

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
    animation: fadeIn 0.5s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<script>
// Quantity Controls
function increaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    const maxStock = {{ $product->stock }};
    if (parseInt(quantityInput.value) < maxStock) {
        quantityInput.value = parseInt(quantityInput.value) + 1;
    }
}

function decreaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    if (parseInt(quantityInput.value) > 1) {
        quantityInput.value = parseInt(quantityInput.value) - 1;
    }
}

// Tab functionality
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons and contents
            tabButtons.forEach(btn => {
                btn.classList.remove('active', 'text-gray-900', 'border-blue-500');
                btn.classList.add('text-gray-600');
            });
            tabContents.forEach(content => content.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active', 'text-gray-900', 'border-blue-500');
            this.classList.remove('text-gray-600');
            
            // Show corresponding content
            const tabIndex = Array.from(tabButtons).indexOf(this);
            if (tabContents[tabIndex]) {
                tabContents[tabIndex].classList.add('active');
            }
        });
    });

    // Add to cart animation
    const addToCartForm = document.querySelector('form[action*="cart.add"]');
    if (addToCartForm) {
        addToCartForm.addEventListener('submit', function(e) {
            const button = this.querySelector('button[type="submit"]');
            const originalText = button.innerHTML;
            
            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menambahkan...';
            button.disabled = true;
            
            // Revert after 3 seconds (in case of error)
            setTimeout(() => {
                button.innerHTML = originalText;
                button.disabled = false;
            }, 3000);
        });
    }
});

// Intersection Observer for animations
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

document.querySelectorAll('.animate-fade-in').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(20px)';
    el.style.transition = 'all 0.6s ease';
    observer.observe(el);
});
</script>
@endsection