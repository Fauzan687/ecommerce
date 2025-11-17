@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="animate-slide-in">
    <!-- Logo & Header -->
    <div class="text-center mb-8">
        <div class="w-20 h-20 mx-auto mb-4 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm animate-glow">
            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-white mb-2">Buat Akun Baru</h1>
        <p class="text-white/80">Bergabung dengan komunitas kami</p>
    </div>

    <!-- Register Card -->
    <div class="bg-white/10 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/20 card-hover p-8">
        <form class="space-y-6" action="{{ route('register') }}" method="POST">
            @csrf

            <!-- Name Input -->
            <div class="space-y-2">
                <label for="name" class="flex items-center text-sm font-medium text-white">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Nama Lengkap
                </label>
                <input id="name" name="name" type="text" required 
                       class="w-full px-4 py-4 bg-white/5 border border-white/10 rounded-2xl text-white placeholder-white/50 focus:outline-none focus:border-white/30 transition-all duration-300"
                       placeholder="Masukkan nama lengkap"
                       value="{{ old('name') }}">
            </div>

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
            <div class="space-y-2">
                <label for="password" class="flex items-center text-sm font-medium text-white">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Password
                </label>
                <input id="password" name="password" type="password" required 
                       class="w-full px-4 py-4 bg-white/5 border border-white/10 rounded-2xl text-white placeholder-white/50 focus:outline-none focus:border-white/30 transition-all duration-300"
                       placeholder="Buat password yang kuat">
            </div>

            <!-- Confirm Password Input -->
            <div class="space-y-2">
                <label for="password_confirmation" class="flex items-center text-sm font-medium text-white">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Konfirmasi Password
                </label>
                <input id="password_confirmation" name="password_confirmation" type="password" required 
                       class="w-full px-4 py-4 bg-white/5 border border-white/10 rounded-2xl text-white placeholder-white/50 focus:outline-none focus:border-white/30 transition-all duration-300"
                       placeholder="Ulangi password Anda">
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="bg-red-500/20 border border-red-500/30 rounded-2xl p-4">
                    <div class="space-y-1">
                        @foreach ($errors->all() as $error)
                        <div class="flex items-center text-red-200 text-sm">
                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $error }}
                        </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Submit Button -->
            <button type="submit" 
                    class="w-full bg-gradient-to-r from-green-500 to-blue-600 text-white py-4 px-6 rounded-2xl font-semibold hover:from-green-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-white/50 focus:ring-offset-2 focus:ring-offset-transparent transition-all duration-300 transform hover:scale-105 active:scale-95 shadow-lg">
                <span class="flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    Daftar Sekarang
                </span>
            </button>

            <!-- Login Link -->
            <div class="text-center pt-4 border-t border-white/10">
                <p class="text-white/70 text-sm">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-white font-semibold hover:text-blue-200 transition-colors duration-200 ml-1 underline">
                        Masuk di sini
                    </a>
                </p>
            </div>
        </form>
    </div>

    <!-- Features -->
    <div class="mt-6 grid grid-cols-3 gap-4 text-center">
        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-3 border border-white/10">
            <div class="w-8 h-8 mx-auto mb-2 bg-white/10 rounded-full flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <p class="text-white/70 text-xs">Aman</p>
        </div>
        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-3 border border-white/10">
            <div class="w-8 h-8 mx-auto mb-2 bg-white/10 rounded-full flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <p class="text-white/70 text-xs">Cepat</p>
        </div>
        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-3 border border-white/10">
            <div class="w-8 h-8 mx-auto mb-2 bg-white/10 rounded-full flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <p class="text-white/70 text-xs">Komunitas</p>
        </div>
    </div>
</div>
@endsection