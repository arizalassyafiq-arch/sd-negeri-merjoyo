<x-main-layout>
    <div class="pt-24 pb-16 px-4 md:px-8 max-w-7xl mx-auto mt-10">

        {{-- Header Section --}}
        <section class="mb-12 text-center md:text-left">
            <div
                class="bg-linear-to-r from-green-400 to-primary rounded-[2rem] p-8 md:p-12 text-white shadow-xl relative overflow-hidden">
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl"></div>

                <div class="relative z-10 max-w-3xl">
                    <h1 class="text-3xl md:text-5xl font-bold mb-4 leading-tight">
                        Temukan Informasi Pendidikan<br class="hidden md:block" />
                    </h1>
                    <p class="text-green-50 text-lg mb-8 max-w-2xl">
                        Akses artikel terbaru seputar kegiatan sekolah siswa SDN Merjoyo.
                    </p>

                    <form action="{{ route('artikel.index') }}" method="GET"
                        class="bg-white dark:bg-card-dark p-2 rounded-2xl shadow-lg flex flex-col md:flex-row gap-2 max-w-xl">
                        <div class="grow flex items-center px-4 bg-gray-50 dark:bg-gray-800 rounded-xl">
                            <span class="material-icons text-gray-400">search</span>
                            <input name="q" value="{{ request('q') }}"
                                class="w-full bg-transparent border-none focus:ring-0 text-gray-700 dark:text-gray-200 placeholder-gray-400 ml-2 py-3 text-sm focus:outline-none"
                                placeholder="Cari artikel..." type="text" />
                        </div>
                        <button type="submit"
                            class="bg-primary hover:bg-green-600 text-white font-medium px-8 py-3 rounded-xl transition-colors shadow-md">
                            Cari
                        </button>
                    </form>
                </div>

                <div class="absolute inset-0 w-full h-full pointer-events-none z-0">
                    <img src="{{ asset('img/school.png') }}" alt="Illustration"
                        class="w-full h-full object-cover object-center opacity-10 md:opacity-20 mix-blend-overlay"
                        onerror="this.style.display='none'" />
                </div>
            </div>
        </section>

        {{-- Category Pills --}}
        <section class="mb-10 overflow-x-auto pb-4 scrollbar-hide">
            <div class="flex space-x-3 min-w-max">
                <a href="{{ route('artikel.index') }}"
                    class="px-6 py-2 rounded-full font-medium shadow-md transition-transform transform hover:scale-105 {{ !request('category') ? 'bg-primary text-white' : 'bg-white dark:bg-card-dark text-text-muted-light dark:text-text-muted-dark border border-gray-200 dark:border-gray-700' }}">
                    Semua
                </a>

                @foreach (['Parenting', 'Kesehatan', 'Kegiatan', 'Prestasi'] as $cat)
                    <a href="{{ route('artikel.index', ['category' => $cat]) }}"
                        class="px-6 py-2 rounded-full font-medium border transition-all hover:scale-105 {{ request('category') == $cat ? 'bg-primary text-white border-primary' : 'bg-white dark:bg-card-dark text-text-muted-light dark:text-text-muted-dark border-gray-200 dark:border-gray-700 hover:text-primary hover:bg-green-50' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>
        </section>

        @if ($articles->count() > 0)
            <section class="mb-12">
                <h2 class="text-2xl font-bold mb-6 flex items-center text-text-main-light dark:text-text-main-dark">
                    <span class="w-2 h-8 bg-primary rounded-full mr-3"></span>
                    Artikel Terbaru
                </h2>

                {{-- Featured Article (First Item) --}}
                @php $firstArticle = $articles->first(); @endphp
                <div class="card-modern overflow-hidden shadow-lg grid md:grid-cols-2 group mb-12">

                    <div
                        class="relative overflow-hidden h-64 md:h-auto bg-green-50 dark:bg-gray-800 flex items-center justify-center">
                        @if ($firstArticle->image_path)
                            {{-- LOGIC GAMBAR UTAMA DIPERBAIKI DISINI --}}
                            <img src="{{ asset('storage/' . $firstArticle->image_path) }}"
                                alt="{{ $firstArticle->title }}"
                                class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500" />
                        @else
                            {{-- Fallback Initials --}}
                            <span class="text-6xl font-bold text-green-600 dark:text-green-400 select-none uppercase">
                                {{ substr($firstArticle->title, 0, 2) }}
                            </span>
                        @endif

                        <div
                            class="absolute top-4 left-4 bg-primary text-white text-xs font-bold px-3 py-1 rounded-full shadow-md z-10">
                            {{ $firstArticle->category ?? 'Umum' }}
                        </div>
                    </div>

                    <div class="p-8 flex flex-col justify-center">
                        <div
                            class="flex items-center text-sm text-text-muted-light dark:text-text-muted-dark mb-3 space-x-4">
                            <span class="flex items-center"><span class="material-icons text-base mr-1">schedule</span>
                                {{ $firstArticle->created_at->format('d M Y') }}</span>
                            <span class="flex items-center"><span class="material-icons text-base mr-1">timer</span>
                                {{ ($firstArticle->published_at ?? $firstArticle->created_at)->locale('id')->diffForHumans() }}</span>
                        </div>
                        <h3
                            class="text-2xl md:text-3xl font-bold mb-4 text-text-main-light dark:text-text-main-dark hover:text-primary transition-colors">
                            <a href="{{ route('artikel.show', $firstArticle->slug) }}">{{ $firstArticle->title }}</a>
                        </h3>
                        <p class="text-text-muted-light dark:text-text-muted-dark mb-6 line-clamp-3">
                            {{ Str::limit(strip_tags($firstArticle->content), 150) }}
                        </p>
                        <a href="{{ route('artikel.show', $firstArticle->slug) }}"
                            class="inline-flex items-center font-semibold text-primary hover:text-green-600 transition-colors">
                            Baca Selengkapnya <span class="material-icons ml-1 text-sm">arrow_forward</span>
                        </a>
                    </div>
                </div>

                <div class="flex justify-between items-end mb-6">
                    <h2 class="text-2xl font-bold flex items-center text-text-main-light dark:text-text-main-dark">
                        <span class="w-2 h-8 bg-secondary rounded-full mr-3"></span>
                        Lainnya
                    </h2>
                </div>

                {{-- Grid Articles --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($articles->skip(1) as $article)
                        <article class="card-modern flex flex-col h-full group overflow-hidden">

                            <div
                                class="relative h-48 overflow-hidden bg-green-50 dark:bg-gray-800 flex items-center justify-center">
                                @if ($article->image_path)
                                    {{-- LOGIC GAMBAR GRID DIPERBAIKI DISINI --}}
                                    <img src="{{ asset('storage/' . $article->image_path) }}"
                                        alt="{{ $article->title }}"
                                        class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500" />
                                @else
                                    <span
                                        class="text-4xl font-bold text-green-600 dark:text-green-400 select-none uppercase transform group-hover:scale-110 transition-transform duration-500">
                                        {{ substr($article->title, 0, 2) }}
                                    </span>
                                @endif

                                <span
                                    class="absolute top-3 left-3 bg-blue-500 text-white text-xs font-bold px-2 py-1 rounded-lg shadow-sm z-10">
                                    {{ $article->category ?? 'Artikel' }}
                                </span>
                            </div>

                            <div class="p-6 grow flex flex-col">
                                <div
                                    class="flex items-center text-xs text-text-muted-light dark:text-text-muted-dark mb-3 space-x-2">
                                    <span>Admin</span>
                                    <span>•</span>
                                    <span>{{ $article->created_at->format('d M Y') }}</span>
                                </div>
                                <h3
                                    class="text-lg font-bold mb-3 text-text-main-light dark:text-text-main-dark group-hover:text-primary transition-colors line-clamp-2">
                                    <a href="{{ route('artikel.show', $article->slug) }}">{{ $article->title }}</a>
                                </h3>
                                <p
                                    class="text-sm text-text-muted-light dark:text-text-muted-dark mb-4 line-clamp-3 grow">
                                    {{ Str::limit(strip_tags($article->content), 100) }}
                                </p>
                                <div
                                    class="mt-auto pt-4 border-t border-gray-100 dark:border-gray-700 flex justify-between items-center">
                                    <span class="text-xs text-gray-400">
                                        {{ ($article->published_at ?? $article->created_at)->locale('id')->diffForHumans() }}
                                    </span>
                                    <button class="text-gray-400 hover:text-primary transition-colors">
                                        <span class="material-icons">bookmark_border</span>
                                    </button>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-12 flex justify-center">
                    {{ $articles->links() }}
                </div>
            </section>
        @else
            <div class="text-center py-20 bg-white dark:bg-card-dark rounded-3xl shadow-sm">
                <span class="material-icons text-6xl text-gray-300 mb-4">article</span>
                <h3 class="text-xl font-bold text-text-main-light dark:text-text-main-dark">Belum ada artikel</h3>
                <p class="text-text-muted-light dark:text-text-muted-dark mt-2">Silakan cek kembali nanti atau coba kata
                    kunci lain.</p>
                <a href="{{ route('admin.artikel.index') }}"
                    class="mt-6 inline-block bg-primary text-white px-6 py-2 rounded-full font-medium hover:bg-green-600 transition">
                    Kelola Artikel
                </a>
            </div>
        @endif
    </div>
</x-main-layout>
