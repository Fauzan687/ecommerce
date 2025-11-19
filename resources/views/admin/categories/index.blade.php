@extends('layouts.app')

@section('title', 'Kelola Kategori - TokoOnlineSMK')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 animate-fade-in">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2">
                🏷️ Kelola Kategori
            </h1>
            <p class="text-gray-600">Kelola semua kategori produk di toko online Anda</p>
        </div>
        
        <a href="{{ route('admin.categories.create') }}" 
           class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 font-semibold shadow-lg hover:shadow-xl flex items-center justify-center gap-2 group">
            <i class="fas fa-plus-circle group-hover:scale-110 transition"></i>
            <span>Tambah Kategori</span>
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white p-4 rounded-2xl shadow-lg animate-slide-down mb-6" role="alert">
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

    @if($categories->count() > 0)
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 animate-fade-in" style="animation-delay: 0.1s;">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white text-center transform hover:scale-105 transition duration-300 shadow-lg">
            <div class="text-3xl font-bold mb-2">{{ $categories->count() }}</div>
            <div class="text-blue-100 flex items-center justify-center gap-2">
                <i class="fas fa-tags"></i>
                <span>Total Kategori</span>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white text-center transform hover:scale-105 transition duration-300 shadow-lg">
            @php
                $totalProducts = $categories->sum('products_count');
            @endphp
            <div class="text-3xl font-bold mb-2">{{ $totalProducts }}</div>
            <div class="text-green-100 flex items-center justify-center gap-2">
                <i class="fas fa-box"></i>
                <span>Total Produk</span>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white text-center transform hover:scale-105 transition duration-300 shadow-lg">
            @php
                $avgProducts = $totalProducts > 0 ? round($totalProducts / $categories->count(), 1) : 0;
            @endphp
            <div class="text-3xl font-bold mb-2">{{ $avgProducts }}</div>
            <div class="text-purple-100 flex items-center justify-center gap-2">
                <i class="fas fa-chart-bar"></i>
                <span>Rata-rata Produk</span>
            </div>
        </div>
    </div>

    <!-- Categories Table -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in" style="animation-delay: 0.2s;">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-gray-800 to-gray-900 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold text-sm uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-tag"></i>
                                <span>Nama Kategori</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left font-semibold text-sm uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-link"></i>
                                <span>Slug</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left font-semibold text-sm uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-box"></i>
                                <span>Jumlah Produk</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left font-semibold text-sm uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-cog"></i>
                                <span>Aksi</span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($categories as $category)
                    <tr class="hover:bg-gray-50 transition duration-300 group">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-folder text-white text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $category->name }}</div>
                                    <div class="text-xs text-gray-500">Dibuat: {{ $category->created_at->format('d M Y') }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <code class="text-sm bg-gray-100 text-gray-800 px-2 py-1 rounded font-mono">
                                {{ $category->slug }}
                            </code>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold 
                                    {{ $category->products_count > 0 ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $category->products_count }}
                                </span>
                                <span class="text-sm text-gray-600">produk</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.categories.edit', $category) }}" 
                                   class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white px-4 py-2 rounded-lg hover:from-yellow-600 hover:to-yellow-700 transition-all duration-300 transform hover:scale-105 font-semibold text-sm flex items-center gap-2 group">
                                    <i class="fas fa-edit group-hover:scale-110 transition"></i>
                                    <span>Edit</span>
                                </a>
                                
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-gradient-to-r from-red-500 to-red-600 text-white px-4 py-2 rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 transform hover:scale-105 font-semibold text-sm flex items-center gap-2 group delete-category"
                                            data-name="{{ $category->name }}"
                                            data-products="{{ $category->products_count }}">
                                        <i class="fas fa-trash group-hover:scale-110 transition"></i>
                                        <span>Hapus</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Empty State for Table (if no categories) -->
    @else
    <div class="bg-white rounded-2xl shadow-xl p-12 text-center animate-fade-in">
        <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
            <i class="fas fa-tags text-gray-400 text-3xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-3">Belum Ada Kategori</h3>
        <p class="text-gray-600 text-lg mb-8 max-w-md mx-auto">
            Mulai dengan membuat kategori pertama untuk mengorganisir produk-produk Anda.
        </p>
        <a href="{{ route('admin.categories.create') }}" 
           class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 shadow-lg group">
            <i class="fas fa-plus-circle mr-3 group-hover:scale-110 transition"></i>
            <span>Buat Kategori Pertama</span>
        </a>
        
        <!-- Quick Tips -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
            <div class="text-left p-6 bg-blue-50 rounded-2xl">
                <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-lightbulb text-white"></i>
                </div>
                <h4 class="font-semibold text-gray-800 mb-2">Tips Organisasi</h4>
                <p class="text-gray-600 text-sm">Buat kategori yang jelas untuk memudahkan pelanggan menemukan produk</p>
            </div>
            
            <div class="text-left p-6 bg-green-50 rounded-2xl">
                <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-sitemap text-white"></i>
                </div>
                <h4 class="font-semibold text-gray-800 mb-2">Struktur yang Baik</h4>
                <p class="text-gray-600 text-sm">Kelompokkan produk serupa dalam kategori yang sama untuk navigasi yang lebih baik</p>
            </div>
        </div>
    </div>
    @endif
</div>

<style>
.animate-fade-in {
    animation: fadeIn 0.6s ease-out;
}

.animate-slide-down {
    animation: slideDown 0.3s ease-out;
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

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced delete confirmation
    const deleteButtons = document.querySelectorAll('.delete-category');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const categoryName = this.getAttribute('data-name');
            const productsCount = this.getAttribute('data-products');
            
            let message = `Apakah Anda yakin ingin menghapus kategori "${categoryName}"?`;
            
            if (productsCount > 0) {
                message += `\n\nPERINGATAN: Kategori ini memiliki ${productsCount} produk. Menghapus kategori akan mempengaruhi produk yang terkait.`;
            }
            
            if (confirm(message)) {
                this.closest('form').submit();
            }
        });
    });

    // Add loading state to buttons
    const actionButtons = document.querySelectorAll('a[href*="edit"], button[type="submit"]');
    actionButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!this.classList.contains('delete-category')) {
                const originalHTML = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
                this.disabled = true;
                
                // Reset after 3 seconds (in case of slow loading)
                setTimeout(() => {
                    this.innerHTML = originalHTML;
                    this.disabled = false;
                }, 3000);
            }
        });
    });

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