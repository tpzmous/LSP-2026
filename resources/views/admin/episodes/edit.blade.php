@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-black text-white uppercase tracking-wider">Edit Episode</h2>
        <a href="{{ route('admin.comics.episodes.index', $episode->comic_id) }}" class="text-gray-400 hover:text-white transition-colors">&larr; Back to Episodes</a>
    </div>

    <div class="bg-neon-card border border-neon-border rounded-xl shadow-lg p-6">
        @if($errors->any())
            <div class="mb-6 p-4 border border-red-500 bg-red-500/10 text-red-500 rounded-lg shadow-[0_0_10px_rgba(239,68,68,0.3)]">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.episodes.update', $episode) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="title" class="block text-sm font-bold text-gray-300 uppercase tracking-wide mb-2">Episode Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $episode->title) }}" required class="w-full bg-neon-dark border border-neon-border text-white rounded-lg focus:ring-neon-blue focus:border-neon-blue shadow-inner p-3">
            </div>

            <div>
                <label for="pdf_file" class="block text-sm font-bold text-gray-300 uppercase tracking-wide mb-2">PDF File (Leave empty to keep current)</label>
                @if($episode->pdf_file)
                    <div class="mb-3 text-sm text-neon-blue">
                        Current: <a href="{{ Storage::url($episode->pdf_file) }}" target="_blank" class="hover:underline">View PDF</a>
                    </div>
                @endif
                <input type="file" name="pdf_file" id="pdf_file" accept="application/pdf" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-bold file:bg-neon-dark file:text-neon-blue hover:file:bg-neon-blue hover:file:text-neon-dark file:cursor-pointer pb-3 cursor-pointer file:transition-colors file:border-r file:border-neon-border">
                <p class="mt-2 text-xs text-gray-500">Max size: 50MB. Only PDF files are allowed.</p>
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit" class="px-6 py-3 bg-neon-blue text-neon-dark font-black uppercase tracking-widest rounded shadow-[0_0_15px_rgba(0,243,255,0.4)] hover:shadow-[0_0_25px_rgba(0,243,255,0.6)] hover:bg-white transition-all text-sm">
                    Update Episode
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
