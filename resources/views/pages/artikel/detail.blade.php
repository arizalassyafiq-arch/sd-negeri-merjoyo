<x-main-layout>
    {{-- Progress Bar Reading Indicator --}}
    <div class="fixed top-0 left-0 h-1.5 bg-green-600 z-50 w-full origin-left transform scale-x-0"
        style="animation: scrollProgress auto linear; animation-timeline: scroll();"></div>

    <div class="pt-28 pb-16 px-4 md:px-8 max-w-7xl mx-auto min-h-screen">

        {{-- Breadcrumb --}}
        <nav class="flex mb-8 text-sm font-medium text-gray-500 font-sans" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('artikel.index') }}"
                        class="hover:text-green-600 flex items-center transition-colors">
                        <span class="material-icons text-base mr-1">home</span> Beranda
                    </a>
                </li>
                <li><span class="material-icons text-gray-300 text-sm">chevron_right</span></li>
                <li aria-current="page">
                    <span
                        class="text-gray-800 dark:text-gray-200 line-clamp-1 max-w-50 md:max-w-md">{{ $article->title }}</span>
                </li>
            </ol>
        </nav>

        <div class="grid lg:grid-cols-[1fr_350px] gap-12 items-start">

            {{-- MAIN CONTENT --}}
            <article
                class="bg-white dark:bg-gray-800 rounded-3xl p-6 md:p-10 shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden">

                {{-- Header Artikel --}}
                <header class="mb-8">
                    {{-- Judul menggunakan Font Sans (Poppins) --}}
                    <h1
                        class="font-sans text-3xl md:text-5xl font-extrabold text-gray-900 dark:text-white mb-6 leading-tight">
                        {{ $article->title }}
                    </h1>

                    <div
                        class="flex flex-wrap items-center gap-6 text-sm text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-700 pb-8 font-sans">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-10 h-10 rounded-full bg-green-100 text-green-700 flex items-center justify-center font-bold text-sm uppercase">
                                {{ substr($article->author->name ?? 'A', 0, 1) }}
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs text-gray-400">Penulis</span>
                                <span class="font-bold text-gray-800 dark:text-gray-200">
                                    {{ $article->author->name ?? 'Admin Sekolah' }}
                                </span>
                            </div>
                        </div>
                        <div class="hidden md:block w-px h-8 bg-gray-200 dark:bg-gray-700"></div>
                        <div class="flex items-center gap-2">
                            <span class="material-icons text-green-600">calendar_today</span>
                            <span>{{ ($article->published_at ?? $article->created_at)->translatedFormat('d F Y') }}</span>
                        </div>
                    </div>
                </header>

                {{-- Featured Image --}}
                @if ($article->image_path)
                    <figure class="mb-10 rounded-2xl overflow-hidden shadow-lg bg-gray-100">
                        <img src="{{ asset('storage/' . $article->image_path) }}" alt="{{ $article->title }}"
                            class="w-full h-auto object-cover max-h-125 hover:scale-105 transition-transform duration-700" />
                    </figure>
                @endif

                {{-- ISI KONTEN (WYSIWYG OUTPUT) --}}
                {{-- Menggunakan 'font-article' (Open Sans) agar nyaman dibaca --}}
                <div
                    class="font-article prose prose-lg prose-green max-w-none dark:prose-invert 
                    prose-headings:font-sans prose-headings:font-bold prose-headings:text-gray-900 dark:prose-headings:text-white
                    prose-p:text-gray-700 dark:prose-p:text-gray-300 prose-p:leading-loose
                    prose-a:text-green-600 prose-a:no-underline hover:prose-a:underline
                    prose-img:rounded-xl prose-img:shadow-md prose-img:mx-auto">

                    {{-- Render HTML mentah dari CKEditor --}}
                    {!! $article->content !!}

                </div>

                {{-- Footer Artikel: Share Buttons --}}
                <div class="mt-12 pt-8 border-t border-gray-100 dark:border-gray-700 font-sans">
                    <h4 class="text-sm font-bold text-gray-900 dark:text-white mb-4 uppercase tracking-wide">Bagikan
                        Artikel Ini:</h4>
                    <div class="flex gap-3 flex-wrap">
                        <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . url()->current()) }}"
                            target="_blank"
                            class="flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#25D366] text-white hover:bg-[#20bd5a] transition shadow-sm hover:shadow-md text-sm font-bold">
                            <span class="material-icons text-sm">chat</span> WhatsApp
                        </a>
                        <button
                            onclick="navigator.clipboard.writeText(window.location.href); alert('Link artikel berhasil disalin!')"
                            class="flex items-center gap-2 px-5 py-2.5 rounded-full bg-gray-100 text-gray-700 hover:bg-gray-200 transition shadow-sm text-sm font-bold dark:bg-gray-700 dark:text-gray-300">
                            <span class="material-icons text-sm">link</span> Salin Link
                        </button>
                    </div>
                </div>
            </article>

            {{-- SIDEBAR --}}
            <aside class="space-y-8 sticky top-28">

                {{-- Widget: Recent Posts --}}
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2 font-sans">
                        <span class="w-1 h-6 bg-green-500 rounded-full"></span>
                        Artikel Terbaru
                    </h3>

                    <div class="space-y-6">
                        @forelse ($recent ?? [] as $item)
                            <a href="{{ route('artikel.show', $item->slug) }}" class="group flex gap-4 items-start">
                                <div
                                    class="w-20 h-20 rounded-xl overflow-hidden shrink-0 bg-gray-100 relative shadow-sm">
                                    @if ($item->image_path)
                                        <img src="{{ asset('storage/' . $item->image_path) }}"
                                            alt="{{ $item->title }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-green-50 text-green-600 font-bold text-xl select-none">
                                            {{ substr($item->title, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h4
                                        class="font-sans text-sm font-bold text-gray-800 dark:text-gray-200 group-hover:text-green-600 transition-colors line-clamp-2 leading-snug mb-1">
                                        {{ $item->title }}
                                    </h4>
                                    <p class="text-xs text-gray-400 flex items-center gap-1 font-sans">
                                        <span class="material-icons text-[10px]">schedule</span>
                                        {{ $item->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </a>
                        @empty
                            <p class="text-sm text-gray-400 font-sans">Belum ada artikel lain.</p>
                        @endforelse
                    </div>

                    <div class="mt-6 pt-6 border-t border-gray-100 dark:border-gray-700 text-center font-sans">
                        <a href="{{ route('artikel.index') }}"
                            class="text-sm font-bold text-green-600 hover:text-green-800 inline-flex items-center gap-1 transition">
                            Lihat Semua <span class="material-icons text-sm">arrow_forward</span>
                        </a>
                    </div>
                </div>

                {{-- Widget: Info Sekolah / Promo --}}
                <div class="relative rounded-2xl overflow-hidden shadow-lg group">
                    <div class="absolute inset-0 bg-linear-to-t from-black/80 to-transparent z-10"></div>

                    {{-- Pastikan gambar ini ada atau ganti dengan gambar statis sekolah --}}
                    <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=400&q=80"
                        class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-700"
                        alt="Sekolah">

                    <div class="absolute bottom-0 left-0 p-6 z-20 w-full text-white font-sans">
                        <h4 class="font-bold text-lg mb-1">Penerimaan Siswa Baru</h4>
                        <p class="text-gray-300 text-xs mb-4">Bergabunglah bersama kami untuk masa depan cerah.</p>
                        <a href="#"
                            class="block w-full text-center bg-green-600 hover:bg-green-700 text-white text-xs font-bold py-3 rounded-xl transition shadow-lg transform hover:-translate-y-0.5">
                            Info Pendaftaran
                        </a>
                    </div>
                </div>

            </aside>
        </div>
    </div>
</x-main-layout>

{{-- Style Progress Bar --}}
@push('styles')
    <style>
        @keyframes scrollProgress {
            from {
                transform: scaleX(0);
            }

            to {
                transform: scaleX(1);
            }
        }
    </style>
@endpush
