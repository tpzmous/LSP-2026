@extends('layouts.public')

@section('content')
<!-- Hero Section -->
<div class="relative bg-neon-dark border-b border-neon-border overflow-hidden">
    <!-- Blurred Background -->
    @if($comic->cover_image)
        <div class="absolute inset-0 opacity-20 blur-xl scale-110">
            <img src="{{ Storage::url($comic->cover_image) }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-neon-dark/80 mix-blend-multiply"></div>
        </div>
    @endif

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20 lg:flex gap-12 items-end">
        <!-- Cover -->
        <div class="w-48 md:w-64 shrink-0 mx-auto lg:mx-0 rounded-xl overflow-hidden shadow-[0_0_30px_rgba(0,243,255,0.2)] border border-neon-blue border-opacity-30 self-start z-10">
            @if($comic->cover_image)
                <img src="{{ Storage::url($comic->cover_image) }}" alt="{{ $comic->title }}" class="w-full aspect-[2/3] object-cover">
            @else
                <div class="w-full aspect-[2/3] bg-neon-gray flex items-center justify-center text-gray-500 uppercase font-bold text-sm">Tanpa Sampul</div>
            @endif
        </div>

        <!-- Info -->
        <div class="mt-8 lg:mt-0 text-center lg:text-left z-10 space-y-4 flex-1">
            <h1 class="text-4xl md:text-5xl font-black text-white uppercase tracking-wider text-shadow-[0_0_10px_rgba(0,243,255,0.5)]">{{ $comic->title }}</h1>
            <p class="text-neon-blue font-bold uppercase tracking-widest text-sm drop-shadow-[0_0_5px_rgba(0,243,255,0.5)]">Cerita &amp; Seni oleh {{ $comic->author }}</p>
            
            <!-- Genre & Status Badges -->
            <div class="flex flex-wrap items-center justify-center lg:justify-start gap-2 pt-1">
                @if($comic->genre)
                    <span class="px-3 py-1 bg-neon-blue/10 border border-neon-blue/50 text-neon-blue text-xs font-bold uppercase rounded-md shadow-neon-blue">
                        {{ $comic->genre }}
                    </span>
                @endif
                @php
                    $statusMap = [
                        'ongoing'   => ['label' => 'Ongoing', 'color' => 'text-green-400 border-green-400/50 bg-green-400/10'],
                        'completed' => ['label' => 'Tamat', 'color' => 'text-cyan-300 border-cyan-300/50 bg-cyan-300/10'],
                        'hiatus'    => ['label' => 'Hiatus', 'color' => 'text-yellow-400 border-yellow-400/50 bg-yellow-400/10'],
                        'published' => ['label' => 'Aktif', 'color' => 'text-green-400 border-green-400/50 bg-green-400/10'],
                        'draft'     => ['label' => 'Draft', 'color' => 'text-gray-400 border-gray-500/50 bg-gray-500/10'],
                    ];
                    $s = $statusMap[$comic->status] ?? ['label' => ucfirst($comic->status), 'color' => 'text-gray-400 border-gray-500/50 bg-gray-500/10'];
                @endphp
                <span class="px-3 py-1 border text-xs font-bold uppercase rounded-md {{ $s['color'] }}">
                    {{ $s['label'] }}
                </span>
            </div>

            <p class="text-gray-300 max-w-2xl mx-auto lg:mx-0 leading-relaxed text-sm md:text-base">
                {{ $comic->description }}
            </p>
            <div class="pt-4 space-x-4">
                @if($comic->episodes->count() > 0)
                    <a href="{{ route('reader.show', ['comic' => $comic->id, 'episode' => $comic->episodes->first()->id]) }}" class="inline-block px-8 py-3 bg-neon-blue text-neon-dark font-black uppercase tracking-widest rounded shadow-[0_0_15px_rgba(0,243,255,0.4)] hover:shadow-[0_0_25px_rgba(0,243,255,0.6)] hover:bg-white transition-all text-sm">
                        Baca Ep. 1
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Episodes List -->
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-2xl font-black text-white uppercase tracking-wider">Episode <span class="text-gray-500 text-lg">({{ $comic->episodes->count() }})</span></h2>
    </div>

    <div class="bg-neon-card border border-neon-border rounded-xl shadow-lg overflow-hidden divide-y divide-neon-border">
        @forelse($comic->episodes as $episode)
            <a href="{{ route('reader.show', ['comic' => $comic->id, 'episode' => $episode->id]) }}" class="group flex items-center p-4 hover:bg-neon-gray/30 transition-colors">
                <div class="w-16 h-16 shrink-0 bg-neon-dark border border-neon-border rounded flex flex-col items-center justify-center mr-6 group-hover:border-neon-blue transition-colors">
                    <span class="text-xs text-gray-500 uppercase font-bold tracking-widest leading-none mb-1">Ep</span>
                    <span class="text-xl font-black text-white group-hover:text-neon-blue group-hover:drop-shadow-[0_0_5px_rgba(0,243,255,0.8)] leading-none transition-all">{{ $episode->episode_number }}</span>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-gray-200 group-hover:text-white transition-colors">{{ $episode->title ?? 'Episode ' . $episode->episode_number }}</h3>
                    <p class="text-sm text-gray-500">{{ $episode->created_at->format('M d, Y') }}</p>
                </div>
                <div class="text-neon-blue opacity-0 group-hover:opacity-100 transition-opacity transform translate-x-[-10px] group-hover:translate-x-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </a>
        @empty
            <div class="p-8 text-center text-gray-500">
                Belum ada episode yang tersedia.
            </div>
        @endforelse
    </div>
</div>
@endsection
