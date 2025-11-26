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

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @keyframes slideIn {
            from { 
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            to { 
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .animate-slide-down {
            animation: slideDown 0.5s ease-out;
        }
        
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        .animate-slide-in {
            animation: slideIn 0.6s ease-out;
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
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
            background: rgba(15, 23, 42, 0.9); /* Darker background for better contrast */
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

        /* Card hover effects */
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        /* Input focus effects */
        .input-focus:focus {
            transform: scale(1.02);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* Mobile menu animation */
        .mobile-menu-enter {
            transform: translateX(100%);
        }
        
        .mobile-menu-enter-active {
            transform: translateX(0);
            transition: transform 0.3s ease-out;
        }

        /* Background animation elements */
        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .bg-circle {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
            animation: float 6s ease-in-out infinite;
        }

        .bg-circle:nth-child(1) {
            width: 200px;
            height: 200px;
            top: -50px;
            left: -50px;
            animation-delay: 0s;
        }

        .bg-circle:nth-child(2) {
            width: 150px;
            height: 150px;
            top: 20%;
            right: -30px;
            animation-delay: -2s;
        }

        .bg-circle:nth-child(3) {
            width: 180px;
            height: 180px;
            bottom: 10%;
            left: 10%;
            animation-delay: -4s;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen flex flex-col font-sans relative">
    <!-- Animated Background -->
    <div class="bg-animation">
        <div class="bg-circle"></div>
        <div class="bg-circle"></div>
        <div class="bg-circle"></div>
    </div>

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
                    <a href="{{ url('/') }}" class="px-4 py-2 rounded-lg text-white hover:bg-blue-500/20 hover:text-blue-200 transition-all duration-300 font-medium flex items-center space-x-2">
                        <i class="fas fa-home"></i>
                        <span>Beranda</span>
                    </a>
                    <a href="{{ route('products.index') }}" class="px-4 py-2 rounded-lg text-white hover:bg-blue-500/20 hover:text-blue-200 transition-all duration-300 font-medium flex items-center space-x-2">
                        <i class="fas fa-box"></i>
                        <span>Produk</span>
                    </a>
                    
                    @auth
                        @if(!auth()->user()->is_admin)
                            <a href="{{ route('cart.index') }}" class="px-4 py-2 rounded-lg text-white hover:bg-blue-500/20 hover:text-blue-200 transition-all duration-300 font-medium flex items-center space-x-2 relative">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Keranjang</span>
                                @if(session()->has('cart') && is_array(session('cart')) && count(session('cart')) > 0)
                                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center pulse-glow">
                                        {{ count(session('cart')) }}
                                    </span>
                                @endif
                            </a>
                            <a href="{{ route('orders.index') }}" class="px-4 py-2 rounded-lg text-white hover:bg-blue-500/20 hover:text-blue-200 transition-all duration-300 font-medium flex items-center space-x-2">
                                <i class="fas fa-clipboard-list"></i>
                                <span>Pesanan</span>
                            </a>
                        @else
                            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-lg text-white hover:bg-blue-500/20 hover:text-blue-200 transition-all duration-300 font-medium flex items-center space-x-2">
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
                            <button class="flex items-center space-x-3 bg-white/10 hover:bg-blue-500/20 text-white hover:text-blue-200 rounded-2xl px-4 py-2 transition-all duration-300 group">
                                <img src="{{ auth()->user()->avatar_url }}" 
                                     alt="{{ auth()->user()->name }}"
                                     class="w-8 h-8 rounded-full object-cover border-2 border-white shadow-lg">
                                <span class="font-medium hidden lg:block">{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down text-sm transform group-hover:rotate-180 transition-transform duration-300"></i>
                            </button>
                            
                            <div class="absolute right-0 mt-2 w-64 bg-white rounded-2xl shadow-2xl py-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-right scale-95 group-hover:scale-100 z-50 border border-gray-100">
                                <!-- User Info -->
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <div class="flex items-center space-x-3 mb-2">
                                        <img src="{{ auth()->user()->avatar_url }}" 
                                             alt="{{ auth()->user()->name }}"
                                             class="w-12 h-12 rounded-full object-cover border-2 border-blue-100">
                                        <div class="flex-1">
                                            <p class="font-semibold text-gray-800 truncate">{{ auth()->user()->name }}</p>
                                            <p class="text-sm text-gray-600 truncate">{{ auth()->user()->email }}</p>
                                        </div>
                                    </div>
                                    <span class="inline-block px-3 py-1 bg-gradient-to-r from-blue-500 to-purple-600 text-white text-xs rounded-full font-semibold">
                                        {{ auth()->user()->is_admin ? '👑 Administrator' : '👤 Customer' }}
                                    </span>
                                </div>
                                
                                <!-- Menu Items -->
                                <div class="py-2">
                                    <!-- Profile Link for All Users -->
                                    <a href="{{ route('profile.index') }}" class="flex items-center space-x-3 px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group">
                                        <i class="fas fa-user w-5 group-hover:scale-110 transition-transform"></i>
                                        <span>Profil Saya</span>
                                    </a>
                                    
                                    @if(auth()->user()->is_admin)
                                        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200 group">
                                            <i class="fas fa-chart-line w-5 group-hover:scale-110 transition-transform"></i>
                                            <span>Dashboard</span>
                                        </a>
                                        <a href="{{ route('admin.products.index') }}" class="flex items-center space-x-3 px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group">
                                            <i class="fas fa-box w-5 group-hover:scale-110 transition-transform"></i>
                                            <span>Kelola Produk</span>
                                        </a>
                                        <a href="{{ route('admin.orders.index') }}" class="flex items-center space-x-3 px-4 py-2 text-gray-700 hover:bg-green-50 hover:text-green-600 transition-all duration-200 group">
                                            <i class="fas fa-clipboard-list w-5 group-hover:scale-110 transition-transform"></i>
                                            <span>Kelola Pesanan</span>
                                        </a>
                                        <a href="{{ route('admin.categories.index') }}" class="flex items-center space-x-3 px-4 py-2 text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-all duration-200 group">
                                            <i class="fas fa-tags w-5 group-hover:scale-110 transition-transform"></i>
                                            <span>Kelola Kategori</span>
                                        </a>
                                    @else
                                        <a href="{{ route('orders.index') }}" class="flex items-center space-x-3 px-4 py-2 text-gray-700 hover:bg-green-50 hover:text-green-600 transition-all duration-200 group">
                                            <i class="fas fa-clipboard-list w-5 group-hover:scale-110 transition-transform"></i>
                                            <span>Pesanan Saya</span>
                                        </a>
                                        <a href="{{ route('cart.index') }}" class="flex items-center space-x-3 px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group">
                                            <i class="fas fa-shopping-cart w-5 group-hover:scale-110 transition-transform"></i>
                                            <span>Keranjang Saya</span>
                                            @if(session()->has('cart') && is_array(session('cart')) && count(session('cart')) > 0)
                                                <span class="ml-auto bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                                    {{ count(session('cart')) }}
                                                </span>
                                            @endif
                                        </a>
                                    @endif
                                </div>
                                
                                <!-- Logout -->
                                <div class="border-t border-gray-100 pt-2">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="flex items-center space-x-3 w-full px-4 py-2 text-red-600 hover:bg-red-50 transition-all duration-200 group">
                                            <i class="fas fa-sign-out-alt w-5 group-hover:scale-110 transition-transform"></i>
                                            <span>Keluar</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('login') }}" class="text-white hover:text-blue-200 transition px-4 py-2 rounded-xl hover:bg-blue-500/20 font-medium">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" class="bg-white text-blue-600 hover:bg-blue-50 transition px-6 py-2 rounded-xl font-semibold shadow-lg hover-lift">
                                Daftar
                            </a>
                        </div>
                    @endauth

                    <!-- Mobile Menu Button -->
                    <button id="mobileMenuButton" class="lg:hidden text-white p-2 rounded-lg hover:bg-blue-500/20 hover:text-blue-200 transition">
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
                    <a href="{{ url('/') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-white hover:bg-blue-500/20 hover:text-blue-200 transition">
                        <i class="fas fa-home w-5"></i>
                        <span>Beranda</span>
                    </a>
                    <a href="{{ route('products.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-white hover:bg-blue-500/20 hover:text-blue-200 transition">
                        <i class="fas fa-box w-5"></i>
                        <span>Produk</span>
                    </a>
                    
                    @auth
                        <a href="{{ route('profile.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-white hover:bg-blue-500/20 hover:text-blue-200 transition">
                            <i class="fas fa-user w-5"></i>
                            <span>Profil Saya</span>
                        </a>
                        
                        @if(!auth()->user()->is_admin)
                            <a href="{{ route('cart.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-white hover:bg-blue-500/20 hover:text-blue-200 transition relative">
                                <i class="fas fa-shopping-cart w-5"></i>
                                <span>Keranjang</span>
                                @if(session()->has('cart') && is_array(session('cart')) && count(session('cart')) > 0)
                                    <span class="absolute right-4 bg-red-500 text-white text-xs rounded-full w-6 h-6 flex items-center justify-center">
                                        {{ count(session('cart')) }}
                                    </span>
                                @endif
                            </a>
                            <a href="{{ route('orders.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-white hover:bg-blue-500/20 hover:text-blue-200 transition">
                                <i class="fas fa-clipboard-list w-5"></i>
                                <span>Pesanan</span>
                            </a>
                        @else
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-white hover:bg-blue-500/20 hover:text-blue-200 transition">
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

            // Add parallax effect to background circles
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const circles = document.querySelectorAll('.bg-circle');
                
                circles.forEach((circle, index) => {
                    const rate = scrolled * -0.1 * (index + 1);
                    circle.style.transform = `translateY(${rate}px)`;
                });
            });

            // Add floating animation to elements with animate-float class
            const floatElements = document.querySelectorAll('.animate-float');
            floatElements.forEach((el, index) => {
                el.style.animationDelay = `${index * 2}s`;
            });
        });

        // Add smooth page transitions
        document.addEventListener('DOMContentLoaded', function() {
            // Add fade-in animation to all animate-fade-in elements
            const fadeElements = document.querySelectorAll('.animate-fade-in');
            fadeElements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>