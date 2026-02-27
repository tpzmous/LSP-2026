<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-neon-dark text-gray-200 selection:bg-neon-blue selection:text-neon-dark">
        <div class="min-h-screen flex text-sm">
            <!-- Sidebar -->
            <aside class="w-64 bg-neon-gray border-r border-neon-border hidden md:flex flex-col">
                <div class="p-4 border-b border-neon-border">
                    <h1 class="text-xl font-black text-white tracking-widest uppercase flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-neon-blue shadow-neon-blue"></span>
                        Admin Panel
                    </h1>
                </div>
                <nav class="flex-1 p-4 space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-neon-blue/10 text-neon-blue border border-neon-blue shadow-neon-blue' : 'text-gray-400 hover:text-white hover:bg-neon-gray' }} transition-all">Dashboard</a>
                    <a href="{{ route('admin.comics.index') }}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('admin.comics.*') ? 'bg-neon-blue/10 text-neon-blue border border-neon-blue shadow-neon-blue' : 'text-gray-400 hover:text-white hover:bg-neon-gray' }} transition-all">Comics</a>
                </nav>
                <div class="p-4 border-t border-neon-border">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-red-500 hover:bg-red-500/10 rounded-lg transition-all">
                            Log Out
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 flex flex-col h-screen overflow-hidden">
                <header class="h-16 border-b border-neon-border bg-neon-dark flex items-center px-6 sticky top-0 md:hidden">
                    <h1 class="text-xl font-black text-white tracking-widest uppercase">Admin Panel</h1>
                </header>
                <div class="flex-1 overflow-auto p-4 md:p-8">
                    @if(session('success'))
                        <div class="mb-6 p-4 border border-green-500 bg-green-500/10 text-green-400 rounded-lg shadow-[0_0_10px_rgba(34,197,94,0.3)]">
                            {{ session('success') }}
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </body>
</html>
