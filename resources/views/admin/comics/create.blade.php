@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-black text-white uppercase tracking-wider">Add New Comic</h2>
        <a href="{{ route('admin.comics.index') }}" class="text-gray-400 hover:text-white transition-colors">&larr; Back to Comics</a>
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

        <form action="{{ route('admin.comics.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div>
                <label for="title" class="block text-sm font-bold text-gray-300 uppercase tracking-wide mb-2">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required class="w-full bg-neon-dark border border-neon-border text-white rounded-lg focus:ring-neon-blue focus:border-neon-blue shadow-inner p-3">
            </div>

            <div>
                <label for="author" class="block text-sm font-bold text-gray-300 uppercase tracking-wide mb-2">Author</label>
                <input type="text" name="author" id="author" value="{{ old('author') }}" required class="w-full bg-neon-dark border border-neon-border text-white rounded-lg focus:ring-neon-blue focus:border-neon-blue shadow-inner p-3">
            </div>

            <div>
                <label for="description" class="block text-sm font-bold text-gray-300 uppercase tracking-wide mb-2">Description</label>
                <textarea name="description" id="description" rows="4" required class="w-full bg-neon-dark border border-neon-border text-white rounded-lg focus:ring-neon-blue focus:border-neon-blue shadow-inner p-3">{{ old('description') }}</textarea>
            </div>

            <div>
                <label for="cover_image" class="block text-sm font-bold text-gray-300 uppercase tracking-wide mb-2">Cover Image</label>
                <input type="file" name="cover_image" id="cover_image" required accept="image/*" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-bold file:bg-neon-dark file:text-neon-blue hover:file:bg-neon-blue hover:file:text-neon-dark file:cursor-pointer pb-3 cursor-pointer file:transition-colors file:border-r file:border-neon-border">
            </div>

            <div>
                <label for="genre" class="block text-sm font-bold text-gray-300 uppercase tracking-wide mb-2">Genre</label>
                <select name="genre" id="genre" required class="w-full bg-neon-dark border border-neon-border text-white rounded-lg focus:ring-neon-blue focus:border-neon-blue shadow-inner p-3">
                    <option value="">-- Pilih Genre --</option>
                    <option value="Action" {{ old('genre') == 'Action' ? 'selected' : '' }}>Action</option>
                    <option value="Adventure" {{ old('genre') == 'Adventure' ? 'selected' : '' }}>Adventure</option>
                    <option value="Comedy" {{ old('genre') == 'Comedy' ? 'selected' : '' }}>Comedy</option>
                    <option value="Drama" {{ old('genre') == 'Drama' ? 'selected' : '' }}>Drama</option>
                    <option value="Fantasy" {{ old('genre') == 'Fantasy' ? 'selected' : '' }}>Fantasy</option>
                    <option value="Horror" {{ old('genre') == 'Horror' ? 'selected' : '' }}>Horror</option>
                    <option value="Isekai" {{ old('genre') == 'Isekai' ? 'selected' : '' }}>Isekai</option>
                    <option value="Mecha" {{ old('genre') == 'Mecha' ? 'selected' : '' }}>Mecha</option>
                    <option value="Military" {{ old('genre') == 'Military' ? 'selected' : '' }}>Military</option>
                    <option value="Mystery" {{ old('genre') == 'Mystery' ? 'selected' : '' }}>Mystery</option>
                    <option value="Psychological" {{ old('genre') == 'Psychological' ? 'selected' : '' }}>Psychological</option>
                    <option value="Romance" {{ old('genre') == 'Romance' ? 'selected' : '' }}>Romance</option>
                    <option value="Sci-Fi" {{ old('genre') == 'Sci-Fi' ? 'selected' : '' }}>Sci-Fi</option>
                    <option value="Shounen" {{ old('genre') == 'Shounen' ? 'selected' : '' }}>Shounen</option>
                    <option value="Shoujo" {{ old('genre') == 'Shoujo' ? 'selected' : '' }}>Shoujo</option>
                    <option value="Seinen" {{ old('genre') == 'Seinen' ? 'selected' : '' }}>Seinen</option>
                    <option value="Slice of Life" {{ old('genre') == 'Slice of Life' ? 'selected' : '' }}>Slice of Life</option>
                    <option value="Sports" {{ old('genre') == 'Sports' ? 'selected' : '' }}>Sports</option>
                    <option value="Supernatural" {{ old('genre') == 'Supernatural' ? 'selected' : '' }}>Supernatural</option>
                    <option value="Thriller" {{ old('genre') == 'Thriller' ? 'selected' : '' }}>Thriller</option>
                    <option value="Webtoon" {{ old('genre') == 'Webtoon' ? 'selected' : '' }}>Webtoon</option>
                </select>
            </div>

            <div>
                <label for="status" class="block text-sm font-bold text-gray-300 uppercase tracking-wide mb-2">Status Publikasi</label>
                <select name="status" id="status" required class="w-full bg-neon-dark border border-neon-border text-white rounded-lg focus:ring-neon-blue focus:border-neon-blue shadow-inner p-3">
                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft (Tidak Tampil)</option>
                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published (Aktif)</option>
                    <option value="ongoing" {{ old('status') === 'ongoing' ? 'selected' : '' }}>Ongoing (Masih Berlanjut)</option>
                    <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Tamat (Selesai)</option>
                    <option value="hiatus" {{ old('status') === 'hiatus' ? 'selected' : '' }}>Hiatus (Jeda)</option>
                </select>
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit" class="px-6 py-3 bg-neon-blue text-neon-dark font-black uppercase tracking-widest rounded shadow-[0_0_15px_rgba(0,243,255,0.4)] hover:shadow-[0_0_25px_rgba(0,243,255,0.6)] hover:bg-white transition-all text-sm">
                    Save Comic
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
