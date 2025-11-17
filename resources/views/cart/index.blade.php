@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">🛒 Keranjang Belanja</h1>
        <p class="text-gray-600">Tinjau dan kelola item belanjaan Anda</p>
    </div>

    @if(count($cart) > 0)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Cart Items -->
        <div class="lg:col-span-2 space-y-4">
            @foreach($cart as $id => $item)
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex items-center space-x-4">
                        <!-- Product Image -->
                        <div class="flex-shrink-0">
                            <img src="{{ $item['image'] ? asset('storage/' . $item['image']) : 'https://via.placeholder.com/100' }}" 
                                 alt="{{ $item['name'] }}" 
                                 class="w-20 h-20 object-cover rounded-xl shadow-md">
                        </div>
                        
                        <!-- Product Info -->
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $item['name'] }}</h3>
                            <p class="text-2xl font-bold text-blue-600 mt-1">
                                Rp {{ number_format($item['price'], 0, ',', '.') }}
                            </p>
                        </div>

                        <!-- Quantity Controls -->
                        <div class="flex items-center space-x-3">
                            <form action="{{ route('cart.update') }}" method="POST" class="flex items-center space-x-2">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                    <button type="button" onclick="decrementQuantity(this)" 
                                            class="px-3 py-2 bg-gray-100 hover:bg-gray-200 transition-colors">
                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                        </svg>
                                    </button>
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" 
                                           class="w-16 px-2 py-2 text-center border-0 focus:ring-0 focus:outline-none">
                                    <button type="button" onclick="incrementQuantity(this)" 
                                            class="px-3 py-2 bg-gray-100 hover:bg-gray-200 transition-colors">
                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                    </button>
                                </div>
                                <button type="submit" 
                                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium">
                                    Update
                                </button>
                            </form>
                        </div>

                        <!-- Subtotal & Remove -->
                        <div class="text-right">
                            <p class="text-xl font-bold text-gray-900 mb-2">
                                Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                            </p>
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button type="submit" 
                                        class="flex items-center space-x-1 text-red-600 hover:text-red-700 transition-colors duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    <span class="text-sm font-medium">Hapus</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 sticky top-8">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Ringkasan Pesanan</h2>
                    
                    <!-- Order Details -->
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="text-gray-900 font-medium">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Ongkos Kirim</span>
                            <span class="text-green-600 font-medium">Gratis</span>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>Estimasi Pengiriman</span>
                            <span>2-3 hari</span>
                        </div>
                    </div>

                    <!-- Total -->
                    <div class="border-t border-gray-200 pt-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-900">Total</span>
                            <span class="text-2xl font-bold text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Checkout Button -->
                    <a href="{{ route('checkout') }}" 
                       class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-4 px-6 rounded-xl font-bold text-lg hover:from-green-600 hover:to-green-700 transition-all duration-300 transform hover:scale-105 active:scale-95 shadow-lg flex items-center justify-center space-x-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Lanjut ke Checkout</span>
                    </a>

                    <!-- Security Badge -->
                    <div class="mt-4 text-center">
                        <div class="flex items-center justify-center space-x-2 text-gray-500 text-sm">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <span>Pembayaran Aman & Terenkripsi</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Continue Shopping -->
            <div class="mt-6 text-center">
                <a href="{{ route('products.index') }}" 
                   class="inline-flex items-center space-x-2 text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>Lanjutkan Belanja</span>
                </a>
            </div>
        </div>
    </div>
    @else
    <!-- Empty Cart State -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-12 text-center">
        <div class="max-w-md mx-auto">
            <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Keranjang Kosong</h3>
            <p class="text-gray-600 mb-6">Belum ada item di keranjang belanja Anda</p>
            <a href="{{ route('products.index') }}" 
               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Mulai Belanja
            </a>
        </div>
    </div>
    @endif
</div>

<script>
// Quantity increment/decrement functions
function incrementQuantity(button) {
    const input = button.parentElement.querySelector('input[type="number"]');
    input.value = parseInt(input.value) + 1;
    // Trigger form submission
    button.closest('form').querySelector('button[type="submit"]').click();
}

function decrementQuantity(button) {
    const input = button.parentElement.querySelector('input[type="number"]');
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
        // Trigger form submission
        button.closest('form').querySelector('button[type="submit"]').click();
    }
}

// Add animation when page loads
document.addEventListener('DOMContentLoaded', function() {
    const cartItems = document.querySelectorAll('.bg-white.rounded-2xl');
    cartItems.forEach((item, index) => {
        item.style.animation = `slideInUp 0.5s ease-out ${index * 0.1}s both`;
    });
});

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;
document.head.appendChild(style);
</script>

<style>
/* Custom scrollbar for quantity input */
input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type="number"] {
    -moz-appearance: textfield;
}

/* Hover effects */
.bg-white.rounded-2xl {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.bg-white.rounded-2xl:hover {
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}
</style>
@endsection