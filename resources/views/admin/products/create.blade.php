@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-6">Tambah Produk</h1>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700 mb-2">Nama Produk</label>
            <input type="text" name="name" id="name" required 
                   class="w-full border rounded px-3 py-2">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 mb-2">Deskripsi</label>
            <textarea name="description" id="description" rows="4" 
                      class="w-full border rounded px-3 py-2"></textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="price" class="block text-gray-700 mb-2">Harga</label>
            <input type="number" name="price" id="price" required min="0" step="0.01"
                   class="w-full border rounded px-3 py-2">
            @error('price')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="stock" class="block text-gray-700 mb-2">Stok</label>
            <input type="number" name="stock" id="stock" required min="0"
                   class="w-full border rounded px-3 py-2">
            @error('stock')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="category_id" class="block text-gray-700 mb-2">Kategori</label>
            <select name="category_id" id="category_id" required
                    class="w-full border rounded px-3 py-2">
                <option value="">Pilih Kategori</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700 mb-2">Gambar Produk</label>
            <input type="file" name="image" id="image"
                   class="w-full border rounded px-3 py-2">
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" 
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan Produk
            </button>
        </div>
    </form>
</div>
@endsection