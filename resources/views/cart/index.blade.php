@extends('layouts.app')

@section('title', 'Keranjang')
@section('content')
<h1 class="text-2xl font-bold mb-6">Keranjang Belanja</h1>
@if(count($cart) > 0)
<div class="bg-white rounded shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left">Produk</th>
                <th class="px-4 py-2 text-left">Harga</th>
                <th class="px-4 py-2 text-left">Jumlah</th>
                <th class="px-4 py-2 text-left">Subtotal</th>
                <th class="px-4 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $id => $item)
            <tr>
                <td class="px-4 py-2">
                    <div class="flex items-center">
                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded">
                        <span class="ml-4">{{ $item['name'] }}</span>
                    </div>
                </td>
                <td class="px-4 py-2">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                <td class="px-4 py-2">
                    <form action="{{ route('cart.update') }}" method="POST" class="flex items-center">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-16 border rounded px-2 py-1">
                        <button type="submit" class="ml-2 bg-blue-500 text-white px-2 py-1 rounded">Update</button>
                    </form>
                </td>
                <td class="px-4 py-2">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                <td class="px-4 py-2">
                    <form action="{{ route('cart.remove') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="px-4 py-4 bg-gray-100 border-t">
        <div class="flex justify-between items-center">
            <span class="text-xl font-bold">Total: Rp {{ number_format($total, 0, ',', '.') }}</span>
            <a href="{{ route('checkout') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Checkout</a>
        </div>
    </div>
</div>
@else
<p class="text-gray-500">Keranjang belanja kosong.</p>
@endif
@endsection