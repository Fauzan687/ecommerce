@extends('layouts.app')

@section('title', 'Tambah Produk - TokoOnlineSMK')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('admin.products.index') }}" 
               class="flex items-center gap-2 text-blue-600 hover:text-blue-700 transition group">
                <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                <span>Kembali ke Daftar Produk</span>
            </a>
        </div>
        
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                <i class="fas fa-plus text-white text-lg"></i>
            </div>
            <div>
                <h1 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    Tambah Produk Baru
                </h1>
                <p class="text-gray-600 mt-1">Tambah produk baru ke katalog toko online Anda</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <!-- Create Form -->
            <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
                    @csrf

                    <!-- Form Header -->
                    <div class="flex items-center gap-3 mb-6 pb-6 border-b border-gray-200">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-box text-blue-600"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Informasi Produk Baru</h2>
                            <p class="text-sm text-gray-600">Isi detail produk yang ingin ditambahkan</p>
                        </div>
                    </div>

                    <!-- Name Field -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                            <i class="fas fa-tag text-blue-500"></i>
                            <span>Nama Produk</span>
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name') }}" 
                                   required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 text-gray-900 placeholder-gray-400"
                                   placeholder="Contoh: Laptop ASUS ROG, Kaos Polo Premium"
                                   autofocus>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <i class="fas fa-box text-gray-400"></i>
                            </div>
                        </div>
                        @error('name')
                            <div class="flex items-center gap-2 mt-2 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Description Field -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                            <i class="fas fa-align-left text-blue-500"></i>
                            <span>Deskripsi Produk</span>
                            <span class="text-red-500">*</span>
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="4" 
                                  required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 text-gray-900 placeholder-gray-400 resize-none"
                                  placeholder="Jelaskan detail produk, spesifikasi, keunggulan, dan manfaat...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="flex items-center gap-2 mt-2 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Price & Stock Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Price Field -->
                        <div>
                            <label for="price" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                                <i class="fas fa-dollar-sign text-green-500"></i>
                                <span>Harga Produk</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">Rp</span>
                                </div>
                                <input type="number" 
                                       name="price" 
                                       id="price" 
                                       value="{{ old('price') }}" 
                                       required 
                                       min="0" 
                                       step="0.01"
                                       class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 text-gray-900 placeholder-gray-400 no-spinner"
                                       placeholder="0.00">
                            </div>
                            @error('price')
                                <div class="flex items-center gap-2 mt-2 text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!-- Stock Field -->
                        <div>
                            <label for="stock" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                                <i class="fas fa-cubes text-orange-500"></i>
                                <span>Stok Awal</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="number" 
                                       name="stock" 
                                       id="stock" 
                                       value="{{ old('stock') }}" 
                                       required 
                                       min="0"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 text-gray-900 placeholder-gray-400 no-spinner"
                                       placeholder="Jumlah stok awal">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <span class="text-gray-500 text-sm">unit</span>
                                </div>
                            </div>
                            @error('stock')
                                <div class="flex items-center gap-2 mt-2 text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Category Field -->
                    <div class="mb-6">
                        <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                            <i class="fas fa-folder text-purple-500"></i>
                            <span>Kategori</span>
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="category_id" 
                                    id="category_id" 
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 text-gray-900 bg-white appearance-none">
                                <option value="">Pilih Kategori Produk</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </div>
                        </div>
                        @error('category_id')
                            <div class="flex items-center gap-2 mt-2 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Image Field -->
                    <div class="mb-6">
                        <label for="image" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                            <i class="fas fa-image text-pink-500"></i>
                            <span>Gambar Produk</span>
                        </label>
                        
                        <!-- Image Preview -->
                        <div class="mb-4 p-4 border-2 border-dashed border-gray-300 rounded-xl text-center hover:border-blue-400 transition duration-300 cursor-pointer" 
                             onclick="document.getElementById('image').click()">
                            <div class="py-8">
                                <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-3"></i>
                                <p class="text-gray-600 font-medium">Klik untuk upload gambar</p>
                                <p class="text-gray-500 text-sm mt-1">Format: JPG, PNG, GIF (Maks. 2MB)</p>
                            </div>
                        </div>

                        <!-- File Input -->
                        <input type="file" 
                               name="image" 
                               id="image" 
                               accept="image/jpeg,image/png,image/gif"
                               class="hidden"
                               onchange="previewImage(this)">
                        
                        <!-- Image Preview Container -->
                        <div id="imagePreview" class="hidden mt-4 p-4 bg-gray-50 rounded-xl border border-gray-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <img id="preview" class="w-16 h-16 object-cover rounded-lg" src="" alt="Preview">
                                    <div>
                                        <p class="font-medium text-gray-900" id="fileName"></p>
                                        <p class="text-sm text-gray-500" id="fileSize"></p>
                                    </div>
                                </div>
                                <button type="button" onclick="removeImage()" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        @error('image')
                            <div class="flex items-center gap-2 mt-2 text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                        <button type="submit" 
                                class="flex-1 bg-gradient-to-r from-green-500 to-green-600 text-white py-4 px-6 rounded-xl hover:from-green-600 hover:to-green-700 transition-all duration-300 transform hover:scale-105 font-semibold shadow-lg hover:shadow-xl flex items-center justify-center gap-3 group">
                            <i class="fas fa-plus-circle group-hover:scale-110 transition"></i>
                            <span class="text-lg">Tambah Produk</span>
                        </button>
                        
                        <a href="{{ route('admin.products.index') }}" 
                           class="flex-1 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 py-4 px-6 rounded-xl hover:from-gray-200 hover:to-gray-300 transition-all duration-300 transform hover:scale-105 font-semibold text-center flex items-center justify-center gap-3 group">
                            <i class="fas fa-times group-hover:scale-110 transition"></i>
                            <span class="text-lg">Batal</span>
                        </a>
                    </div>
                </form>
            </div>

            <!-- Success Message (if any) -->
            @if(session('success'))
                <div class="mt-6 bg-gradient-to-r from-green-500 to-emerald-600 text-white p-4 rounded-2xl shadow-lg" role="alert">
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
        <div class="space-y-6">
            <!-- Quick Stats -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
                <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-chart-bar text-blue-500"></i>
                    <span>Statistik Produk</span>
                </h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Total Produk</span>
                        <span class="font-semibold text-gray-900">{{ \App\Models\Product::count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Total Kategori</span>
                        <span class="font-semibold text-gray-900">{{ \App\Models\Category::count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Produk Baru/Bulan</span>
                        <span class="font-semibold text-gray-900">
                            {{ \App\Models\Product::where('created_at', '>=', now()->subMonth())->count() }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Tips & Best Practices -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200">
                <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-lightbulb text-yellow-500"></i>
                    <span>Tips Produk</span>
                </h3>
                <ul class="space-y-3 text-sm text-gray-700">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Gunakan nama produk yang jelas dan deskriptif</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Upload gambar dengan resolusi tinggi</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Isi deskripsi selengkap mungkin</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Tetapkan harga yang kompetitif</span>
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
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Smooth focus transitions */
input:focus, textarea:focus, select:focus {
    transform: translateY(-1px);
    box-shadow: 0 10px 25px rgba(59, 130, 246, 0.1);
}

/* Custom file upload styling */
.border-dashed:hover {
    border-color: #3b82f6;
    background-color: #f8fafc;
}

/* Hide number input spinner */
.no-spinner::-webkit-outer-spin-button,
.no-spinner::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.no-spinner {
    -moz-appearance: textfield;
}

/* Ensure dropdown text is black */
select option {
    color: #000;
}

/* Animation for form elements */
.form-element {
    transition: all 0.3s ease;
}
</style>

<script>
// Image Preview Functionality
function previewImage(input) {
    const preview = document.getElementById('preview');
    const fileName = document.getElementById('fileName');
    const fileSize = document.getElementById('fileSize');
    const imagePreview = document.getElementById('imagePreview');

    if (input.files && input.files[0]) {
        const file = input.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            fileName.textContent = file.name;
            fileSize.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
            imagePreview.classList.remove('hidden');
        }

        reader.readAsDataURL(file);
    }
}

function removeImage() {
    const input = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    
    input.value = '';
    imagePreview.classList.add('hidden');
}

// Price formatting
document.getElementById('price').addEventListener('blur', function(e) {
    const value = parseFloat(this.value);
    if (!isNaN(value)) {
        this.value = value.toFixed(2);
    }
});

// Form submission loading state
document.getElementById('productForm').addEventListener('submit', function(e) {
    const submitButton = this.querySelector('button[type="submit"]');
    const originalHTML = submitButton.innerHTML;
    
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menambahkan...';
    submitButton.disabled = true;
    
    // Reset after 5 seconds (in case of error)
    setTimeout(() => {
        submitButton.innerHTML = originalHTML;
        submitButton.disabled = false;
    }, 5000);
});

// Auto-format price on input
document.getElementById('price').addEventListener('input', function(e) {
    // Remove any non-numeric characters except decimal point
    this.value = this.value.replace(/[^\d.]/g, '');
    
    // Ensure only one decimal point
    const parts = this.value.split('.');
    if (parts.length > 2) {
        this.value = parts[0] + '.' + parts.slice(1).join('');
    }
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

// Add character counter for description
const description = document.getElementById('description');
const charCount = document.createElement('div');
charCount.className = 'text-sm text-gray-500 mt-1 text-right';
charCount.textContent = '0 karakter';
description.parentNode.appendChild(charCount);

description.addEventListener('input', function() {
    charCount.textContent = this.value.length + ' karakter';
});

// Initialize character count on page load
document.addEventListener('DOMContentLoaded', function() {
    charCount.textContent = description.value.length + ' karakter';
});
</script>
@endsection