<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        @stack('head')
    </head>
    <body class="font-sans antialiased bg-gradient-to-br from-neon-dark to-neon-gray min-h-screen text-neon-text selection:bg-neon-blue selection:text-neon-dark flex flex-col transition-colors duration-300">
        <!-- Navigation (Sticky Glassmorphism) -->
        <nav class="sticky top-0 z-50 bg-neon-dark/40 backdrop-blur-md border-b border-neon-border/50 shadow-glass transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <!-- Logo -->
                    <div class="flex items-center gap-10">
                        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                            <span class="w-3 h-3 rounded-full bg-neon-blue shadow-neon-blue group-hover:scale-125 transition-transform duration-300"></span>
                            <span class="text-2xl font-black text-neon-text tracking-wider uppercase drop-shadow-[0_0_8px_rgba(0,229,255,0.6)] group-hover:text-white transition-colors duration-300">N-Comics</span>
                        </a>
                        
                        <!-- Main Menu -->
                        <div class="hidden lg:flex items-center gap-6">
                            <a href="{{ route('home') }}" class="text-sm font-bold uppercase tracking-widest transition-all duration-300 {{ request()->routeIs('home') ? 'text-neon-blue drop-shadow-[0_0_5px_rgba(0,229,255,0.8)]' : 'text-neon-subtext hover:text-white hover:drop-shadow-[0_0_5px_rgba(255,255,255,0.5)]' }}">Home</a>
                            <a href="{{ route('comic.index') }}" class="text-sm font-bold uppercase tracking-widest transition-all duration-300 {{ request()->routeIs('comic.index') ? 'text-neon-blue drop-shadow-[0_0_5px_rgba(0,229,255,0.8)]' : 'text-neon-subtext hover:text-white hover:drop-shadow-[0_0_5px_rgba(255,255,255,0.5)]' }}">Semua Komik</a>
                        </div>
                    </div>

                    <!-- Right Section -->
                    <div class="flex items-center gap-6">
                        <!-- Glass Search Bar -->
                        <form action="{{ route('comic.index') }}" method="GET" class="hidden md:block relative group w-48 focus-within:w-64 transition-all duration-300">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul..." class="w-full bg-neon-dark/30 backdrop-blur-sm border border-neon-border/50 text-neon-text text-sm rounded-full pl-5 pr-12 py-2 focus:ring-1 focus:ring-neon-blue focus:border-neon-blue focus:bg-neon-dark/60 placeholder-neon-subtext/70 transition-all duration-300 group-hover:border-neon-blue/40 shadow-inner">
                            <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-neon-subtext hover:text-neon-blue transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                            </button>
                        </form>

                        <!-- Auth Buttons -->
                        <div class="flex items-center gap-3">
                            @auth
                                <a href="{{ route('admin.dashboard') }}" class="px-5 py-2 rounded-full border border-neon-purple text-neon-purple hover:bg-neon-purple/10 text-sm font-bold uppercase tracking-widest transition-all duration-300 shadow-[0_0_10px_rgba(139,92,246,0.2)] hover:shadow-neon-purple">Admin</a>
                            @else
                                <a href="{{ route('login') }}" class="px-5 py-2 rounded-full border border-neon-subtext text-neon-text hover:border-neon-blue hover:text-neon-blue text-sm font-bold uppercase tracking-widest transition-all duration-300">Masuk</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-1">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="mt-auto bg-[#080d17] border-t border-neon-blue/30 shadow-[0_-5px_30px_rgba(0,229,255,0.1)] pt-16 pb-8 relative overflow-hidden z-10">
            <!-- Subtle glow line -->
            <div class="absolute top-0 left-0 right-0 h-[1px] bg-gradient-to-r from-transparent via-neon-blue to-transparent opacity-50"></div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
                    <!-- Column 1 -->
                    <div>
                        <a href="{{ route('home') }}" class="flex items-center gap-2 mb-6">
                            <span class="w-2 h-2 rounded-full bg-neon-blue shadow-neon-blue"></span>
                            <span class="text-xl font-black text-neon-text tracking-widest uppercase shadow-[0_0_5px_rgba(0,229,255,0.5)]">N-Comics</span>
                        </a>
                        <p class="text-neon-subtext text-sm leading-relaxed max-w-xs">
                            Platform komik modern dengan koleksi cerita tanpa batas. Nikmati pengalaman membaca vertikal terbaik dengan UI interaktif yang memesona.
                        </p>
                    </div>
                    
                    <!-- Column 2 -->
                    <div>
                        <h4 class="text-white font-bold uppercase tracking-widest text-sm mb-6">Navigasi Utama</h4>
                        <ul class="space-y-3">
                            <li><a href="{{ route('home') }}" class="text-neon-subtext hover:text-neon-blue transition-colors text-sm">Beranda</a></li>
                            <li><a href="{{ route('comic.index') }}" class="text-neon-subtext hover:text-neon-blue transition-colors text-sm">Semua Komik</a></li>
                            <li><a href="#" class="text-neon-subtext hover:text-neon-blue transition-colors text-sm">Genre Populer</a></li>
                            <li><a href="#" class="text-neon-subtext hover:text-neon-blue transition-colors text-sm">Rilis Terbaru</a></li>
                        </ul>
                    </div>
                    
                    <!-- Column 3 -->
                    <div>
                        <h4 class="text-white font-bold uppercase tracking-widest text-sm mb-6">Sosial Media</h4>
                        <ul class="space-y-3">
                            <li><a href="#" class="text-neon-subtext hover:text-neon-purple hover:drop-shadow-[0_0_5px_rgba(139,92,246,0.8)] transition-all text-sm flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-neon-subtext"></span> Discord</a></li>
                            <li><a href="#" class="text-neon-subtext hover:text-neon-blue transition-all text-sm flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-neon-subtext"></span> Twitter / X</a></li>
                            <li><a href="#" class="text-neon-subtext hover:text-pink-400 hover:drop-shadow-[0_0_5px_rgba(244,114,182,0.8)] transition-all text-sm flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-neon-subtext"></span> Instagram</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="border-t border-neon-border/50 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-xs text-neon-subtext">&copy; {{ date('Y') }} N-Comics Platform. All rights reserved.</p>
                    <div class="flex gap-4">
                        <a href="#" class="text-xs text-neon-subtext hover:text-white transition-colors">Privacy Policy</a>
                        <a href="#" class="text-xs text-neon-subtext hover:text-white transition-colors">Terms of Service</a>
                    </div>
                </div>
            </div>
        </footer>
    @stack('scripts')
    </body>
</html>
