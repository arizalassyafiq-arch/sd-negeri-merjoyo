<x-main-layout>
    <div class="pt-24 pb-16 px-4 mt-10 md:px-8 max-w-7xl mx-auto min-h-screen">

        {{-- 1. HERO SECTION & SEARCH --}}
        <section class="mb-16">
            <div
                class="relative rounded-3xl p-8 md:p-16 text-white overflow-hidden shadow-2xl h-125 flex flex-col justify-center">

                {{-- 1. BACKGROUND IMAGE (Unsplash) --}}
                {{-- Ganti keyword di URL (misal: school, education, library) sesuai keinginan --}}
                <img src="img/bg.webp" alt="School Background" class="absolute inset-0 w-full h-full object-cover">

                {{-- 2. DARK OVERLAY (Supaya teks terbaca) --}}
                {{-- Menggunakan gradient hitam ke transparan agar lebih dramatis --}}
                <div class="absolute inset-0 bg-linear-to-r from-green-900/90 to-black/50 z-0"></div>

                {{-- 3. Decorative Elements (Blobs - Opsional, dibuat lebih subtle) --}}
                <div
                    class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-green-400 opacity-20 rounded-full blur-3xl animate-pulse z-0">
                </div>
                {{-- <div
                    class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-yellow-400 opacity-10 rounded-full blur-3xl animate-pulse z-0">
                </div> --}}

                {{-- 4. KONTEN UTAMA (Z-Index harus tinggi) --}}
                <div class="relative z-10 max-w-3xl mx-auto text-center space-y-6">
                    <span
                        class="inline-block py-1 px-3 rounded-full bg-white/20 text-xs font-semibold tracking-wider uppercase backdrop-blur-sm border border-white/30">
                        Portal Informasi Sekolah
                    </span>

                    <h1
                        class="text-4xl md:text-6xl font-extrabold tracking-tight leading-tight font-sans drop-shadow-md">
                        Kabar & Artikel <br /> <span class="text-green-300">Terbaru</span>
                    </h1>

                    {{-- Deskripsi --}}
                    <p class="font-article text-lg text-gray-100 max-w-2xl mx-auto leading-relaxed drop-shadow-sm">
                        Dapatkan informasi terkini mengenai kegiatan siswa, prestasi, dan pengumuman penting sekolah
                        kami secara update.
                    </p>

                    {{-- Search Form --}}
                    <form action="{{ route('admin.artikel.index') }}" method="GET"
                        class="mt-8 relative max-w-xl mx-auto">
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span
                                    class="material-icons text-gray-400 group-focus-within:text-green-600 transition-colors">search</span>
                            </div>
                            <input type="text" name="q" value="{{ request('q') }}"
                                class="block w-full pl-12 pr-32 py-4 rounded-full border-0 text-gray-900 shadow-xl ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-500 sm:text-sm sm:leading-6 transition-shadow font-article bg-white/95 backdrop-blur-sm"
                                placeholder="Cari artikel...">
                            <button type="submit"
                                class="absolute right-2 top-2 bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-full text-sm font-bold transition-all shadow-md hover:shadow-lg font-sans">
                                Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        {{-- 2. KATEGORI PILLS (Opsional, jika ada fitur kategori) --}}
        {{-- 
        <section class="flex overflow-x-auto pb-4 gap-3 mb-10 scrollbar-hide justify-start md:justify-center">
             <a href="#" class="whitespace-nowrap px-5 py-2 rounded-full bg-green-600 text-white font-medium shadow-md">Semua</a>
             <a href="#" class="whitespace-nowrap px-5 py-2 rounded-full bg-white text-gray-600 border border-gray-200 hover:border-green-500 hover:text-green-600 transition font-medium">Prestasi</a>
             <a href="#" class="whitespace-nowrap px-5 py-2 rounded-full bg-white text-gray-600 border border-gray-200 hover:border-green-500 hover:text-green-600 transition font-medium">Kegiatan</a>
        </section> 
        --}}

        @if ($articles->count() > 0)

            {{-- 3. FEATURED ARTICLE (Item Pertama) --}}
            @php $featured = $articles->first(); @endphp
            <section class="mb-16">
                <div class="flex items-center gap-2 mb-6">
                    <span class="w-1 h-8 bg-green-600 rounded-full"></span>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white font-sans">Unggulan Minggu Ini</h2>
                </div>

                <div
                    class="group relative bg-white dark:bg-gray-800 rounded-3xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-2xl transition-all duration-300">
                    <div class="grid md:grid-cols-12 gap-0 min-h-100">
                        {{-- Image Side --}}
                        <div class="md:col-span-7 relative h-64 md:h-full overflow-hidden bg-gray-100">
                            <a href="{{ route('admin.artikel.show', $featured->slug) }}">
                                @if ($featured->image_path)
                                    <img src="{{ asset('storage/' . $featured->image_path) }}"
                                        alt="{{ $featured->title }}"
                                        class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                                @else
                                    <div class="absolute inset-0 flex items-center justify-center bg-green-50">
                                        <span
                                            class="text-8xl font-bold text-green-200 select-none uppercase">{{ substr($featured->title, 0, 1) }}</span>
                                    </div>
                                @endif
                                {{-- Gradient Overlay --}}
                                <div
                                    class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent md:bg-linear-to-r md:from-transparent md:to-black/5">
                                </div>
                            </a>
                        </div>

                        {{-- Content Side --}}
                        <div class="md:col-span-5 p-8 md:p-10 flex flex-col justify-center">
                            <div class="flex items-center gap-2 text-sm text-green-600 font-semibold mb-4 font-sans">
                                <span class="material-icons text-base">verified</span>
                                <span>Terbaru</span>
                                <span class="text-gray-300">•</span>
                                <span class="text-gray-500">{{ $featured->created_at->format('d M Y') }}</span>
                            </div>

                            <h3
                                class="text-3xl font-bold text-gray-900 dark:text-white mb-4 leading-tight group-hover:text-green-600 transition-colors font-sans">
                                <a href="{{ route('admin.artikel.show', $featured->slug) }}">
                                    {{ $featured->title }}
                                </a>
                            </h3>

                            {{-- FONT ARTICLE (Open Sans) Applied Here --}}
                            <p
                                class="font-article text-gray-600 dark:text-gray-300 mb-6 line-clamp-3 text-base leading-loose">
                                {{ Str::limit(strip_tags($featured->content), 180) }}
                            </p>

                            <div class="mt-auto">
                                <a href="{{ route('artikel.show', $featured->slug) }}"
                                    class="inline-flex items-center text-white bg-green-600 px-6 py-3 rounded-xl font-bold hover:bg-green-700 transition-all shadow-md font-sans group-hover:translate-x-1">
                                    Baca Selengkapnya <span class="material-icons text-sm ml-2">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- 4. ARTICLE GRID (Item Sisanya) --}}
            @if ($articles->count() > 1)
                <section>
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-2">
                            <span class="w-1 h-8 bg-green-600 rounded-full"></span>
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-white font-sans">Artikel Lainnya</h2>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($articles->skip(1) as $article)
                            <article
                                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full group">

                                {{-- Card Image --}}
                                <div class="relative h-52 overflow-hidden bg-gray-100">
                                    <a href="{{ route('admin.artikel.show', $article->slug) }}">
                                        @if ($article->image_path)
                                            <img src="{{ asset('storage/' . $article->image_path) }}"
                                                alt="{{ $article->title }}"
                                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-green-50">
                                                <span
                                                    class="text-4xl font-bold text-green-200 select-none uppercase">{{ substr($article->title, 0, 2) }}</span>
                                            </div>
                                        @endif
                                    </a>
                                    <span
                                        class="absolute top-4 left-4 bg-white/90 backdrop-blur text-xs font-bold px-3 py-1 rounded-lg shadow-sm text-gray-800 font-sans">
                                        Artikel
                                    </span>
                                </div>

                                {{-- Card Content --}}
                                <div class="p-6 flex flex-col grow">
                                    <div class="flex items-center text-xs text-gray-500 mb-3 gap-2 font-sans">
                                        <span class="flex items-center gap-1">
                                            <span class="material-icons text-[14px]">calendar_today</span>
                                            {{ $article->created_at->format('d M Y') }}
                                        </span>
                                    </div>

                                    <h3
                                        class="text-xl font-bold text-gray-900 dark:text-white mb-3 line-clamp-2 group-hover:text-green-600 transition-colors font-sans">
                                        <a href="{{ route('admin.artikel.show', $article->slug) }}">
                                            {{ $article->title }}
                                        </a>
                                    </h3>

                                    {{-- FONT ARTICLE (Open Sans) Applied Here --}}
                                    <p
                                        class="font-article text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-3 grow leading-loose">
                                        {{ Str::limit(strip_tags($article->content), 100) }}
                                    </p>

                                    <div
                                        class="pt-4 border-t border-gray-100 dark:border-gray-700 mt-auto flex items-center justify-between">
                                        <span class="text-xs font-medium text-gray-400 font-sans">
                                            {{ $article->created_at->diffForHumans() }}
                                        </span>
                                        <a href="{{ route('admin.artikel.show', $article->slug) }}"
                                            class="text-green-600 hover:text-green-700 font-bold text-sm flex items-center gap-1 font-sans">
                                            Baca <span class="material-icons text-sm">arrow_forward</span>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif

            {{-- 5. PAGINATION --}}
            <div class="mt-16 flex justify-center">
                {{ $articles->withQueryString()->links() }}
            </div>
        @else
            {{-- EMPTY STATE --}}
            <div
                class="text-center py-24 bg-gray-50 dark:bg-gray-800 rounded-3xl border-2 border-dashed border-gray-200 dark:border-gray-700">
                <div
                    class="bg-white dark:bg-gray-700 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                    <span class="material-icons text-4xl text-gray-400">search_off</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white font-sans">Artikel tidak ditemukan</h3>
                <p class="font-article text-gray-500 mt-2 max-w-md mx-auto">
                    Maaf, kami tidak dapat menemukan artikel yang Anda cari. Coba kata kunci lain atau kembali lagi
                    nanti.
                </p>
                <a href="{{ route('admin.artikel.index') }}"
                    class="mt-6 inline-block bg-gray-900 text-white px-6 py-2.5 rounded-xl font-medium hover:bg-gray-800 transition font-sans">
                    Refresh Halaman
                </a>
            </div>
        @endif
    </div>
</x-main-layout>
