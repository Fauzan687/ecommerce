@extends('layouts.app')

@section('title', 'Edit Kategori - TokoOnlineSMK')

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
            <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center">
                <i class="fas fa-edit text-white text-lg"></i>
            </div>
            <div>
                <h1 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    Edit Kategori
                </h1>
                <p class="text-gray-600 mt-1">Perbarui informasi kategori "{{ $category->name }}"</p>
            </div>
        </div>
    </div>

    <!-- Category Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 animate-fade-in" style="animation-delay: 0.1s;">
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-folder text-white"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Nama Kategori Saat Ini</p>
                    <p class="font-semibold text-gray-900">{{ $category->name }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 border border-green-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-box text-white"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Jumlah Produk</p>
                    <p class="font-semibold text-gray-900">{{ $category->products_count }} produk</p>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6 border border-purple-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar text-white"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Terakhir Diupdate</p>
                    <p class="font-semibold text-gray-900">{{ $category->updated_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 animate-fade-in" style="animation-delay: 0.2s;">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Form Header -->
            <div class="flex items-center gap-3 mb-6 pb-6 border-b border-gray-200">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-tags text-blue-600"></i>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Informasi Kategori</h2>
                    <p class="text-sm text-gray-600">Perbarui detail kategori Anda</p>
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
                           value="{{ old('name', $category->name) }}" 
                           required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 text-gray-900 placeholder-gray-400"
                           placeholder="Masukkan nama kategori"
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
                @enderror
                
                <!-- Slug Preview -->
                <div class="mt-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <i class="fas fa-link text-gray-400"></i>
                        <span>Slug akan otomatis dihasilkan:</span>
                        <code class="bg-white px-2 py-1 rounded border text-gray-800 font-mono text-sm" id="slugPreview">
                            {{ old('name', $category->slug) ? Str::slug(old('name', $category->name)) : $category->slug }}
                        </code>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                <button type="submit" 
                        class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 text-white py-4 px-6 rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 font-semibold shadow-lg hover:shadow-xl flex items-center justify-center gap-3 group">
                    <i class="fas fa-save group-hover:scale-110 transition"></i>
                    <span class="text-lg">Update Kategori</span>
                </button>
                
                <a href="{{ route('admin.categories.index') }}" 
                   class="flex-1 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 py-4 px-6 rounded-xl hover:from-gray-200 hover:to-gray-300 transition-all duration-300 transform hover:scale-105 font-semibold text-center flex items-center justify-center gap-3 group">
                    <i class="fas fa-times group-hover:scale-110 transition"></i>
                    <span class="text-lg">Batal</span>
                </a>
            </div>
        </form>
    </div>

    <!-- Warning Section -->
    @if($category->products_count > 0)
    <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-2xl p-6 animate-fade-in" style="animation-delay: 0.3s;">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 bg-yellow-500 rounded-lg flex items-center justify-center flex-shrink-0">
                <i class="fas fa-exclamation-triangle text-white"></i>
            </div>
            <div>
                <h3 class="font-semibold text-yellow-800 mb-2">Perhatian</h3>
                <p class="text-yellow-700 text-sm">
                    Kategori ini memiliki <strong>{{ $category->products_count }} produk</strong>. 
                    Mengubah nama kategori akan mempengaruhi semua produk yang terkait. 
                    Pastikan perubahan ini diperlukan.
                </p>
            </div>
        </div>
    </div>
    @endif

    <!-- Quick Actions -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6 animate-fade-in" style="animation-delay: 0.4s;">
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
            <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                <i class="fas fa-clock-rotate-left text-blue-500"></i>
                <span>Riwayat Perubahan</span>
            </h3>
            <div class="space-y-3 text-sm text-gray-600">
                <div class="flex justify-between">
                    <span>Dibuat pada</span>
                    <span class="font-medium text-gray-900">{{ $category->created_at->format('d M Y H:i') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Terakhir diupdate</span>
                    <span class="font-medium text-gray-900">{{ $category->updated_at->format('d M Y H:i') }}</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
            <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                <i class="fas fa-shield-alt text-green-500"></i>
                <span>Tips Keamanan</span>
            </h3>
            <ul class="space-y-2 text-sm text-gray-600">
                <li class="flex items-start gap-2">
                    <i class="fas fa-check text-green-500 mt-1"></i>
                    <span>Gunakan nama yang jelas dan deskriptif</span>
                </li>
                <li class="flex items-start gap-2">
                    <i class="fas fa-check text-green-500 mt-1"></i>
                    <span>Hindari karakter khusus dalam nama</span>
                </li>
                <li class="flex items-start gap-2">
                    <i class="fas fa-check text-green-500 mt-1"></i>
                    <span>Pastikan nama kategori unik</span>
                </li>
            </ul>
        </div>
    </div>
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
        
        slugPreview.textContent = slug || '{{ $category->slug }}';
    });

    // Form submission loading state
    const form = document.querySelector('form');
    const submitButton = form.querySelector('button[type="submit"]');
    
    form.addEventListener('submit', function(e) {
        const originalHTML = submitButton.innerHTML;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memperbarui...';
        submitButton.disabled = true;
        
        // Reset after 5 seconds (in case of error)
        setTimeout(() => {
            submitButton.innerHTML = originalHTML;
            submitButton.disabled = false;
        }, 5000);
    });

    // Auto-focus on name input
    nameInput.focus();
    nameInput.select();
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