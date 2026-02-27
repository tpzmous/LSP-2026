@extends('layouts.public')

@section('content')
<!-- HERO SECTION -->
<section style="position:relative; overflow:hidden; min-height:90vh; display:flex; align-items:center;">

    <!-- Ambient glows (pure decorative) -->
    <div style="position:absolute; inset:0; pointer-events:none; overflow:hidden;">
        <div style="position:absolute; top:50%; left:30%; transform:translate(-50%,-50%); width:500px; height:500px; border-radius:50%; background:radial-gradient(circle, rgba(0,229,255,0.13) 0%, transparent 70%);"></div>
        <div style="position:absolute; top:5%; right:5%; width:480px; height:480px; border-radius:50%; background:radial-gradient(circle, rgba(139,92,246,0.11) 0%, transparent 70%);"></div>
    </div>

    <!-- Container: 1200px max, centered, padded 40px each side -->
    <div style="position:relative; z-index:10; max-width:1200px; width:100%; margin:0 auto; padding:80px 40px; display:flex; flex-direction:row; align-items:center; justify-content:space-between; gap:60px;">

        <!-- ========== LEFT 55% ========== -->
        <div style="flex:0 0 55%; max-width:55%;" class="animate-fade-in-up">

            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-neon-blue/10 border border-neon-blue/30 text-neon-blue text-xs font-bold uppercase tracking-widest" style="margin-bottom:24px;">
                <span class="w-2 h-2 rounded-full bg-neon-blue animate-pulse"></span> Update Setiap Hari
            </div>

            <!-- Heading -->
            <h1 class="font-black text-white" style="font-size:clamp(2.5rem,5vw,4.5rem); line-height:1.08; letter-spacing:-0.02em; margin-bottom:24px;">
                Baca Komik<br>
                Favoritmu<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-neon-blue via-cyan-300 to-neon-purple">Tanpa Batas</span>
            </h1>

            <!-- Subtext -->
            <p class="text-neon-subtext leading-relaxed" style="font-size:1.1rem; max-width:430px; margin-bottom:32px;">
                Ribuan cerita seru dalam satu platform modern. Nikmati pengalaman membaca vertikal terbaik dengan kualitas gambar premium.
            </p>

            <!-- CTA Buttons -->
            <div style="display:flex; flex-wrap:wrap; gap:16px; margin-bottom:40px;">
                <a href="{{ route('comic.index') }}"
                   class="px-8 py-4 rounded-xl bg-neon-blue text-neon-dark font-black uppercase tracking-widest text-sm shadow-neon-blue hover:bg-white transition-all duration-300"
                   style="text-decoration:none; display:inline-block;">
                    Mulai Membaca &rarr;
                </a>
                <a href="{{ route('comic.index') }}"
                   class="px-8 py-4 rounded-xl border-2 border-white/20 text-white font-bold uppercase tracking-widest text-sm hover:border-neon-blue hover:text-neon-blue hover:bg-neon-blue/10 transition-all duration-300"
                   style="text-decoration:none; display:inline-block;">
                    Jelajahi Komik
                </a>
            </div>

            <!-- Stats (NO border-top divider) -->
            <div style="display:flex; align-items:center; gap:32px;">
                <div>
                    <p class="text-white font-black" style="font-size:1.5rem; line-height:1;">1K+</p>
                    <p class="text-neon-subtext uppercase tracking-widest" style="font-size:0.7rem; margin-top:4px;">Judul Komik</p>
                </div>
                <div style="width:1px; height:32px; background:rgba(255,255,255,0.1);"></div>
                <div>
                    <p class="text-white font-black" style="font-size:1.5rem; line-height:1;">50K+</p>
                    <p class="text-neon-subtext uppercase tracking-widest" style="font-size:0.7rem; margin-top:4px;">Pembaca Aktif</p>
                </div>
                <div style="width:1px; height:32px; background:rgba(255,255,255,0.1);"></div>
                <div>
                    <p class="text-white font-black" style="font-size:1.5rem; line-height:1;">Free</p>
                    <p class="text-neon-subtext uppercase tracking-widest" style="font-size:0.7rem; margin-top:4px;">100% Gratis</p>
                </div>
            </div>
        </div>
        <!-- ========== END LEFT ========== -->

        <!-- ========== RIGHT 45% ========== -->
        <div style="flex:0 0 45%; max-width:45%; position:relative; height:540px; display:flex; align-items:center; justify-content:center; overflow:hidden;">

            <!-- Glow behind cards -->
            <div style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); width:280px; height:280px; border-radius:50%; background:rgba(0,229,255,0.15); filter:blur(60px); pointer-events:none;"></div>
            <div style="position:absolute; top:30%; left:30%; width:180px; height:180px; border-radius:50%; background:rgba(139,92,246,0.12); filter:blur(50px); pointer-events:none;"></div>

            @if($comics->count() > 2)
            <!-- 3rd card: back, rotated -->
            <div class="animate-float-slow" style="position:absolute; bottom:30px; left:10px; z-index:1;">
                <div style="width:110px; aspect-ratio:2/3; border-radius:16px; overflow:hidden; transform:rotate(-18deg) scale(0.85); opacity:0.4; border:1px solid rgba(255,255,255,0.1); box-shadow:0 20px 40px rgba(0,0,0,0.7);">
                    <img src="{{ Storage::url($comics[2]->cover_image) }}" style="width:100%; height:100%; object-fit:cover;" alt="">
                    <div style="position:absolute; inset:0; background:rgba(11,18,32,0.5);"></div>
                </div>
            </div>
            @endif

            @if($comics->count() > 1)
            <!-- 2nd card: mid layer, angled -->
            <div class="animate-float-delayed" style="position:absolute; top:40px; left:20px; z-index:2;">
                <div style="width:160px; aspect-ratio:2/3; border-radius:16px; overflow:hidden; transform:rotate(-9deg); opacity:0.65; border:1px solid rgba(167,139,250,0.3); box-shadow:0 20px 50px rgba(0,0,0,0.6),0 0 20px rgba(139,92,246,0.15);">
                    <img src="{{ Storage::url($comics[1]->cover_image) }}" style="width:100%; height:100%; object-fit:cover;" alt="">
                    <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(11,18,32,0.6), transparent);"></div>
                </div>
            </div>
            @endif

            @if($comics->count() > 0)
            <!-- MAIN card: front, centered -->
            <div class="animate-float group" style="position:relative; z-index:10;">
                <div class="hover:scale-105 transition-all duration-500"
                     style="width:310px; height:465px; border-radius:20px; overflow:hidden; border:1px solid rgba(0,229,255,0.5); box-shadow:0 30px 70px rgba(0,0,0,0.8), 0 0 40px rgba(0,229,255,0.25); cursor:pointer; position:relative;">
                    <img src="{{ Storage::url($comics[0]->cover_image) }}"
                         class="group-hover:scale-110 transition-transform duration-700"
                         style="width:100%; height:100%; object-fit:cover; display:block;"
                         alt="{{ $comics[0]->title }}">
                    <!-- Gradient -->
                    <div style="position:absolute; inset:0; background:linear-gradient(to top, #0B1220 0%, rgba(11,18,32,0.15) 50%, transparent 100%);"></div>
                    <!-- Info -->
                    <div style="position:absolute; bottom:0; left:0; right:0; padding:20px;">
                        <div style="display:flex; gap:8px; flex-wrap:wrap; margin-bottom:8px;">
                            <span class="bg-neon-blue text-neon-dark font-black uppercase text-[10px] rounded-md px-2 py-0.5">&#9733; Trending</span>
                            @if($comics[0]->genre)
                            <span style="background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); color:white; font-size:10px; font-weight:700; text-transform:uppercase; border-radius:6px; padding:2px 8px; backdrop-filter:blur(4px);">{{ $comics[0]->genre }}</span>
                            @endif
                        </div>
                        <h3 class="text-white font-black" style="font-size:1.1rem; line-height:1.3; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $comics[0]->title }}</h3>
                        <p class="text-neon-subtext" style="font-size:0.75rem; margin-top:4px;">{{ $comics[0]->author }}</p>
                    </div>
                </div>
            </div>
            @else
            <!-- Empty placeholder -->
            <div style="position:relative; z-index:10; width:280px; aspect-ratio:2/3; border-radius:20px; border:2px dashed rgba(0,229,255,0.25); display:flex; flex-direction:column; align-items:center; justify-content:center; gap:16px; padding:32px; text-align:center;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" style="width:64px; height:64px; color:rgba(0,229,255,0.25);">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0118 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
                <p class="text-neon-subtext uppercase tracking-widest font-bold" style="font-size:0.7rem;">Tambahkan komik<br>untuk melihat preview</p>
            </div>
            @endif

        </div>
        <!-- ========== END RIGHT ========== -->

    </div>
</section>

<!-- Main Content Grid -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
    <!-- Section Header -->
    <div class="flex flex-col sm:flex-row justify-between items-end gap-6 mb-12">
        <div>
            <h2 class="text-3xl md:text-4xl font-black uppercase tracking-wider text-white">
                Rilis <span class="text-transparent bg-clip-text bg-gradient-to-r from-neon-blue to-cyan-300 drop-shadow-[0_0_10px_rgba(0,229,255,0.5)]">Terbaru</span>
            </h2>
            <p class="text-neon-subtext mt-2">Update chapter terbaru dari komik favoritmu.</p>
        </div>
        <a href="{{ route('comic.index') }}" class="group flex items-center gap-2 text-sm font-bold text-neon-blue uppercase tracking-widest hover:text-white transition-colors duration-300">
            Lihat Semua 
            <span class="transform group-hover:translate-x-1 transition-transform">&rarr;</span>
        </a>
    </div>

    @if($comics->count() > 0)
        <!-- Modern Grid 1 (Mobile), 2 (Tablet), 4 (Desktop) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($comics as $comic)
            <a href="{{ route('comic.show', $comic->id) }}" class="group block relative bg-neon-card backdrop-blur-md rounded-[16px] overflow-hidden border border-neon-border hover:border-neon-blue hover:shadow-neon-hover transition-all duration-300 transform hover:-translate-y-2">
                <!-- Cover Area -->
                <div class="relative aspect-[4/5] overflow-hidden rounded-t-[16px]">
                    @if($comic->cover_image)
                        <img src="{{ Storage::url($comic->cover_image) }}" alt="{{ $comic->title }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-in-out">
                    @else
                        <div class="w-full h-full bg-neon-dark flex items-center justify-center text-neon-subtext font-bold uppercase">Tanpa Sampul</div>
                    @endif
                    
                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0B1220] via-transparent to-transparent opacity-90 group-hover:opacity-100 transition-opacity"></div>
                    
                    <!-- Top Badges -->
                    <div class="absolute top-3 left-3 flex items-center gap-2">
                        <span class="px-2.5 py-1 bg-neon-dark/80 backdrop-blur border border-neon-blue/50 text-neon-blue text-[10px] font-bold uppercase tracking-wider rounded-md">{{ $comic->genre ?? 'Komik' }}</span>
                    </div>

                    <!-- Bottom Info over Cover -->
                    <div class="absolute bottom-0 left-0 right-0 p-4 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                        <div class="flex items-center justify-between mb-1">
                            <div class="flex items-center gap-1 text-yellow-400 text-xs">
                                ★ <span class="font-bold text-white">4.8</span>
                            </div>
                            <span class="text-[10px] text-neon-blue font-bold bg-neon-blue/10 px-2 py-0.5 rounded border border-neon-blue/30 shadow-neon-blue">
                                Ch. {{ $comic->episodes_count > 0 ? $comic->episodes_count : '...' }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Text Area -->
                <div class="p-5">
                    <h3 class="text-lg font-bold text-white mb-1 truncate group-hover:text-neon-blue transition-colors duration-300" title="{{ $comic->title }}">{{ $comic->title }}</h3>
                    <p class="text-xs text-neon-subtext uppercase tracking-wider font-medium truncate mb-4">{{ $comic->author }}</p>
                    
                    <div class="w-full h-[1px] bg-gradient-to-r from-neon-border via-neon-border to-transparent mb-4"></div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-[11px] text-neon-subtext">Diperbarui {{ $comic->updated_at->diffForHumans() }}</span>
                        <span class="text-neon-blue opacity-0 group-hover:opacity-100 transform -translate-x-2 group-hover:translate-x-0 transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" /></svg>
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        
        <div class="mt-16 flex justify-center">
            {{ $comics->links() }}
        </div>
    @else
        <!-- Modern Empty State -->
        <div class="bg-neon-card/50 backdrop-blur border border-neon-border rounded-2xl p-16 text-center max-w-2xl mx-auto shadow-glass relative overflow-hidden group">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-neon-blue via-neon-purple to-neon-blue opacity-50"></div>
            
            <div class="w-24 h-24 mx-auto mb-6 bg-neon-dark rounded-full flex items-center justify-center border border-neon-border group-hover:border-neon-blue transition-colors duration-500 shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-neon-subtext group-hover:text-neon-blue transition-colors duration-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
            </div>
            
            <h3 class="text-2xl font-black text-white mb-3">Belum Ada Komik Tersedia</h3>
            <p class="text-neon-subtext mb-8">Platform kami masih sangat baru. Kami sedang menyiapkan perpustakaan komik yang menakjubkan untuk Anda.</p>
            
            @auth
                <a href="{{ route('admin.comics.create') }}" class="inline-flex items-center gap-2 px-8 py-3 rounded-lg bg-neon-blue text-neon-dark font-black uppercase tracking-widest text-sm shadow-neon-blue hover:shadow-[0_0_30px_rgba(0,229,255,0.6)] hover:bg-white transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                    Tambah Komik Perdana
                </a>
            @else
                <button disabled class="inline-block px-8 py-3 rounded-lg border border-neon-border text-neon-subtext font-bold uppercase tracking-widest text-sm cursor-not-allowed">
                    Segera Hadir
                </button>
            @endauth
        </div>
    @endif
</div>

<!-- Add some quick inline styles for custom animations used in this page -->
@push('head')
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
    }
    @keyframes floatDelayed {
        0% { transform: translateY(0px) rotate(-12deg); }
        50% { transform: translateY(-10px) rotate(-10deg); }
        100% { transform: translateY(0px) rotate(-12deg); }
    }
    .animate-fade-in-up { animation: fadeInUp 0.8s ease-out forwards; }
    .animate-float { animation: float 6s ease-in-out infinite; }
    .animate-float-delayed { animation: floatDelayed 8s ease-in-out infinite 1s; }
    .animate-float-slow { animation: float 10s ease-in-out infinite 0.5s; }
</style>
@endpush
@endsection
