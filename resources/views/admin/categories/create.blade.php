@extends('layouts.app')

@section('title', 'Tambah Kategori - TokoOnlineSMK')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="mb-8 animate-fade-in">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('admin.categories.index') }}" 
               class="flex items-center gap-2 text-blue-600 hover:text-blue-700 transition group">
                <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                <span>Kembali ke Daftar Kategori</span>
            </a>
        </div>
        
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                <i class="fas fa-plus text-white text-lg"></i>
            </div>
            <div>
                <h1 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    Tambah Kategori Baru
                </h1>
                <p class="text-gray-600 mt-1">Buat kategori baru untuk mengorganisir produk Anda</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <!-- Create Form -->
            <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 animate-fade-in" style="animation-delay: 0.1s;">
                <form action="{{ route('admin.categories.store') }}" method="POST" id="categoryForm">
                    @csrf

                    <!-- Form Header -->
                    <div class="flex items-center gap-3 mb-6 pb-6 border-b border-gray-200">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-tags text-blue-600"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Informasi Kategori Baru</h2>
                            <p class="text-sm text-gray-600">Isi detail kategori yang ingin dibuat</p>
                        </div>
                    </div>

                    <!-- Name Field -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                            <i class="fas fa-font text-blue-500"></i>
                            <span>Nama Kategori</span>
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name') }}" 
                                   required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 text-gray-900 placeholder-gray-400"
                                   placeholder="Contoh: Elektronik, Pakaian, Makanan"
                                   autofocus>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <i class="fas fa-folder text-gray-400"></i>
                            </div>
                        </div>
                        @error('name')
                            <div class="flex items-center gap-2 mt-2 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @else
                            <div class="flex items-center gap-2 mt-2 text-gray-500 text-sm">
                                <i class="fas fa-info-circle"></i>
                                <span>Gunakan nama yang jelas dan mudah dipahami</span>
                            </div>
                        @enderror
                        
                        <!-- Slug Preview -->
                        <div class="mt-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <i class="fas fa-link text-gray-400"></i>
                                <span>Slug akan otomatis dihasilkan:</span>
                                <code class="bg-white px-2 py-1 rounded border text-gray-800 font-mono text-sm" id="slugPreview">
                                    {{ old('name') ? Str::slug(old('name')) : 'nama-kategori' }}
                                </code>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                        <button type="submit" 
                                class="flex-1 bg-gradient-to-r from-green-500 to-green-600 text-white py-4 px-6 rounded-xl hover:from-green-600 hover:to-green-700 transition-all duration-300 transform hover:scale-105 font-semibold shadow-lg hover:shadow-xl flex items-center justify-center gap-3 group">
                            <i class="fas fa-plus-circle group-hover:scale-110 transition"></i>
                            <span class="text-lg">Buat Kategori</span>
                        </button>
                        
                        <a href="{{ route('admin.categories.index') }}" 
                           class="flex-1 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 py-4 px-6 rounded-xl hover:from-gray-200 hover:to-gray-300 transition-all duration-300 transform hover:scale-105 font-semibold text-center flex items-center justify-center gap-3 group">
                            <i class="fas fa-times group-hover:scale-110 transition"></i>
                            <span class="text-lg">Batal</span>
                        </a>
                    </div>
                </form>
            </div>

            <!-- Success Message (if any) -->
            @if(session('success'))
                <div class="mt-6 bg-gradient-to-r from-green-500 to-emerald-600 text-white p-4 rounded-2xl shadow-lg animate-slide-down" role="alert">
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
        </div>

        <!-- Sidebar -->
        <div class="space-y-6 animate-fade-in" style="animation-delay: 0.2s;">
            <!-- Quick Stats -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
                <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-chart-bar text-blue-500"></i>
                    <span>Statistik Kategori</span>
                </h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Total Kategori</span>
                        <span class="font-semibold text-gray-900">{{ \App\Models\Category::count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Total Produk</span>
                        <span class="font-semibold text-gray-900">{{ \App\Models\Product::count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Rata-rata Produk</span>
                        <span class="font-semibold text-gray-900">
                            @php
                                $totalCategories = \App\Models\Category::count();
                                $totalProducts = \App\Models\Product::count();
                                $avgProducts = $totalCategories > 0 ? round($totalProducts / $totalCategories, 1) : 0;
                            @endphp
                            {{ $avgProducts }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Tips & Best Practices -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200">
                <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-lightbulb text-yellow-500"></i>
                    <span>Tips Kategori</span>
                </h3>
                <ul class="space-y-3 text-sm text-gray-700">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Gunakan nama yang singkat dan jelas</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Hindari duplikasi nama kategori</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Pertimbangkan hierarki kategori jika diperlukan</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Gunakan kata kunci yang relevan</span>
                    </li>
                </ul>
            </div>

            <!-- Popular Categories -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
                <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-fire text-red-500"></i>
                    <span>Kategori Populer</span>
                </h3>
                <div class="space-y-3">
                    @php
                        $popularCategories = \App\Models\Category::withCount('products')
                            ->orderBy('products_count', 'desc')
                            ->take(5)
                            ->get();
                    @endphp
                    
                    @foreach($popularCategories as $popularCategory)
                    <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-lg transition">
                        <span class="text-sm text-gray-700">{{ $popularCategory->name }}</span>
                        <span class="bg-blue-100 text-blue-600 text-xs px-2 py-1 rounded-full">
                            {{ $popularCategory->products_count }}
                        </span>
                    </div>
                    @endforeach
                    
                    @if($popularCategories->isEmpty())
                    <div class="text-center py-4 text-gray-500 text-sm">
                        <i class="fas fa-inbox text-2xl mb-2"></i>
                        <p>Belum ada kategori</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
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

/* Smooth focus transitions */
input:focus {
    transform: translateY(-1px);
    box-shadow: 0 10px 25px rgba(59, 130, 246, 0.1);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Real-time slug preview
    const nameInput = document.getElementById('name');
    const slugPreview = document.getElementById('slugPreview');
    
    nameInput.addEventListener('input', function() {
        const slug = this.value
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
        
        slugPreview.textContent = slug || 'nama-kategori';
    });

    // Form submission loading state
    const form = document.getElementById('categoryForm');
    const submitButton = form.querySelector('button[type="submit"]');
    
    form.addEventListener('submit', function(e) {
        const originalHTML = submitButton.innerHTML;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Membuat...';
        submitButton.disabled = true;
        
        // Reset after 5 seconds (in case of error)
        setTimeout(() => {
            submitButton.innerHTML = originalHTML;
            submitButton.disabled = false;
        }, 5000);
    });

    // Auto-focus on name input
    nameInput.focus();

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