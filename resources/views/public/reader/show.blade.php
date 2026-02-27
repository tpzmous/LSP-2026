<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Membaca {{ $comic->title }} - Ep {{ $episode->episode_number }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,700,900&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- PDF.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
    </script>
    <style>
        body { background-color: #0a0a0a; color: #fff; margin: 0; padding: 0; overflow-x: hidden; }
        .pdf-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }
        .pdf-page {
            width: 100%;
            margin-bottom: 0px; /* Seamless continuous scroll */
            display: block;
        }
        canvas {
            width: 100% !important;
            height: auto !important;
            display: block;
        }
    </style>
</head>
<body class="font-sans antialiased selection:bg-neon-blue selection:text-neon-dark">
    <!-- Top Nav overlay -->
    <div id="reader-nav" class="fixed top-0 left-0 right-0 bg-neon-dark/90 backdrop-blur border-b border-neon-border p-4 flex justify-between items-center z-50 transition-transform duration-300 transform translate-y-0 shadow-[0_4px_20px_rgba(0,0,0,0.5)]">
        <a href="{{ route('comic.show', $comic->id) }}" class="text-gray-400 hover:text-white flex items-center gap-2">
            <span>&larr;</span> <span class="hidden md:inline">Kembali ke Komik</span>
        </a>
        <div class="text-center flex-1 mx-4 truncate">
            <h1 class="text-white font-bold truncate">{{ $comic->title }}</h1>
            <p class="text-neon-blue text-xs uppercase tracking-widest font-bold">{{ $episode->title ?? 'Episode ' . $episode->episode_number }}</p>
        </div>
        <div class="flex gap-2">
            @if($prevEpisode)
                <a href="{{ route('reader.show', ['comic' => $comic->id, 'episode' => $prevEpisode->id]) }}" class="px-3 py-1 bg-neon-gray border border-neon-border hover:border-neon-blue rounded text-sm transition-colors text-white hidden sm:block">&larr; Seb</a>
            @else
                <button disabled class="px-3 py-1 bg-neon-dark border border-neon-border rounded text-sm text-gray-600 cursor-not-allowed hidden sm:block">&larr; Seb</button>
            @endif
            
            @if($nextEpisode)
                <a href="{{ route('reader.show', ['comic' => $comic->id, 'episode' => $nextEpisode->id]) }}" class="px-3 py-1 bg-neon-blue text-neon-dark border border-neon-blue font-bold rounded text-sm hover:bg-white hover:shadow-[0_0_10px_rgba(0,243,255,0.5)] transition-all hidden sm:block">Lanjut &rarr;</a>
            @else
                <button disabled class="px-3 py-1 bg-neon-dark border border-neon-border rounded text-sm text-gray-600 cursor-not-allowed hidden sm:block">Lanjut &rarr;</button>
            @endif
        </div>
    </div>

    <!-- Loading Indicator -->
    <div id="loading" class="fixed inset-0 flex flex-col items-center justify-center bg-neon-dark z-40">
        <div class="w-16 h-16 border-4 border-neon-gray border-t-neon-blue rounded-full animate-spin mb-4 shadow-[0_0_15px_rgba(0,243,255,0.5)]"></div>
        <p class="text-neon-blue uppercase tracking-widest font-bold text-sm animate-pulse">Memuat Episode...</p>
    </div>

    <!-- PDF Viewer -->
    <div class="pt-0 min-h-screen">
        <div id="pdf-viewer" class="pdf-container"></div>
    </div>

    <!-- Bottom Nav -->
    <div class="fixed bottom-0 left-0 right-0 bg-neon-dark/95 backdrop-blur border-t border-neon-border p-4 flex justify-between items-center z-50 shadow-[0_-4px_20px_rgba(0,0,0,0.5)]">
        @if($prevEpisode)
            <a href="{{ route('reader.show', ['comic' => $comic->id, 'episode' => $prevEpisode->id]) }}" class="px-4 py-2 sm:px-6 bg-neon-gray border border-neon-border hover:border-neon-blue rounded text-xs sm:text-sm font-bold uppercase tracking-wider transition-colors text-white">&larr; Seb</a>
        @else
            <div></div>
        @endif
        
        @if($nextEpisode)
            <a href="{{ route('reader.show', ['comic' => $comic->id, 'episode' => $nextEpisode->id]) }}" class="px-4 py-2 sm:px-6 bg-neon-blue text-neon-dark border border-neon-blue font-black uppercase tracking-wider rounded text-xs sm:text-sm hover:bg-white hover:shadow-[0_0_15px_rgba(0,243,255,0.5)] transition-all">Lanjut &rarr;</a>
        @else
            <a href="{{ route('comic.show', $comic->id) }}" class="px-4 py-2 sm:px-6 bg-neon-dark border border-neon-border text-gray-400 hover:text-white rounded text-xs sm:text-sm font-bold uppercase tracking-wider transition-colors">Selesai</a>
        @endif
    </div>

    <!-- Script to render PDF -->
    <script>
        const url = '{{ Storage::url($episode->pdf_file) }}';
        const viewer = document.getElementById('pdf-viewer');
        const loading = document.getElementById('loading');

        let pdfDoc = null;
        const scale = 1.5;

        let lastScrollTop = 0;
        const nav = document.getElementById('reader-nav');
        window.addEventListener('scroll', function() {
            let st = window.pageYOffset || document.documentElement.scrollTop;
            if (st > lastScrollTop && st > 100) {
                // downscroll
                nav.style.transform = 'translateY(-100%)';
            } else {
                // upscroll
                nav.style.transform = 'translateY(0)';
            }
            lastScrollTop = st <= 0 ? 0 : st;
        }, false);

        async function renderPage(num) {
            const page = await pdfDoc.getPage(num);
            const viewport = page.getViewport({ scale: scale });
            
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            
            canvas.height = viewport.height;
            canvas.width = viewport.width;
            
            const renderContext = {
                canvasContext: ctx,
                viewport: viewport
            };

            const pageDiv = document.createElement('div');
            pageDiv.className = 'pdf-page';
            pageDiv.appendChild(canvas);
            viewer.appendChild(pageDiv);

            await page.render(renderContext).promise;
        }

        async function loadPdf() {
            try {
                const loadingTask = pdfjsLib.getDocument(url);
                pdfDoc = await loadingTask.promise;
                const numPages = pdfDoc.numPages;

                for (let i = 1; i <= numPages; i++) {
                    await renderPage(i);
                    // Hide loading indicator after first page is ready
                    if (i === 1) {
                        loading.style.opacity = '0';
                        setTimeout(() => loading.style.display = 'none', 300);
                    }
                }
            } catch (error) {
                console.error("Error loading PDF: ", error);
                loading.innerHTML = '<p class="text-red-500 font-bold uppercase">Error loading PDF. Please try again later.</p>';
            }
        }

        loadPdf();
    </script>
</body>
</html>
