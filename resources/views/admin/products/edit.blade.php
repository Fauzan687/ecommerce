@extends('layouts.app')

@section('title', 'Edit Produk - TokoOnlineSMK')

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
            <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center">
                <i class="fas fa-edit text-white text-lg"></i>
            </div>
            <div>
                <h1 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    Edit Produk
                </h1>
                <p class="text-gray-600 mt-1">Perbarui informasi produk "{{ $product->name }}"</p>
            </div>
        </div>
    </div>

    <!-- Product Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-box text-white"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Nama Produk Saat Ini</p>
                    <p class="font-semibold text-gray-900">{{ $product->name }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 border border-green-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-cubes text-white"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Stok Saat Ini</p>
                    <p class="font-semibold text-gray-900">{{ $product->stock }} unit</p>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6 border border-purple-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-white"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Harga Saat Ini</p>
                    <p class="font-semibold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <!-- Edit Form -->
            <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
                <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" id="productForm">
                    @csrf
                    @method('PUT')

                    <!-- Form Header -->
                    <div class="flex items-center gap-3 mb-6 pb-6 border-b border-gray-200">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-edit text-blue-600"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Informasi Produk</h2>
                            <p class="text-sm text-gray-600">Perbarui detail produk Anda</p>
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
                                   value="{{ old('name', $product->name) }}" 
                                   required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 text-gray-900 placeholder-gray-400"
                                   placeholder="Masukkan nama produk"
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
                                  placeholder="Jelaskan detail produk, spesifikasi, keunggulan, dan manfaat...">{{ old('description', $product->description) }}</textarea>
                        <div class="text-sm text-gray-500 mt-1 text-right" id="charCount">{{ strlen(old('description', $product->description)) }} karakter</div>
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
                                <input type="text" 
                                       name="price" 
                                       id="price" 
                                       value="{{ old('price', $product->price) }}" 
                                       required 
                                       class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 text-gray-900 placeholder-gray-400 hide-spinner"
                                       placeholder="0.00"
                                       oninput="formatPrice(this)">
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
                                <span>Stok</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="text" 
                                       name="stock" 
                                       id="stock" 
                                       value="{{ old('stock', $product->stock) }}" 
                                       required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 text-gray-900 placeholder-gray-400 hide-spinner"
                                       placeholder="Jumlah stok"
                                       oninput="validateStock(this)">
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
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 text-gray-900 bg-white appearance-none custom-select">
                                <option value="">Pilih Kategori Produk</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
                        
                        <!-- Current Image -->
                        @if($product->image)
                        <div class="mb-4 p-4 bg-gray-50 rounded-xl border border-gray-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-20 h-20 object-cover rounded-lg border">
                                    <div>
                                        <p class="font-medium text-gray-900">Gambar Saat Ini</p>
                                        <p class="text-sm text-gray-500">Klik upload untuk mengganti gambar</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <a href="{{ asset('storage/' . $product->image) }}" 
                                       target="_blank" 
                                       class="text-blue-600 hover:text-blue-700 p-2 rounded-lg hover:bg-blue-50 transition">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Image Upload -->
                        <div class="mb-4 p-4 border-2 border-dashed border-gray-300 rounded-xl text-center hover:border-blue-400 transition duration-300 cursor-pointer bg-gray-50 hover:bg-gray-100" 
                             onclick="document.getElementById('image').click()"
                             id="uploadArea">
                            <div class="py-6">
                                <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-3"></i>
                                <p class="text-gray-600 font-medium">Klik untuk upload gambar baru</p>
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
                        
                        <!-- New Image Preview Container -->
                        <div id="imagePreview" class="hidden mt-4 p-4 bg-gray-50 rounded-xl border border-gray-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <img id="preview" class="w-16 h-16 object-cover rounded-lg" src="" alt="Preview">
                                    <div>
                                        <p class="font-medium text-gray-900" id="fileName">Gambar Baru</p>
                                        <p class="text-sm text-gray-500" id="fileSize"></p>
                                    </div>
                                </div>
                                <button type="button" onclick="removeImage()" class="text-red-500 hover:text-red-700 p-2 rounded-lg hover:bg-red-50 transition">
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
                                class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 text-white py-4 px-6 rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl flex items-center justify-center gap-3 group">
                            <i class="fas fa-save"></i>
                            <span class="text-lg">Update Produk</span>
                        </button>
                        
                        <a href="{{ route('admin.products.index') }}" 
                           class="flex-1 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 py-4 px-6 rounded-xl hover:from-gray-200 hover:to-gray-300 transition-all duration-300 font-semibold text-center flex items-center justify-center gap-3 group">
                            <i class="fas fa-times"></i>
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
            <!-- Product Info -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
                <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-info-circle text-blue-500"></i>
                    <span>Info Produk</span>
                </h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Dibuat</span>
                        <span class="font-medium text-gray-900">{{ $product->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Terakhir Diupdate</span>
                        <span class="font-medium text-gray-900">{{ $product->updated_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Kategori</span>
                        <span class="font-medium text-gray-900">{{ $product->category->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status Stok</span>
                        <span class="font-medium {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $product->stock > 0 ? 'Tersedia' : 'Habis' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl p-6 border border-yellow-200">
                <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-bolt text-yellow-500"></i>
                    <span>Tips Cepat</span>
                </h3>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Perbarui stok secara berkala</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Gunakan gambar yang jelas</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span>Periksa harga kompetitor</span>
                    </li>
                </ul>
            </div>

            <!-- Danger Zone -->
            <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-2xl p-6 border border-red-200">
                <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-exclamation-triangle text-red-500"></i>
                    <span>Zona Berbahaya</span>
                </h3>
                <p class="text-sm text-gray-700 mb-4">Hapus produk ini secara permanen</p>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirmDelete()">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full bg-red-500 text-white py-2 px-4 rounded-xl hover:bg-red-600 transition font-semibold text-sm flex items-center justify-center gap-2">
                        <i class="fas fa-trash"></i>
                        <span>Hapus Produk</span>
                    </button>
                </form>
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
.hide-spinner::-webkit-outer-spin-button,
.hide-spinner::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.hide-spinner {
    -moz-appearance: textfield;
}

/* Custom select styling */
.custom-select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
    -webkit-print-color-adjust: exact;
    print-color-adjust: exact;
}

/* Ensure dropdown text is visible */
.custom-select option {
    color: #1f2937;
    background: white;
    padding: 8px;
}
</style>

<script>
// Image Preview Functionality
function previewImage(input) {
    const preview = document.getElementById('preview');
    const fileName = document.getElementById('fileName');
    const fileSize = document.getElementById('fileSize');
    const imagePreview = document.getElementById('imagePreview');
    const uploadArea = document.getElementById('uploadArea');

    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        // Check file size (2MB limit)
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimal 2MB.');
            input.value = '';
            return;
        }
        
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            fileName.textContent = file.name;
            fileSize.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
            imagePreview.classList.remove('hidden');
            uploadArea.classList.add('hidden');
        }

        reader.readAsDataURL(file);
    }
}

function removeImage() {
    const input = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const uploadArea = document.getElementById('uploadArea');
    
    input.value = '';
    imagePreview.classList.add('hidden');
    uploadArea.classList.remove('hidden');
}

// Price formatting and validation
function formatPrice(input) {
    // Remove non-numeric characters except decimal point
    let value = input.value.replace(/[^\d.]/g, '');
    
    // Ensure only one decimal point
    const parts = value.split('.');
    if (parts.length > 2) {
        value = parts[0] + '.' + parts.slice(1).join('');
    }
    
    // Limit to 2 decimal places
    if (parts.length === 2) {
        value = parts[0] + '.' + parts[1].slice(0, 2);
    }
    
    input.value = value;
}

// Stock validation
function validateStock(input) {
    // Remove non-numeric characters
    let value = input.value.replace(/\D/g, '');
    
    // Remove leading zeros
    value = value.replace(/^0+/, '');
    
    // If empty, set to 0
    if (value === '') value = '0';
    
    // Limit to reasonable number
    if (parseInt(value) > 999999) {
        value = '999999';
    }
    
    input.value = value;
}

// Form submission loading state
document.getElementById('productForm').addEventListener('submit', function(e) {
    const submitButton = this.querySelector('button[type="submit"]');
    const originalHTML = submitButton.innerHTML;
    
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memperbarui...';
    submitButton.disabled = true;
    
    // Reset after 5 seconds (in case of error)
    setTimeout(() => {
        submitButton.innerHTML = originalHTML;
        submitButton.disabled = false;
    }, 5000);
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

// Character counter for description
const description = document.getElementById('description');
const charCount = document.getElementById('charCount');

description.addEventListener('input', function() {
    charCount.textContent = this.value.length + ' karakter';
});

// Delete confirmation
function confirmDelete() {
    return confirm('Apakah Anda yakin ingin menghapus produk "{{ $product->name }}"? Tindakan ini tidak dapat dibatalkan!');
}

// Better file upload area interaction
const uploadArea = document.getElementById('uploadArea');
uploadArea.addEventListener('dragover', function(e) {
    e.preventDefault();
    this.classList.add('border-blue-400', 'bg-blue-50');
});

uploadArea.addEventListener('dragleave', function(e) {
    e.preventDefault();
    this.classList.remove('border-blue-400', 'bg-blue-50');
});

uploadArea.addEventListener('drop', function(e) {
    e.preventDefault();
    this.classList.remove('border-blue-400', 'bg-blue-50');
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        document.getElementById('image').files = files;
        previewImage(document.getElementById('image'));
    }
});

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    // Format initial price value
    const priceInput = document.getElementById('price');
    if (priceInput.value) {
        formatPrice(priceInput);
    }
    
    // Format initial stock value
    const stockInput = document.getElementById('stock');
    if (stockInput.value) {
        validateStock(stockInput);
    }
});
</script>
@endsection
