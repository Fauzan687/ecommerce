@extends('layouts.app')

@section('title', 'Checkout')
@section('content')
<h1 class="text-2xl font-bold mb-6">Checkout</h1>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <h2 class="text-xl font-semibold mb-4">Informasi Pengiriman</h2>
        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="customer_name" class="block text-gray-700">Nama Penerima</label>
                <input type="text" name="customer_name" id="customer_name" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label for="customer_phone" class="block text-gray-700">No. Telepon</label>
                <input type="text" name="customer_phone" id="customer_phone" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label for="shipping_address" class="block text-gray-700">Alamat Pengiriman</label>
                <textarea name="shipping_address" id="shipping_address" rows="3" class="w-full border rounded px-3 py-2" required></textarea>
            </div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Buat Pesanan</button>
        </form>
    </div>
    <div>
        <h2 class="text-xl font-semibold mb-4">Ringkasan Pesanan</h2>
        <div class="bg-gray-100 p-4 rounded">
            @foreach($cart as $item)
            <div class="flex justify-between mb-2">
                <span>{{ $item['name'] }} (x{{ $item['quantity'] }})</span>
                <span>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
            </div>
            @endforeach
            <div class="border-t mt-4 pt-4">
                <div class="flex justify-between font-bold">
                    <span>Total</span>
                    <span>Rp {{ number_format(array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, $cart)), 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection