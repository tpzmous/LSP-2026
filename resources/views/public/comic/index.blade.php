@extends('layouts.public')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20 min-h-[calc(100vh-200px)]">
    
    <!-- Page Header -->
    <div class="mb-12">
        <h1 class="text-4xl lg:text-5xl font-black text-white uppercase tracking-widest drop-shadow-[0_0_10px_rgba(0,229,255,0.4)]">
            Semua <span class="text-transparent bg-clip-text bg-gradient-to-r from-neon-blue to-cyan-300">Komik</span>
        </h1>
        <p class="text-neon-subtext mt-3 text-lg">Jelajahi seluruh koleksi cerita tanpa batas di N-Comics.</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-10">
        <!-- Sidebar Filters (Left) -->
        <div class="w-full lg:w-72 shrink-0">
            <div class="bg-neon-card/50 backdrop-blur-md border border-neon-border rounded-2xl p-6 shadow-glass lg:sticky lg:top-28">

                <h3 class="text-white font-bold uppercase tracking-widest mb-6 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-neon-blue"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" /></svg>
                    Filter Komik
                </h3>

                {{-- Satu form untuk semua filter --}}
                <form action="{{ route('comic.index') }}" method="GET" id="filter-form">

                    {{-- Search --}}
                    <div class="mb-8 relative">
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                               placeholder="Cari judul..."
                               class="w-full bg-[#080d17]/50 border border-neon-border text-neon-text text-sm rounded-xl pl-4 pr-10 py-3 focus:ring-1 focus:ring-neon-blue focus:border-neon-blue placeholder-neon-subtext/60 shadow-inner transition-all duration-300">
                        <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-neon-subtext hover:text-neon-blue p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                        </button>
                    </div>

                    {{-- Genre - dynamic chips --}}
                    <div class="mb-8">
                        <h4 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-3">Genre</h4>
                        <div class="flex flex-wrap gap-2">
                            {{-- "Semua" chip --}}
                            <a href="{{ route('comic.index', array_merge(request()->except('genre'), [])) }}"
                               onclick="setGenre(''); return false;"
                               class="genre-chip px-3 py-1.5 text-xs font-bold rounded-lg transition-colors cursor-pointer
                                      {{ !request('genre') ? 'bg-neon-blue text-neon-dark shadow-[0_0_10px_rgba(0,229,255,0.3)]' : 'border border-neon-border text-neon-subtext hover:border-neon-blue hover:text-white' }}">
                                Semua
                            </a>
                            @foreach($genres as $genre)
                            <a href="#" onclick="setGenre('{{ $genre }}'); return false;"
                               class="genre-chip px-3 py-1.5 text-xs font-bold rounded-lg transition-colors cursor-pointer
                                      {{ request('genre') === $genre ? 'bg-neon-blue text-neon-dark shadow-[0_0_10px_rgba(0,229,255,0.3)]' : 'border border-neon-border text-neon-subtext hover:border-neon-blue hover:text-white' }}">
                                {{ $genre }}
                            </a>
                            @endforeach
                        </div>
                        {{-- Hidden genre input --}}
                        <input type="hidden" name="genre" id="genre-input" value="{{ request('genre') }}">
                    </div>

                    {{-- Sort --}}
                    <div>
                        <h4 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-3">Urutkan</h4>
                        <select name="sort" onchange="this.form.submit()"
                                class="w-full bg-[#080d17]/50 border border-neon-border text-neon-subtext text-sm rounded-xl px-4 py-3 focus:ring-1 focus:ring-neon-blue focus:border-neon-blue appearance-none cursor-pointer">
                            <option value="latest"   {{ request('sort','latest') === 'latest'   ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest"   {{ request('sort') === 'oldest'   ? 'selected' : '' }}>Terlama</option>
                            <option value="az"       {{ request('sort') === 'az'       ? 'selected' : '' }}>A → Z</option>
                            <option value="episodes" {{ request('sort') === 'episodes' ? 'selected' : '' }}>Jumlah Episode</option>
                        </select>
                    </div>

                    {{-- Reset button --}}
                    @if(request()->hasAny(['search', 'genre', 'sort']))
                    <a href="{{ route('comic.index') }}" class="mt-5 w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-neon-border text-neon-subtext text-sm font-bold hover:border-neon-blue hover:text-neon-blue transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                        Hapus Semua Filter
                    </a>
                    @endif

                </form>

            </div>
        </div>

        <!-- Main Content Area (Right) -->
        <div class="flex-1">
            
            @if(request('search'))
                <div class="mb-6 flex items-center justify-between">
                    <p class="text-neon-subtext">Menampilkan hasil pencarian untuk: <span class="text-white font-bold">"{{ request('search') }}"</span></p>
                    <a href="{{ route('comic.index') }}" class="text-sm text-neon-blue hover:text-white transition-colors underline underline-offset-4">Bersihkan filter</a>
                </div>
            @endif

            @if($comics->count() > 0)
                <!-- Grid consistent with Home Page -->
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 lg:gap-8">
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
                            
                            <div class="absolute top-3 left-3 flex items-center gap-2">
                                <span class="px-2.5 py-1 bg-neon-dark/80 backdrop-blur border border-neon-blue/50 text-neon-blue text-[10px] font-bold uppercase tracking-wider rounded-md">{{ $comic->genre ?? 'Komik' }}</span>
                            </div>

                            <div class="absolute bottom-0 left-0 right-0 p-4 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                                <div class="flex items-center justify-between mb-1">
                                    <div class="flex items-center gap-1 text-yellow-400 text-xs">
                                        ★ <span class="font-bold text-white">4.9</span>
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
                
                <!-- Modern Pagination -->
                <div class="mt-12">
                    {{ $comics->appends(request()->query())->links() }}
                </div>
            @else
                <!-- Modern Empty State -->
                <div class="bg-neon-card/50 backdrop-blur border border-neon-border rounded-2xl p-16 text-center shadow-glass relative overflow-hidden group">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-neon-blue via-neon-purple to-neon-blue opacity-50"></div>
                    
                    <div class="w-24 h-24 mx-auto mb-6 bg-neon-dark rounded-full flex items-center justify-center border border-neon-border group-hover:border-neon-blue transition-colors duration-500 shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-neon-subtext group-hover:text-neon-blue transition-colors duration-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                    
                    <h3 class="text-2xl font-black text-white mb-3">Komik Tidak Ditemukan</h3>
                    @if(request('search'))
                        <p class="text-neon-subtext mb-8">Maaf, kami tidak menemukan komik untuk pencarian "<span class="text-white">{{ request('search') }}</span>". Coba gunakan kata kunci lain atau periksa ejaan Anda.</p>
                        
                        <a href="{{ route('comic.index') }}" class="inline-flex items-center gap-2 px-8 py-3 rounded-lg border border-neon-blue text-neon-blue font-bold uppercase tracking-widest text-sm hover:bg-neon-blue hover:text-neon-dark transition-all duration-300">
                            Bersihkan Pencarian
                        </a>
                    @else
                        <p class="text-neon-subtext mb-8">Saat ini belum ada komik yang tersedia di platform.</p>
                        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-8 py-3 rounded-lg bg-neon-blue text-neon-dark font-black uppercase tracking-widest text-sm shadow-neon-blue hover:shadow-[0_0_30px_rgba(0,229,255,0.6)] hover:bg-white transition-all duration-300">
                            Kembali ke Beranda
                        </a>
                    @endif
                </div>
            @endif

        </div>
    </div>
</div>

@push('scripts')
<script>
function setGenre(value) {
    document.getElementById('genre-input').value = value;
    document.getElementById('filter-form').submit();
}
</script>
@endpush

@endsection
