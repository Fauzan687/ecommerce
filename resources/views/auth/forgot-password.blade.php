@extends('layouts.auth')

@section('title', 'Lupa Password')

@section('content')
<div class="animate-slide-in">
    <!-- Logo & Header -->
    <div class="text-center mb-8">
        <div class="w-20 h-20 mx-auto mb-4 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm animate-glow">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-white mb-2">Lupa Password?</h1>
        <p class="text-white/80">Masukkan email Anda dan kami akan mengirimkan link untuk reset password</p>
    </div>

    <!-- Success Message -->
    @if (session('status'))
        <div class="bg-green-500/20 border border-green-500/30 rounded-2xl p-4 mb-6">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                <span class="text-green-200 text-sm">{{ session('status') }}</span>
            </div>
        </div>
    @endif

    <!-- Form -->
    <div class="bg-white/10 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/20 card-hover p-8">
        <form class="space-y-6" action="{{ route('password.email') }}" method="POST">
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
                @error('email')
                    <p class="text-red-300 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                    class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-4 px-6 rounded-2xl font-semibold hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-white/50 focus:ring-offset-2 focus:ring-offset-transparent transition-all duration-300 transform hover:scale-105 active:scale-95 shadow-lg">
                <span class="flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Kirim Link Reset Password
                </span>
            </button>

            <!-- Login Link -->
            <div class="text-center pt-4 border-t border-white/10">
                <p class="text-white/70 text-sm">
                    Ingat password?
                    <a href="{{ route('login') }}" class="text-white font-semibold hover:text-blue-200 transition-colors duration-200 ml-1 underline">
                        Masuk di sini
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection