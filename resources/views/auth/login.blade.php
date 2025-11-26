@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="animate-slide-in">
    <!-- Logo & Header -->
    <div class="text-center mb-8">
        <div class="w-20 h-20 mx-auto mb-4 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm animate-glow">
            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-white mb-2">Selamat Datang Kembali</h1>
        <p class="text-white/80">Masuk ke akun Anda untuk melanjutkan</p>
    </div>

    <!-- Login Card -->
    <div class="bg-white/10 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/20 card-hover p-8">
        <form class="space-y-6" action="{{ route('login') }}" method="POST">
            @csrf

            <!-- Email Input -->
            <div class="space-y-2">
                <label for="email" class="flex items-center text-sm font-medium text-white">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                    </svg>
                    Alamat Email
                </label>
                <input id="email" name="email" type="email" required 
                       class="w-full px-4 py-4 bg-white/5 border border-white/10 rounded-2xl text-white placeholder-white/50 focus:outline-none focus:border-white/30 transition-all duration-300"
                       placeholder="email@example.com"
                       value="{{ old('email') }}">
            </div>

            <!-- Password Input -->
             <!-- Password Input -->
            <div class="space-y-2">
                <label for="password" class="flex items-center text-sm font-medium text-white">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Password
                </label>
                <div class="relative">
                    <input id="password" name="password" type="password" required 
                           class="w-full px-4 py-4 bg-white/5 border border-white/10 rounded-2xl text-white placeholder-white/50 focus:outline-none focus:border-white/30 transition-all duration-300 pr-12"
                           placeholder="Masukkan password Anda">
                    <button type="button" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white/50 hover:text-white/70 focus:outline-none" onclick="togglePassword('password')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="eye-icon-password">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded bg-white/5 border-white/10 text-blue-600 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-white/80">Ingat saya</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-sm text-white hover:text-blue-200 transition-colors duration-200">
                    Lupa password?
                </a>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="bg-red-500/20 border border-red-500/30 rounded-2xl p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-red-200 text-sm">{{ $errors->first() }}</span>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-500/20 border border-green-500/30 rounded-2xl p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span class="text-green-200 text-sm">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Submit Button -->
            <button type="submit" 
                    class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-4 px-6 rounded-2xl font-semibold hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-white/50 focus:ring-offset-2 focus:ring-offset-transparent transition-all duration-300 transform hover:scale-105 active:scale-95 shadow-lg">
                <span class="flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Masuk ke Akun
                </span>
            </button>

            <!-- Register Link -->
            <div class="text-center pt-4 border-t border-white/10">
                <p class="text-white/70 text-sm">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-white font-semibold hover:text-blue-200 transition-colors duration-200 ml-1 underline">
                        Daftar Sekarang
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection