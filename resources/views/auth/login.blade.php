<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Log in - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,900&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-neon-dark text-gray-200 selection:bg-neon-blue selection:text-neon-dark font-sans text-gray-900 antialiased min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Neon Background Accents -->
    <div class="absolute top-[-20%] left-[-10%] w-96 h-96 bg-neon-blue rounded-full mix-blend-screen filter blur-[150px] opacity-20"></div>
    <div class="absolute bottom-[-20%] right-[-10%] w-96 h-96 bg-purple-600 rounded-full mix-blend-screen filter blur-[150px] opacity-20"></div>

    <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-neon-card border border-neon-border rounded-2xl shadow-[0_0_30px_rgba(0,0,0,0.8)] relative z-10 backdrop-blur-sm">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-2 mb-4 group">
                <span class="w-4 h-4 rounded-full bg-neon-blue shadow-[0_0_15px_rgba(0,243,255,0.8)] group-hover:scale-125 transition-transform"></span>
                <span class="text-3xl font-black text-white tracking-widest uppercase">N-Comics</span>
            </a>
            <p class="text-gray-400 font-medium">Selamat datang kembali, Admin.</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-bold text-gray-300 uppercase tracking-wide mb-2">Email</label>
                <input id="email" class="block w-full bg-neon-dark/50 border border-neon-border text-white rounded-lg focus:ring-neon-blue focus:border-neon-blue shadow-inner p-3 transition-colors" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="admin@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-bold text-gray-300 uppercase tracking-wide mb-2">Password</label>
                <input id="password" class="block w-full bg-neon-dark/50 border border-neon-border text-white rounded-lg focus:ring-neon-blue focus:border-neon-blue shadow-inner p-3 transition-colors" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                    <input id="remember_me" type="checkbox" class="rounded bg-neon-dark border-neon-border text-neon-blue shadow-sm focus:ring-neon-blue focus:ring-offset-neon-card" name="remember">
                    <span class="ms-2 text-sm text-gray-400 group-hover:text-white transition-colors">Ingat saya</span>
                </label>
                
                @if (Route::has('password.request'))
                    <a class="text-sm text-neon-blue hover:text-white hover:underline transition-colors focus:outline-none" href="{{ route('password.request') }}">
                        Lupa kata sandi?
                    </a>
                @endif
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-[0_0_15px_rgba(0,243,255,0.4)] hover:shadow-[0_0_25px_rgba(0,243,255,0.6)] text-sm font-black uppercase tracking-widest text-neon-dark bg-neon-blue hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neon-blue focus:ring-offset-neon-card transition-all duration-300">
                    Masuk
                </button>
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="text-xs text-gray-500 hover:text-gray-300 transition-colors uppercase tracking-widest">
                    &larr; Kembali ke Beranda
                </a>
            </div>
        </form>
    </div>
</body>
</html>
