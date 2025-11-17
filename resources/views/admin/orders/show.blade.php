@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Daftar Pesanan
        </a>
    </div>

    <!-- Order Header -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Pesanan #{{ $order->id }}</h1>
                <p class="text-gray-600">{{ $order->created_at->format('d F Y, H:i') }} WIB</p>
                <p class="text-gray-600 mt-1">User: {{ $order->user->name }} ({{ $order->user->email }})</p>
            </div>
            <span class="px-4 py-2 rounded-lg font-semibold
                @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                @elseif($order->status == 'completed') bg-green-100 text-green-800
                @else bg-red-100 text-red-800
                @endif">
                @if($order->status == 'pending') ⏳ Menunggu Konfirmasi
                @elseif($order->status == 'processing') 📦 Sedang Diproses
                @elseif($order->status == 'completed') ✅ Selesai
                @else ❌ Dibatalkan
                @endif
            </span>
        </div>

        <!-- Update Status Form -->
        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="mt-6 p-4 bg-gray-50 rounded-lg">
            @csrf
            <div class="flex items-center gap-4">
                <label class="font-semibold text-gray-700">Update Status:</label>
                <select name="status" class="border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    Update Status
                </button>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Order Items -->
        <div class="md:col-span-2 bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold mb-4">📦 Item Pesanan</h2>
            <div class="space-y-4">
                @foreach($order->orderItems as $item)
                <div class="flex items-center gap-4 pb-4 border-b last:border-0">
                    <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : 'https://via.placeholder.com/80' }}" 
                         alt="{{ $item->product->name }}"
                         class="w-20 h-20 object-cover rounded-lg">
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-800">{{ $item->product->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-gray-800">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Total -->
            <div class="mt-6 pt-4 border-t">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-semibold">Total Pembayaran</span>
                    <span class="text-2xl font-bold text-green-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Shipping Info -->
        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold mb-4">📍 Info Pengiriman</h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">Nama Penerima</p>
                        <p class="font-semibold">{{ $order->customer_name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">No. Telepon</p>
                        <p class="font-semibold">{{ $order->customer_phone }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Alamat</p>
                        <p class="font-semibold">{{ $order->shipping_address }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection