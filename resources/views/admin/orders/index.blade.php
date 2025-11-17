@extends('layouts.app')

@section('title', 'Kelola Pesanan')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-6 text-gray-900">Kelola Pesanan</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Customer</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Total</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr class="border-b text-gray-900 hover:bg-gray-50">
                    <td class="px-4 py-2 font-semibold">#{{ $order->id }}</td>
                    <td class="px-4 py-2">{{ $order->customer_name }}</td>
                    <td class="px-4 py-2">{{ $order->user->email ?? '-' }}</td>
                    <td class="px-4 py-2">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td class="px-4 py-2">
                        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="flex items-center space-x-2">
                            @csrf
                            <select name="status" 
                                    class="border rounded px-2 py-1 text-sm focus:ring-2 focus:ring-blue-500
                                    @if($order->status == 'pending') bg-yellow-50 text-yellow-800
                                    @elseif($order->status == 'processing') bg-blue-50 text-blue-800
                                    @elseif($order->status == 'completed') bg-green-50 text-green-800
                                    @else bg-red-50 text-red-800
                                    @endif">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">
                                Update
                            </button>
                        </form>
                    </td>
                    <td class="px-4 py-2">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('admin.orders.show', $order) }}" 
                           class="text-blue-600 hover:text-blue-800 font-semibold">
                            Detail →
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection