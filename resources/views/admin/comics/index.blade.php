@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-black text-white uppercase tracking-wider">Manage Comics</h2>
        <a href="{{ route('admin.comics.create') }}" class="px-4 py-2 bg-neon-blue text-neon-dark font-bold rounded shadow-[0_0_15px_rgba(0,243,255,0.4)] hover:shadow-[0_0_25px_rgba(0,243,255,0.6)] hover:bg-white transition-all">
            + Add New Comic
        </a>
    </div>

    <div class="bg-neon-card border border-neon-border rounded-xl shadow-lg overflow-hidden">
        @if($comics->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse whitespace-nowrap">
                    <thead>
                        <tr class="bg-neon-dark text-gray-400 uppercase text-xs tracking-wider">
                            <th class="p-4 border-b border-neon-border">Cover</th>
                            <th class="p-4 border-b border-neon-border">Title</th>
                            <th class="p-4 border-b border-neon-border">Episodes</th>
                            <th class="p-4 border-b border-neon-border">Status</th>
                            <th class="p-4 border-b border-neon-border text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neon-border">
                        @foreach($comics as $comic)
                        <tr class="hover:bg-neon-gray/30 transition-colors">
                            <td class="p-4">
                                @if($comic->cover_image)
                                    <img src="{{ Storage::url($comic->cover_image) }}" alt="Cover" class="w-12 h-16 object-cover rounded shadow-md border border-neon-border/50">
                                @else
                                    <div class="w-12 h-16 bg-gray-800 rounded flex items-center justify-center text-xs text-gray-500 border border-neon-border">N/A</div>
                                @endif
                            </td>
                            <td class="p-4">
                                <span class="font-bold text-white block">{{ $comic->title }}</span>
                                <span class="text-xs text-gray-500 flex items-center gap-1">By {{ $comic->author }}</span>
                            </td>
                            <td class="p-4 text-neon-blue font-bold">
                                {{ $comic->episodes_count }} Ep.
                            </td>
                            <td class="p-4">
                                <span class="px-2 py-1 text-xs rounded-full {{ $comic->status === 'published' ? 'bg-green-500/20 text-green-400 border border-green-500/30' : 'bg-yellow-500/20 text-yellow-500 border border-yellow-500/30' }}">
                                    {{ ucfirst($comic->status) }}
                                </span>
                            </td>
                            <td class="p-4 text-right space-x-2">
                                <a href="{{ route('admin.comics.episodes.index', $comic) }}" class="inline-block px-3 py-1 bg-purple-500/20 text-purple-400 border border-purple-500/50 hover:bg-purple-500/30 rounded text-sm transition-colors">Episodes</a>
                                <a href="{{ route('admin.comics.edit', $comic) }}" class="inline-block px-3 py-1 bg-neon-blue/20 text-neon-blue border border-neon-blue/50 hover:bg-neon-blue/30 rounded text-sm transition-colors">Edit</a>
                                <form action="{{ route('admin.comics.destroy', $comic) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this comic and ALL its episodes?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500/20 text-red-500 border border-red-500/50 hover:bg-red-500/30 rounded text-sm transition-colors">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-neon-border bg-neon-gray/30">
                {{ $comics->links() }}
            </div>
        @else
            <div class="p-12 text-center">
                <div class="text-4xl mb-4">📖</div>
                <h3 class="text-xl font-bold text-white mb-2">No Comics Found</h3>
                <p class="text-gray-500 mb-6">Looks like you haven't added any comics yet.</p>
                <a href="{{ route('admin.comics.create') }}" class="inline-block px-6 py-2 border border-neon-blue text-neon-blue hover:bg-neon-blue hover:text-neon-dark hover:shadow-neon-blue transition-all duration-300 rounded font-bold uppercase tracking-widest text-sm">Create First Comic</a>
            </div>
        @endif
    </div>
</div>
@endsection
