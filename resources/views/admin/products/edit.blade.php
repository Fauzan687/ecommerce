@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    
    <div class="bg-white shadow-md rounded-md p-6 border border-gray-200">
        <h1 class="text-2xl font-semibold mb-6 text-gray-800">Edit Produk</h1>

        <form 
            action="{{ route('admin.products.update', $product) }}" 
            method="POST" 
            enctype="multipart/form-data"
            class="space-y-5"
        >
            @csrf
            @method('PUT')

            {{-- Nama Produk --}}
            <div>
                <label for="name" class="block font-medium text-gray-700 mb-1">Nama Produk</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name"
                    value="{{ old('name', $product->name) }}"
                    required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-black focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label for="description" class="block font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea 
                    name="description" 
                    id="description" 
                    rows="4"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-black focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- Harga --}}
                <div>
                    <label for="price" class="block font-medium text-gray-700 mb-1">Harga</label>
                    <input 
                        type="number" 
                        name="price" 
                        id="price" 
                        value="{{ old('price', $product->price) }}" 
                        required 
                        min="0" 
                        step="0.01"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-black focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Stok --}}
                <div>
                    <label for="stock" class="block font-medium text-gray-700 mb-1">Stok</label>
                    <input 
                        type="number" 
                        name="stock" 
                        id="stock"
                        value="{{ old('stock', $product->stock) }}"
                        required 
                        min="0"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-black focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                    @error('stock')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Kategori --}}
            <div>
                <label for="category_id" class="block font-medium text-gray-700 mb-1">Kategori</label>
                <select 
                    name="category_id" 
                    id="category_id" 
                    required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-black bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option 
                            value="{{ $category->id }}" 
                            {{ $product->category_id == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Gambar --}}
            <div>
                <label for="image" class="block font-medium text-gray-700 mb-1">Gambar Produk</label>

                @if($product->image)
                <div class="mb-3">
                    <img 
                        src="{{ asset('storage/' . $product->image) }}" 
                        alt="{{ $product->name }}" 
                        class="w-32 h-32 object-cover rounded-md border"
                    >
                </div>
                @endif

                <input 
                    type="file" 
                    name="image" 
                    id="image"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-black focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="flex justify-end">
                <button 
                    type="submit"
                    class="px-5 py-2 bg-blue-600 text-white font-medium rounded-md shadow hover:bg-blue-700 transition"
                >
                    Update Produk
                </button>
            </div>

        </form>
    </div>

</div>
@endsection
