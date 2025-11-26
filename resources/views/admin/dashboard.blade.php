@extends('layouts.app')

@section('title', 'Admin Dashboard - TokoOnlineSMK')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 animate-fade-in">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2">
                📊 Admin Dashboard
            </h1>
            <p class="text-gray-600">Ringkasan performa toko online Anda</p>
        </div>
        
        <div class="flex items-center gap-4 text-sm text-gray-600 bg-white rounded-2xl shadow-lg px-4 py-3">
            <div class="flex items-center gap-2">
                <i class="fas fa-calendar text-blue-500"></i>
                <span>{{ now()->format('d F Y') }}</span>
            </div>
            <div class="w-px h-4 bg-gray-300"></div>
            <div class="flex items-center gap-2">
                <i class="fas fa-clock text-green-500"></i>
                <span>{{ now()->format('H:i') }} WIB</span>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 animate-fade-in" style="animation-delay: 0.1s;">
        <!-- Total Orders -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white transform hover:scale-105 transition duration-300 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-semibold mb-1">TOTAL PESANAN</p>
                    <p class="text-3xl font-bold">{{ $stats['total_orders'] }}</p>
                    <p class="text-blue-100 text-sm mt-2 flex items-center gap-1">
                        <i class="fas fa-shopping-bag"></i>
                        Semua Pesanan
                    </p>
                </div>
                <div class="w-12 h-12 bg-blue-400/20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-receipt text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Products -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white transform hover:scale-105 transition duration-300 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-semibold mb-1">TOTAL PRODUK</p>
                    <p class="text-3xl font-bold">{{ $stats['total_products'] }}</p>
                    <p class="text-green-100 text-sm mt-2 flex items-center gap-1">
                        <i class="fas fa-box"></i>
                        Produk Aktif
                    </p>
                </div>
                <div class="w-12 h-12 bg-green-400/20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-cube text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white transform hover:scale-105 transition duration-300 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-semibold mb-1">TOTAL PENGGUNA</p>
                    <p class="text-3xl font-bold">{{ $stats['total_users'] }}</p>
                    <p class="text-purple-100 text-sm mt-2 flex items-center gap-1">
                        <i class="fas fa-users"></i>
                        Pelanggan
                    </p>
                </div>
                <div class="w-12 h-12 bg-purple-400/20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-user-friends text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl p-6 text-white transform hover:scale-105 transition duration-300 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm font-semibold mb-1">TOTAL PENDAPATAN</p>
                    <p class="text-2xl font-bold">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</p>
                    <p class="text-orange-100 text-sm mt-2 flex items-center gap-1">
                        <i class="fas fa-chart-line"></i>
                        Pendapatan
                    </p>
                </div>
                <div class="w-12 h-12 bg-orange-400/20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-money-bill-wave text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Orders -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in" style="animation-delay: 0.2s;">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-clock text-blue-500"></i>
                        Pesanan Terbaru
                    </h2>
                    <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold flex items-center gap-1">
                        Lihat Semua
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="overflow-x-auto">
                @if($recentOrders->count() > 0)
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Order ID</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($recentOrders as $order)
                        <tr class="hover:bg-gray-50 transition duration-300">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-semibold text-gray-900">#{{ $order->id }}</div>
                                <div class="text-sm text-gray-500">{{ $order->created_at->format('d/m H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-gray-900">{{ $order->customer_name }}</div>
                                <div class="text-sm text-gray-500">{{ $order->user->email ?? 'Guest' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-semibold text-green-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full
                                    @if($order->status == 'completed') bg-green-100 text-green-800
                                    @elseif($order->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="text-center py-12">
                    <i class="fas fa-receipt text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 text-lg">Belum ada pesanan</p>
                    <p class="text-gray-400 text-sm mt-1">Pesanan akan muncul di sini</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Low Stock Products -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in" style="animation-delay: 0.3s;">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-exclamation-triangle text-red-500"></i>
                        Stok Menipis
                    </h2>
                    <a href="{{ route('admin.products.index') }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold flex items-center gap-1">
                        Kelola
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="overflow-x-auto">
                @if($lowStockProducts->count() > 0)
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Produk</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Stok</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($lowStockProducts as $product)
                        <tr class="hover:bg-gray-50 transition duration-300">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-10 h-10 object-cover rounded-lg">
                                    @else
                                    <div class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-box text-gray-400"></i>
                                    </div>
                                    @endif
                                    <div>
                                        <div class="font-medium text-gray-900 text-sm">{{ Str::limit($product->name, 30) }}</div>
                                        <div class="text-xs text-gray-500">{{ $product->category->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-semibold 
                                    @if($product->stock == 0) text-red-600
                                    @elseif($product->stock <= 5) text-orange-600
                                    @else text-yellow-600
                                    @endif">
                                    {{ $product->stock }} unit
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($product->stock == 0)
                                <span class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded-full">Habis</span>
                                @elseif($product->stock <= 5)
                                <span class="px-2 py-1 text-xs font-semibold bg-orange-100 text-orange-800 rounded-full">Kritis</span>
                                @else
                                <span class="px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full">Menipis</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="text-center py-12">
                    <i class="fas fa-check-circle text-4xl text-green-300 mb-4"></i>
                    <p class="text-gray-500 text-lg">Stok semua produk aman</p>
                    <p class="text-gray-400 text-sm mt-1">Tidak ada produk dengan stok menipis</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-6 animate-fade-in" style="animation-delay: 0.4s;">
        <a href="{{ route('admin.products.create') }}" class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition duration-300 transform hover:scale-105 text-center group">
            <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition">
                <i class="fas fa-plus text-white text-xl"></i>
            </div>
            <h3 class="font-semibold text-gray-900 mb-1">Tambah Produk</h3>
            <p class="text-sm text-gray-600">Produk baru</p>
        </a>

        <a href="{{ route('admin.orders.index') }}" class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition duration-300 transform hover:scale-105 text-center group">
            <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition">
                <i class="fas fa-shopping-bag text-white text-xl"></i>
            </div>
            <h3 class="font-semibold text-gray-900 mb-1">Kelola Pesanan</h3>
            <p class="text-sm text-gray-600">{{ $stats['pending_orders'] }} pending</p>
        </a>

        <a href="{{ route('admin.categories.index') }}" class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition duration-300 transform hover:scale-105 text-center group">
            <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition">
                <i class="fas fa-tags text-white text-xl"></i>
            </div>
            <h3 class="font-semibold text-gray-900 mb-1">Kategori</h3>
            <p class="text-sm text-gray-600">{{ $stats['total_categories'] }} kategori</p>
        </a>

        <a href="{{ route('products.index') }}" class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition duration-300 transform hover:scale-105 text-center group">
            <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition">
                <i class="fas fa-store text-white text-xl"></i>
            </div>
            <h3 class="font-semibold text-gray-900 mb-1">Lihat Toko</h3>
            <p class="text-sm text-gray-600">Frontend</p>
        </a>
    </div>
</div>

<style>
.animate-fade-in {
    animation: fadeIn 0.6s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script>
// Intersection Observer for animations
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, {
    threshold: 0.1
});

document.querySelectorAll('.animate-fade-in').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(20px)';
    el.style.transition = 'all 0.6s ease';
    observer.observe(el);
});
</script>
@endsection