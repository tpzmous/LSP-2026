@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-black text-white uppercase tracking-wider">Dashboard Overview</h2>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-neon-card border border-neon-border p-6 rounded-xl shadow-lg hover:border-neon-blue hover:shadow-neon-hover transition-all duration-300">
            <h3 class="text-gray-400 font-semibold mb-2 uppercase tracking-wide">Total Comics</h3>
            <p class="text-4xl font-black justify-between text-white flex items-center">
                {{ $comicCount }}
                <span class="text-neon-blue text-2xl">📚</span>
            </p>
        </div>
        <div class="bg-neon-card border border-neon-border p-6 rounded-xl shadow-lg hover:border-neon-blue hover:shadow-neon-hover transition-all duration-300">
            <h3 class="text-gray-400 font-semibold mb-2 uppercase tracking-wide">Total Episodes</h3>
            <p class="text-4xl font-black text-white flex justify-between items-center">
                {{ $episodeCount }}
                <span class="text-neon-blue text-2xl">📄</span>
            </p>
        </div>
    </div>

    <!-- Recent Comics -->
    <div class="bg-neon-card border border-neon-border rounded-xl shadow-lg overflow-hidden">
        <div class="p-4 border-b border-neon-border bg-neon-gray/50">
            <h3 class="text-lg font-bold text-white uppercase tracking-wider">Recently Added Comics</h3>
        </div>
        <div class="p-0">
            @if($recentComics->count() > 0)
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-neon-dark text-gray-400 uppercase text-xs tracking-wider">
                            <th class="p-4 border-b border-neon-border">Cover</th>
                            <th class="p-4 border-b border-neon-border">Title</th>
                            <th class="p-4 border-b border-neon-border">Status</th>
                            <th class="p-4 border-b border-neon-border">Date Added</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neon-border">
                        @foreach($recentComics as $comic)
                        <tr class="hover:bg-neon-gray/30 transition-colors">
                            <td class="p-4">
                                @if($comic->cover_image)
                                    <img src="{{ Storage::url($comic->cover_image) }}" alt="Cover" class="w-12 h-16 object-cover rounded shadow-md">
                                @else
                                    <div class="w-12 h-16 bg-gray-800 rounded flex items-center justify-center text-xs text-gray-500">No Image</div>
                                @endif
                            </td>
                            <td class="p-4 font-bold text-white">{{ $comic->title }}</td>
                            <td class="p-4">
                                <span class="px-2 py-1 text-xs rounded-full {{ $comic->status === 'published' ? 'bg-green-500/20 text-green-400 border border-green-500/30' : 'bg-yellow-500/20 text-yellow-500 border border-yellow-500/30' }}">
                                    {{ ucfirst($comic->status) }}
                                </span>
                            </td>
                            <td class="p-4 text-gray-400 text-sm">{{ $comic->created_at->format('M d, Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="p-8 text-center text-gray-500">
                    No comics found. Start by creating one!
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
