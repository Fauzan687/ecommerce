@extends('layouts.app')

@section('title', 'Produk')
@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    <div class="lg:col-span-1">
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-bold mb-4">Kategori</h3>
            <ul>
                @foreach($categories as $category)
                <li class="mb-2">
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="text-blue-600 hover:text-blue-800">
                        {{ $category->name }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="lg:col-span-3">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-semibold text-lg mb-2">{{ $product->name }}</h3>
                    <p class="text-gray-600 text-sm mb-2">{{ Str::limit($product->description, 50) }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-green-600 font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <span class="text-sm text-gray-500">Stok: {{ $product->stock }}</span>
                    </div>
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                            Tambah ke Keranjang
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection