@extends('layouts.app')

@section('title', $product->name)
@section('content')
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="md:flex">
        <div class="md:flex-shrink-0">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-96 w-full object-cover md:w-96">
        </div>
        <div class="p-8">
            <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{ $product->category->name }}</div>
            <h1 class="block mt-1 text-2xl font-medium text-gray-900">{{ $product->name }}</h1>
            <p class="mt-2 text-gray-500">{{ $product->description }}</p>
            <div class="mt-4">
                <span class="text-3xl font-bold text-green-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                <span class="text-sm text-gray-500 ml-2">Stok: {{ $product->stock }}</span>
            </div>
            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-6">
                @csrf
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                    Tambah ke Keranjang
                </button>
            </form>
        </div>
    </div>
</div>
@endsection