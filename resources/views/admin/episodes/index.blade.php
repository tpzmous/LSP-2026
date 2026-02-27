@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <a href="{{ route('admin.comics.index') }}" class="text-gray-400 hover:text-white transition-colors text-sm">&larr; Back to Comics</a>
            <h2 class="text-3xl font-black text-white uppercase tracking-wider mt-2">Episodes: {{ $comic->title }}</h2>
        </div>
        <a href="{{ route('admin.comics.episodes.create', $comic) }}" class="px-4 py-2 bg-neon-blue text-neon-dark font-bold rounded shadow-[0_0_15px_rgba(0,243,255,0.4)] hover:shadow-[0_0_25px_rgba(0,243,255,0.6)] hover:bg-white transition-all">
            + Add New Episode
        </a>
    </div>

    <div class="bg-neon-card border border-neon-border rounded-xl shadow-lg overflow-hidden">
        @if($episodes->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse whitespace-nowrap">
                    <thead>
                        <tr class="bg-neon-dark text-gray-400 uppercase text-xs tracking-wider">
                            <th class="p-4 border-b border-neon-border">Episode #</th>
                            <th class="p-4 border-b border-neon-border">Title</th>
                            <th class="p-4 border-b border-neon-border">PDF File</th>
                            <th class="p-4 border-b border-neon-border">Date Added</th>
                            <th class="p-4 border-b border-neon-border text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neon-border">
                        @foreach($episodes as $episode)
                        <tr class="hover:bg-neon-gray/30 transition-colors">
                            <td class="p-4">
                                <span class="px-3 py-1 bg-neon-dark text-neon-blue font-black border border-neon-border rounded"># {{ $episode->episode_number }}</span>
                            </td>
                            <td class="p-4 font-bold text-white">{{ $episode->title ?? 'Episode '.$episode->episode_number }}</td>
                            <td class="p-4 text-neon-blue">
                                <a href="{{ Storage::url($episode->pdf_file) }}" target="_blank" class="hover:underline flex items-center gap-1">
                                    <span>📄</span> View PDF
                                </a>
                            </td>
                            <td class="p-4 text-gray-400">{{ $episode->created_at->format('M d, Y') }}</td>
                            <td class="p-4 text-right space-x-2">
                                <a href="{{ route('admin.episodes.edit', $episode) }}" class="inline-block px-3 py-1 bg-neon-blue/20 text-neon-blue border border-neon-blue/50 hover:bg-neon-blue/30 rounded text-sm transition-colors">Edit</a>
                                <form action="{{ route('admin.episodes.destroy', $episode) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this episode?');">
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
                {{ $episodes->links() }}
            </div>
        @else
            <div class="p-12 text-center">
                <div class="text-4xl mb-4">📄</div>
                <h3 class="text-xl font-bold text-white mb-2">No Episodes Found</h3>
                <p class="text-gray-500 mb-6">This comic doesn't have any episodes yet.</p>
                <a href="{{ route('admin.comics.episodes.create', $comic) }}" class="inline-block px-6 py-2 border border-neon-blue text-neon-blue hover:bg-neon-blue hover:text-neon-dark hover:shadow-neon-blue transition-all duration-300 rounded font-bold uppercase tracking-widest text-sm">Upload First Episode</a>
            </div>
        @endif
    </div>
</div>
@endsection
