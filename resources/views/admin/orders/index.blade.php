@extends('layouts.app')

@section('title', 'Kelola Pesanan - TokoOnlineSMK')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 animate-fade-in">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2">
                📋 Kelola Pesanan
            </h1>
            <p class="text-gray-600">Kelola dan pantau semua pesanan pelanggan</p>
        </div>
        
        <!-- Quick Stats -->
        <div class="flex items-center gap-4 text-sm text-gray-600 bg-white rounded-2xl shadow-lg px-4 py-3">
            <div class="flex items-center gap-2">
                <i class="fas fa-shopping-bag text-blue-500"></i>
                <span>{{ $orders->total() }} pesanan</span>
            </div>
            <div class="w-px h-4 bg-gray-300"></div>
            <div class="flex items-center gap-2">
                <i class="fas fa-filter text-green-500"></i>
                <span>Halaman {{ $orders->currentPage() }}/{{ $orders->lastPage() }}</span>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white p-4 rounded-2xl shadow-lg animate-slide-down mb-6" role="alert">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <i class="fas fa-check-circle text-xl"></i>
                    <p class="font-semibold">{{ session('success') }}</p>
                </div>
                <button type="button" onclick="this.parentElement.parentElement.remove()" class="text-white hover:text-green-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    <!-- Orders Overview Cards -->
    @php
        $pendingCount = $orders->where('status', 'pending')->count();
        $processingCount = $orders->where('status', 'processing')->count();
        $completedCount = $orders->where('status', 'completed')->count();
        $cancelledCount = $orders->where('status', 'cancelled')->count();
    @endphp

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8 animate-fade-in" style="animation-delay: 0.1s;">
        <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl p-6 text-white text-center transform hover:scale-105 transition duration-300 shadow-lg cursor-pointer" onclick="filterOrders('pending')">
            <div class="text-3xl font-bold mb-2">{{ $pendingCount }}</div>
            <div class="text-yellow-100 flex items-center justify-center gap-2">
                <i class="fas fa-clock"></i>
                <span>Menunggu</span>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white text-center transform hover:scale-105 transition duration-300 shadow-lg cursor-pointer" onclick="filterOrders('processing')">
            <div class="text-3xl font-bold mb-2">{{ $processingCount }}</div>
            <div class="text-blue-100 flex items-center justify-center gap-2">
                <i class="fas fa-cog"></i>
                <span>Diproses</span>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white text-center transform hover:scale-105 transition duration-300 shadow-lg cursor-pointer" onclick="filterOrders('completed')">
            <div class="text-3xl font-bold mb-2">{{ $completedCount }}</div>
            <div class="text-green-100 flex items-center justify-center gap-2">
                <i class="fas fa-check-circle"></i>
                <span>Selesai</span>
            </div>
        </div>
        
        <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-2xl p-6 text-white text-center transform hover:scale-105 transition duration-300 shadow-lg cursor-pointer" onclick="filterOrders('cancelled')">
            <div class="text-3xl font-bold mb-2">{{ $cancelledCount }}</div>
            <div class="text-red-100 flex items-center justify-center gap-2">
                <i class="fas fa-times-circle"></i>
                <span>Dibatalkan</span>
            </div>
        </div>
    </div>

    @if($orders->count() > 0)
    <!-- Orders Table -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in" style="animation-delay: 0.2s;">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-gray-800 to-gray-900 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold text-sm uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-hashtag"></i>
                                <span>ID Pesanan</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left font-semibold text-sm uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-user"></i>
                                <span>Customer</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left font-semibold text-sm uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-envelope"></i>
                                <span>Email</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left font-semibold text-sm uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-money-bill-wave"></i>
                                <span>Total</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left font-semibold text-sm uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-tasks"></i>
                                <span>Status</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left font-semibold text-sm uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-calendar"></i>
                                <span>Tanggal</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left font-semibold text-sm uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-cog"></i>
                                <span>Aksi</span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($orders as $order)
                    <tr class="hover:bg-gray-50 transition duration-300 group" data-status="{{ $order->status }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-receipt text-white text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900">#{{ $order->id }}</div>
                                    <div class="text-xs text-gray-500">{{ $order->orderItems->count() }} items</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-semibold text-gray-900">{{ $order->customer_name }}</div>
                            <div class="text-sm text-gray-500">{{ $order->customer_phone }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-gray-900">{{ $order->user->email ?? 'Guest' }}</div>
                            <div class="text-sm text-gray-500">
                                {{ $order->user ? 'Registered' : 'Guest Order' }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-lg font-bold text-green-600">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                <div class="relative flex-1">
                                    <select name="status" 
                                            class="w-full px-3 py-2 border rounded-lg text-sm font-semibold focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300
                                            @if($order->status == 'pending') 
                                                bg-yellow-50 text-yellow-800 border-yellow-200
                                            @elseif($order->status == 'processing') 
                                                bg-blue-50 text-blue-800 border-blue-200
                                            @elseif($order->status == 'completed') 
                                                bg-green-50 text-green-800 border-green-200
                                            @else 
                                                bg-red-50 text-red-800 border-red-200
                                            @endif">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                            ⏳ Pending
                                        </option>
                                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>
                                            📦 Processing
                                        </option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>
                                            ✅ Completed
                                        </option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                            ❌ Cancelled
                                        </option>
                                    </select>
                                </div>
                                <button type="submit" 
                                        class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-3 py-2 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 font-semibold text-sm flex items-center gap-2 group">
                                    <i class="fas fa-sync-alt group-hover:rotate-180 transition-transform"></i>
                                    <span>Update</span>
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-gray-900">
                                {{ $order->created_at->format('d M Y') }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $order->created_at->format('H:i') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.orders.show', $order) }}" 
                                   class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-2 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 font-semibold text-sm flex items-center gap-2 group">
                                    <i class="fas fa-eye group-hover:scale-110 transition"></i>
                                    <span>Detail</span>
                                </a>
                                
                                @if($order->status == 'pending')
                                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="cancelled">
                                    <button type="submit" 
                                            class="bg-gradient-to-r from-red-500 to-red-600 text-white px-4 py-2 rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 transform hover:scale-105 font-semibold text-sm flex items-center gap-2 group"
                                            onclick="return confirm('Batalkan pesanan #{{ $order->id }}?')">
                                        <i class="fas fa-times group-hover:scale-110 transition"></i>
                                        <span>Cancel</span>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($orders->hasPages())
    <div class="mt-6 flex justify-center animate-fade-in" style="animation-delay: 0.3s;">
        <div class="bg-white rounded-2xl shadow-lg p-4">
            {{ $orders->links() }}
        </div>
    </div>
    @endif

    @else
    <!-- Empty State -->
    <div class="bg-white rounded-2xl shadow-xl p-12 text-center animate-fade-in">
        <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
            <i class="fas fa-shopping-bag text-gray-400 text-3xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-3">Belum Ada Pesanan</h3>
        <p class="text-gray-600 text-lg mb-8 max-w-md mx-auto">
            Belum ada pesanan yang masuk. Pesanan dari pelanggan akan muncul di sini.
        </p>
        
        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto mt-8">
            <div class="text-center p-6 bg-blue-50 rounded-2xl">
                <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-chart-line text-white"></i>
                </div>
                <h4 class="font-semibold text-gray-800 mb-2">Pantau Penjualan</h4>
                <p class="text-gray-600 text-sm">Lihat dashboard untuk statistik penjualan</p>
            </div>
            
            <div class="text-center p-6 bg-green-50 rounded-2xl">
                <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-box text-white"></i>
                </div>
                <h4 class="font-semibold text-gray-800 mb-2">Kelola Produk</h4>
                <p class="text-gray-600 text-sm">Perbarui stok dan informasi produk</p>
            </div>
            
            <div class="text-center p-6 bg-purple-50 rounded-2xl">
                <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-white"></i>
                </div>
                <h4 class="font-semibold text-gray-800 mb-2">Pelanggan</h4>
                <p class="text-gray-600 text-sm">Kelola data dan riwayat pelanggan</p>
            </div>
        </div>
    </div>
    @endif
</div>

<style>
.animate-fade-in {
    animation: fadeIn 0.6s ease-out;
}

.animate-slide-down {
    animation: slideDown 0.3s ease-out;
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

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Custom pagination styles */
.pagination {
    display: flex;
    gap: 0.5rem;
}

.page-item {
    display: inline-block;
}

.page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 0.75rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #3b82f6, #8b5cf6);
    color: white;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.page-item:not(.active) .page-link {
    background: #f8fafc;
    color: #64748b;
    border: 1px solid #e2e8f0;
}

.page-item:not(.active) .page-link:hover {
    background: #3b82f6;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
}

.page-item.disabled .page-link {
    background: #f1f5f9;
    color: #94a3b8;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter orders by status
    window.filterOrders = function(status) {
        const rows = document.querySelectorAll('tbody tr[data-status]');
        rows.forEach(row => {
            if (status === 'all' || row.getAttribute('data-status') === status) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
        
        // Update active filter indicator
        document.querySelectorAll('.bg-gradient-to-br').forEach(card => {
            card.classList.remove('ring-2', 'ring-white', 'ring-offset-2');
        });
        event.currentTarget.classList.add('ring-2', 'ring-white', 'ring-offset-2');
    };

    // Add loading state to update buttons
    const updateForms = document.querySelectorAll('form[action*="update-status"]');
    updateForms.forEach(form => {
        const submitButton = form.querySelector('button[type="submit"]');
        
        form.addEventListener('submit', function(e) {
            const originalHTML = submitButton.innerHTML;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Updating...';
            submitButton.disabled = true;
            
            // Reset after 3 seconds (in case of error)
            setTimeout(() => {
                submitButton.innerHTML = originalHTML;
                submitButton.disabled = false;
            }, 3000);
        });
    });

    // Auto-hide success message after 5 seconds
    const successMessage = document.querySelector('[role="alert"]');
    if (successMessage) {
        setTimeout(() => {
            successMessage.style.transition = 'all 0.5s ease';
            successMessage.style.opacity = '0';
            successMessage.style.transform = 'translateY(-20px)';
            setTimeout(() => successMessage.remove(), 500);
        }, 5000);
    }
});

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