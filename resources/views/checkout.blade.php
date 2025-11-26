@extends('layouts.app')

@section('title', 'Checkout - TokoOnlineSMK')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8 text-center">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">💳 Checkout</h1>
        <p class="text-gray-600">Lengkapi informasi pengiriman untuk menyelesaikan pesanan</p>
    </div>

    @if(count($cart) > 0)
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Shipping Information -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">📝 Informasi Pengiriman</h2>
            
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                
                <div class="space-y-6">
                    <!-- Customer Name -->
                    <div>
                        <label for="customer_name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Lengkap Penerima
                        </label>
                        <input type="text" 
                               name="customer_name" 
                               id="customer_name" 
                               value="{{ auth()->user()->name }}"
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               placeholder="Masukkan nama lengkap">
                    </div>

                    <!-- Customer Phone -->
                    <div>
                        <label for="customer_phone" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nomor Telepon
                        </label>
                        <input type="text" 
                               name="customer_phone" 
                               id="customer_phone" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               placeholder="Contoh: 081234567890">
                    </div>

                    <!-- Shipping Address -->
                    <div>
                        <label for="shipping_address" class="block text-sm font-semibold text-gray-700 mb-2">
                            Alamat Lengkap Pengiriman
                        </label>
                        <textarea name="shipping_address" 
                                  id="shipping_address" 
                                  rows="4"
                                  required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                  placeholder="Masukkan alamat lengkap termasuk nomor rumah, RT/RW, kelurahan, kecamatan, kota, dan kode pos"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-4 px-6 rounded-xl font-bold text-lg hover:from-green-600 hover:to-green-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-lock mr-2"></i>
                        Buat Pesanan Sekarang
                    </button>
                </div>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">📦 Ringkasan Pesanan</h2>
            
            <!-- Cart Items -->
            <div class="space-y-4 mb-6">
                @foreach($cart as $id => $item)
                <div class="flex items-center gap-4 pb-4 border-b">
                    <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center overflow-hidden">
                        @if($item['image'])
                            <img src="{{ asset('storage/' . $item['image']) }}" 
                                 alt="{{ $item['name'] }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <i class="fas fa-image text-gray-400"></i>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-900">{{ $item['name'] }}</h4>
                        <p class="text-sm text-gray-600">{{ $item['quantity'] }} × Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-gray-900">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Order Total -->
            <div class="border-t pt-4">
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="text-gray-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Ongkos Kirim</span>
                        <span class="text-green-600 font-semibold">Gratis</span>
                    </div>
                    <div class="flex justify-between text-lg font-bold mt-4 pt-4 border-t">
                        <span>Total Pembayaran</span>
                        <span class="text-green-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Security Badge -->
            <div class="mt-6 p-4 bg-green-50 rounded-xl border border-green-200">
                <div class="flex items-center gap-3">
                    <i class="fas fa-shield-alt text-green-600 text-xl"></i>
                    <div>
                        <p class="font-semibold text-green-800">Pembayaran Aman</p>
                        <p class="text-sm text-green-600">Data Anda dilindungi dengan enkripsi SSL</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- Empty Cart State -->
    <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
        <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
            <i class="fas fa-shopping-cart text-gray-400 text-3xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-3">Keranjang Kosong</h3>
        <p class="text-gray-600 mb-6">Silakan tambah produk ke keranjang terlebih dahulu</p>
        <a href="{{ route('products.index') }}" 
           class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali Belanja
        </a>
    </div>
    @endif
</div>

<style>
.sticky {
    position: sticky;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-fill form if user data exists
    const user = @json(auth()->user());
    if (user) {
        document.getElementById('customer_name').value = user.name;
        // You can add more auto-fill logic here if you have user phone/address
    }

    // Form submission loading state
    const form = document.querySelector('form');
    const submitButton = form.querySelector('button[type="submit"]');
    
    form.addEventListener('submit', function(e) {
        const originalHTML = submitButton.innerHTML;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
        submitButton.disabled = true;
        
        // Reset after 5 seconds (in case of error)
        setTimeout(() => {
            submitButton.innerHTML = originalHTML;
            submitButton.disabled = false;
        }, 5000);
    });
});
</script>
@endsection