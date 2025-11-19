<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - TokoOnlineSMK</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Custom animations */
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 5px rgba(59, 130, 246, 0.5); }
            50% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.8); }
        }

        .animate-slide-down {
            animation: slideDown 0.5s ease-out;
        }
        
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        
        .pulse-glow {
            animation: pulse-glow 2s infinite;
        }

        /* Glass morphism effect */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .glass-dark {
            background: rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #2563eb, #7c3aed);
        }

        /* Hover effects */
        .hover-lift {
            transition: all 0.3s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        /* Mobile menu animation */
        .mobile-menu-enter {
            transform: translateX(100%);
        }
        
        .mobile-menu-enter-active {
            transform: translateX(0);
            transition: transform 0.3s ease-out;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen flex flex-col font-sans">
    <!-- Navigation Bar -->
    <nav class="sticky top-0 z-50 glass-dark border-b border-white/20">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <a href="{{ url('/') }}" class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-store text-white text-lg"></i>
                        </div>
                        <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            TokoOnlineSMK
                        </span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-1">
                    <a href="{{ url('/') }}" class="px-4 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300 font-medium flex items-center space-x-2">
                        <i class="fas fa-home"></i>
                        <span>Beranda</span>
                    </a>
                    <a href="{{ route('products.index') }}" class="px-4 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300 font-medium flex items-center space-x-2">
                        <i class="fas fa-box"></i>
                        <span>Produk</span>
                    </a>
                    
                    @auth
                        @if(!auth()->user()->is_admin)
                            <a href="{{ route('cart.index') }}" class="px-4 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300 font-medium flex items-center space-x-2 relative">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Keranjang</span>
                                @if(session()->has('cart') && is_array(session('cart')) && count(session('cart')) > 0)
                                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center pulse-glow">
                                        {{ count(session('cart')) }}
                                    </span>
                                @endif
                            </a>
                            <a href="{{ route('orders.index') }}" class="px-4 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300 font-medium flex items-center space-x-2">
                                <i class="fas fa-clipboard-list"></i>
                                <span>Pesanan</span>
                            </a>
                        @else
                            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-300 font-medium flex items-center space-x-2">
                                <i class="fas fa-chart-line"></i>
                                <span>Dashboard</span>
                            </a>
                        @endif
                    @endauth
                </div>

                <!-- Search Bar -->
                <div class="hidden md:flex flex-1 max-w-md mx-8">
                    <form action="{{ route('products.index') }}" method="GET" class="w-full">
                        <div class="relative">
                            <input type="text" 
                                   name="search" 
                                   placeholder="Cari produk..." 
                                   value="{{ request('search') }}"
                                   class="w-full pl-12 pr-4 py-3 rounded-2xl bg-white/90 backdrop-blur-sm border-0 focus:ring-2 focus:ring-blue-300 shadow-lg transition-all duration-300 focus:scale-105">
                            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </form>
                </div>

                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    @auth
                        <!-- User Dropdown -->
                        <div class="relative group">
                            <button class="flex items-center space-x-3 bg-white/10 hover:bg-white/20 rounded-2xl px-4 py-2 transition-all duration-300 group">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full flex items-center justify-center text-white font-semibold shadow-lg">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <span class="text-white font-medium hidden lg:block">{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down text-white text-sm transform group-hover:rotate-180 transition-transform duration-300"></i>
                            </button>
                            
                            <div class="absolute right-0 mt-2 w-64 bg-white rounded-2xl shadow-2xl py-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-right scale-95 group-hover:scale-100 z-50 border border-gray-100">
                                <!-- User Info -->
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                                    <p class="text-sm text-gray-600">{{ auth()->user()->email }}</p>
                                    <span class="inline-block mt-1 px-2 py-1 bg-blue-100 text-blue-600 text-xs rounded-full">
                                        {{ auth()->user()->is_admin ? 'Administrator' : 'Customer' }}
                                    </span>
                                </div>
                                
                                <!-- Menu Items -->
                                <div class="py-2">
                                    @if(auth()->user()->is_admin)
                                        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200">
                                            <i class="fas fa-chart-line w-5"></i>
                                            <span>Dashboard</span>
                                        </a>
                                        <a href="{{ route('admin.products.index') }}" class="flex items-center space-x-3 px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200">
                                            <i class="fas fa-box w-5"></i>
                                            <span>Kelola Produk</span>
                                        </a>
                                        <a href="{{ route('admin.orders.index') }}" class="flex items-center space-x-3 px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200">
                                            <i class="fas fa-clipboard-list w-5"></i>
                                            <span>Kelola Pesanan</span>
                                        </a>
                                        <a href="{{ route('admin.categories.index') }}" class="flex items-center space-x-3 px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200">
                                            <i class="fas fa-tags w-5"></i>
                                            <span>Kelola Kategori</span>
                                        </a>
                                    @else
                                        <a href="{{ route('orders.index') }}" class="flex items-center space-x-3 px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200">
                                            <i class="fas fa-clipboard-list w-5"></i>
                                            <span>Pesanan Saya</span>
                                        </a>
                                        <a href="{{ route('cart.index') }}" class="flex items-center space-x-3 px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200">
                                            <i class="fas fa-shopping-cart w-5"></i>
                                            <span>Keranjang Saya</span>
                                        </a>
                                    @endif
                                </div>
                                
                                <!-- Logout -->
                                <div class="border-t border-gray-100 pt-2">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="flex items-center space-x-3 w-full px-4 py-2 text-red-600 hover:bg-red-50 transition-all duration-200">
                                            <i class="fas fa-sign-out-alt w-5"></i>
                                            <span>Keluar</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('login') }}" class="text-white hover:text-blue-100 transition px-4 py-2 rounded-xl hover:bg-white/10 font-medium">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" class="bg-white text-blue-600 hover:bg-blue-50 transition px-6 py-2 rounded-xl font-semibold shadow-lg hover-lift">
                                Daftar
                            </a>
                        </div>
                    @endauth

                    <!-- Mobile Menu Button -->
                    <button id="mobileMenuButton" class="lg:hidden text-white p-2 rounded-lg hover:bg-white/10 transition">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Search Bar -->
            <div class="md:hidden pb-4">
                <form action="{{ route('products.index') }}" method="GET">
                    <div class="relative">
                        <input type="text" 
                               name="search" 
                               placeholder="Cari produk..." 
                               value="{{ request('search') }}"
                               class="w-full pl-12 pr-4 py-3 rounded-2xl bg-white/90 backdrop-blur-sm border-0 focus:ring-2 focus:ring-blue-300 shadow-lg">
                        <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </form>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="lg:hidden glass-dark border-t border-white/20 hidden">
            <div class="container mx-auto px-4 py-4">
                <div class="flex flex-col space-y-3">
                    <a href="{{ url('/') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-white hover:bg-white/10 transition">
                        <i class="fas fa-home w-5"></i>
                        <span>Beranda</span>
                    </a>
                    <a href="{{ route('products.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-white hover:bg-white/10 transition">
                        <i class="fas fa-box w-5"></i>
                        <span>Produk</span>
                    </a>
                    
                    @auth
                        @if(!auth()->user()->is_admin)
                            <a href="{{ route('cart.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-white hover:bg-white/10 transition relative">
                                <i class="fas fa-shopping-cart w-5"></i>
                                <span>Keranjang</span>
                                @if(session()->has('cart') && is_array(session('cart')) && count(session('cart')) > 0)
                                    <span class="absolute right-4 bg-red-500 text-white text-xs rounded-full w-6 h-6 flex items-center justify-center">
                                        {{ count(session('cart')) }}
                                    </span>
                                @endif
                            </a>
                            <a href="{{ route('orders.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-white hover:bg-white/10 transition">
                                <i class="fas fa-clipboard-list w-5"></i>
                                <span>Pesanan</span>
                            </a>
                        @else
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-white hover:bg-white/10 transition">
                                <i class="fas fa-chart-line w-5"></i>
                                <span>Dashboard</span>
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <div class="container mx-auto px-4 mt-4">
        @if(session('success'))
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white p-4 rounded-2xl shadow-lg animate-slide-down mb-4" role="alert">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-check-circle text-xl"></i>
                    <p class="font-semibold">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-gradient-to-r from-red-500 to-pink-600 text-white p-4 rounded-2xl shadow-lg animate-slide-down mb-4" role="alert">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-exclamation-circle text-xl"></i>
                    <p class="font-semibold">{{ session('error') }}</p>
                </div>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-gray-900 to-gray-800 text-white mt-16">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-store text-white"></i>
                        </div>
                        <span class="text-2xl font-bold">TokoOnlineSMK</span>
                    </div>
                    <p class="text-gray-300 mb-6 leading-relaxed max-w-md">
                        Platform e-commerce modern yang dirancang khusus untuk pembelajaran SMK. Temukan produk berkualitas dengan pengalaman belanja terbaik.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-700 hover:bg-blue-600 rounded-full flex items-center justify-center transition hover-lift">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-700 hover:bg-pink-600 rounded-full flex items-center justify-center transition hover-lift">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-700 hover:bg-blue-400 rounded-full flex items-center justify-center transition hover-lift">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-700 hover:bg-green-500 rounded-full flex items-center justify-center transition hover-lift">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-bold mb-6 text-white">Link Cepat</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('products.index') }}" class="text-gray-300 hover:text-white transition flex items-center space-x-2 group">
                                <i class="fas fa-chevron-right text-xs opacity-0 group-hover:opacity-100 transition"></i>
                                <span>Produk</span>
                            </a>
                        </li>
                        @auth
                            @if(!auth()->user()->is_admin)
                                <li>
                                    <a href="{{ route('cart.index') }}" class="text-gray-300 hover:text-white transition flex items-center space-x-2 group">
                                        <i class="fas fa-chevron-right text-xs opacity-0 group-hover:opacity-100 transition"></i>
                                        <span>Keranjang</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('orders.index') }}" class="text-gray-300 hover:text-white transition flex items-center space-x-2 group">
                                        <i class="fas fa-chevron-right text-xs opacity-0 group-hover:opacity-100 transition"></i>
                                        <span>Pesanan</span>
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:text-white transition flex items-center space-x-2 group">
                                        <i class="fas fa-chevron-right text-xs opacity-0 group-hover:opacity-100 transition"></i>
                                        <span>Admin Dashboard</span>
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-bold mb-6 text-white">Kontak Kami</h3>
                    <ul class="space-y-4">
                        <li class="flex items-center space-x-3 text-gray-300">
                            <i class="fas fa-envelope text-blue-400"></i>
                            <span>info@tokoonlinesmk.com</span>
                        </li>
                        <li class="flex items-center space-x-3 text-gray-300">
                            <i class="fas fa-phone text-green-400"></i>
                            <span>+62 123-456-7890</span>
                        </li>
                        <li class="flex items-center space-x-3 text-gray-300">
                            <i class="fas fa-map-marker-alt text-red-400"></i>
                            <span>Jakarta, Indonesia</span>
                        </li>
                        <li class="flex items-center space-x-3 text-gray-300">
                            <i class="fas fa-clock text-yellow-400"></i>
                            <span>Buka 24/7</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-700 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">
                    &copy; 2024 TokoOnlineSMK. All rights reserved. | Project E-Commerce untuk SMK
                </p>
                <div class="flex space-x-6 text-sm text-gray-400">
                    <a href="#" class="hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition">Terms of Service</a>
                    <a href="#" class="hover:text-white transition">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop" class="fixed bottom-8 right-8 w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 text-white rounded-full shadow-2xl hover-lift transition-all duration-300 opacity-0 invisible z-40">
        <i class="fas fa-chevron-up"></i>
    </button>

    @vite('resources/js/app.js')
    
    <script>
        // Mobile Menu Toggle
        document.getElementById('mobileMenuButton').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('hidden');
        });

        // Auto-hide flash messages
        setTimeout(() => {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(alert => {
                alert.style.transition = 'all 0.5s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);

        // Back to Top Button
        const backToTopButton = document.getElementById('backToTop');
        
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('opacity-0', 'invisible');
                backToTopButton.classList.add('opacity-100', 'visible');
            } else {
                backToTopButton.classList.remove('opacity-100', 'visible');
                backToTopButton.classList.add('opacity-0', 'invisible');
            }
        });

        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.relative.group')) {
                const dropdowns = document.querySelectorAll('.group .absolute');
                dropdowns.forEach(dropdown => {
                    dropdown.classList.add('opacity-0', 'invisible', 'scale-95');
                });
            }
        });

        // Add loading animation to buttons
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('button, a');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (this.getAttribute('type') !== 'submit' && !this.href.includes('#')) {
                        this.classList.add('transform', 'scale-95');
                        setTimeout(() => {
                            this.classList.remove('transform', 'scale-95');
                        }, 150);
                    }
                });
            });
        });
    </script>
</body>
</html>