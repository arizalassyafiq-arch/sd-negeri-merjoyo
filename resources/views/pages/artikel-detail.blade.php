<x-main-layout>
    <div class="pt-24 pb-16 px-4 md:px-8 max-w-7xl mx-auto mt-10">

        <div class="grid lg:grid-cols-[1fr_350px] gap-10 items-start">

            <article class="card-modern p-6 md:p-10 shadow-xl">

                <div
                    class="flex flex-wrap items-center gap-2 text-sm text-text-muted-light dark:text-text-muted-dark mb-6">
                    <a href="{{ route('artikel.index') }}" class="hover:text-primary transition-colors">Artikel</a>
                    <span class="material-icons text-xs">chevron_right</span>
                    <span class="font-semibold text-primary">{{ $article->category ?? 'Umum' }}</span>
                </div>

                <h1
                    class="text-3xl md:text-5xl font-bold text-text-main-light dark:text-text-main-dark mb-6 leading-tight">
                    {{ $article->title }}
                </h1>

                <div
                    class="flex flex-wrap items-center gap-6 text-sm text-text-muted-light dark:text-text-muted-dark mb-8 border-b border-gray-100 dark:border-gray-700 pb-8">
                    <div class="flex items-center gap-2">
                        <div
                            class="w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-xs uppercase">
                            {{ substr($article->author->name ?? 'A', 0, 1) }}
                        </div>
                        <span class="font-medium">
                            {{ $article->author->name ?? 'Admin Sekolah' }}
                        </span>
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="material-icons text-base">calendar_today</span>
                        <time datetime="{{ $article->published_at }}">
                            {{ ($article->published_at ?? $article->created_at)->translatedFormat('d F Y') }}
                        </time>
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="material-icons text-base">schedule</span>
                        <span>{{ ($article->published_at ?? $article->created_at)->locale('id')->diffForHumans() }}</span>
                    </div>
                </div>

                <div
                    class="relative w-full h-64 md:h-100 rounded-2xl overflow-hidden mb-10 shadow-md bg-green-50 dark:bg-gray-800 flex items-center justify-center">

                    @if ($article->image_path)
                        {{-- LOGIC GAMBAR DETAIL DIPERBAIKI --}}
                        <img src="{{ asset('storage/' . $article->image_path) }}" alt="{{ $article->title }}"
                            class="w-full h-full object-cover" />
                    @else
                        {{-- Fallback Initials --}}
                        <span class="text-6xl font-bold text-green-600 dark:text-green-400 select-none uppercase">
                            {{ substr($article->title, 0, 2) }}
                        </span>
                    @endif
                </div>

                <div
                    class="prose prose-lg prose-green max-w-none dark:prose-invert text-text-main-light dark:text-text-main-dark leading-relaxed">
                    {{-- Render HTML Konten (pastikan input aman) --}}
                    {!! nl2br(e($article->content)) !!}
                    {{-- Catatan: Jika pakai Summernote/WYSIWYG, gunakan {!! $article->content !!} saja --}}
                </div>

                <div class="mt-12 pt-8 border-t border-gray-100 dark:border-gray-700">
                    <h4 class="text-sm font-bold text-text-main-light dark:text-text-main-dark mb-4">Bagikan Artikel:
                    </h4>
                    <div class="flex gap-3">
                        <button
                            class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:scale-110 transition-transform">
                            <span class="material-icons text-lg">facebook</span>
                        </button>
                        <button
                            class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center hover:scale-110 transition-transform">
                            <span class="material-icons text-lg">whatsapp</span>
                        </button>
                        <button
                            class="w-10 h-10 rounded-full bg-sky-500 text-white flex items-center justify-center hover:scale-110 transition-transform">
                            <span class="material-icons text-lg">link</span>
                        </button>
                    </div>
                </div>
            </article>

            <aside class="space-y-8 sticky top-28">

                <div class="card-modern p-6 shadow-lg border border-green-50 dark:border-gray-700">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="w-1 h-6 bg-secondary rounded-full"></span>
                        <h3 class="text-lg font-bold text-text-main-light dark:text-text-main-dark">Artikel Terbaru</h3>
                    </div>

                    <div class="space-y-5">
                        @forelse ($recent as $item)
                            <a href="{{ route('artikel.show', $item->slug) }}" class="group flex gap-4 items-start">

                                <div
                                    class="w-20 h-20 rounded-xl overflow-hidden shrink-0 relative bg-green-50 dark:bg-gray-800 flex items-center justify-center">
                                    @if ($item->image_path)
                                        {{-- LOGIC GAMBAR SIDEBAR DIPERBAIKI --}}
                                        <img src="{{ asset('storage/' . $item->image_path) }}"
                                            alt="{{ $item->title }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                                    @else
                                        <span
                                            class="text-xl font-bold text-green-600 dark:text-green-400 select-none uppercase group-hover:scale-110 transition-transform duration-300">
                                            {{ substr($item->title, 0, 2) }}
                                        </span>
                                    @endif
                                </div>

                                <div>
                                    <h4
                                        class="text-sm font-bold text-text-main-light dark:text-text-main-dark group-hover:text-primary transition-colors line-clamp-2 leading-snug">
                                        {{ $item->title }}
                                    </h4>
                                    <p
                                        class="text-xs text-text-muted-light dark:text-text-muted-dark mt-2 flex items-center gap-1">
                                        <span class="material-icons text-[10px]">schedule</span>
                                        {{ ($item->published_at ?? $item->created_at)->locale('id')->diffForHumans() }}
                                    </p>
                                </div>
                            </a>
                        @empty
                            <p class="text-sm text-text-muted-light">Belum ada artikel lain.</p>
                        @endforelse
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-700 text-center">
                        <a href="{{ route('artikel.index') }}"
                            class="text-sm font-bold text-primary hover:text-green-600 transition-colors inline-flex items-center gap-1">
                            Lihat Semua <span class="material-icons text-sm">arrow_forward</span>
                        </a>
                    </div>
                </div>

                {{-- Promo Card --}}
                <div class="relative rounded-2xl overflow-hidden shadow-lg group">
                    <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=400&q=80"
                        class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-700"
                        alt="Sekolah">
                    <div
                        class="absolute inset-0 bg-linear-to-t from-black/80 to-transparent p-6 flex flex-col justify-end">
                        <h4 class="text-white font-bold text-lg">Penerimaan Siswa Baru</h4>
                        <p class="text-gray-200 text-xs mt-1 mb-3">Segera daftarkan putra-putri Anda.</p>
                        <button
                            class="bg-primary text-white text-xs font-bold py-2 px-4 rounded-full w-fit hover:bg-green-600 transition">Info
                            Detail</button>
                    </div>
                </div>

            </aside>
        </div>
    </div>
</x-main-layout>
