@extends('layouts.app')

@section('title', 'Pesanan Saya')
@section('content')
<h1 class="text-2xl font-bold mb-6">Pesanan Saya</h1>
<div class="bg-white rounded shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left">ID Pesanan</th>
                <th class="px-4 py-2 text-left">Total</th>
                <th class="px-4 py-2 text-left">Status</th>
                <th class="px-4 py-2 text-left">Tanggal</th>
                <th class="px-4 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td class="px-4 py-2">#{{ $order->id }}</td>
                <td class="px-4 py-2">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                <td class="px-4 py-2">
                    <span class="px-2 py-1 rounded 
                        @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                        @elseif($order->status == 'completed') bg-green-100 text-green-800
                        @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                        @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td class="px-4 py-2">{{ $order->created_at->format('d M Y H:i') }}</td>
                <td class="px-4 py-2">
                    <a href="#" class="text-blue-600 hover:text-blue-800">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection