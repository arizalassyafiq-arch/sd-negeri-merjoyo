<x-main-layout>
    <section class="relative pt-24 pb-20 overflow-hidden">
        <div class="custom-curve-bg"></div>
        <div class="absolute bottom-0 left-0 w-full overflow-hidden translate-y-px leading-none">
            <svg class="relative block w-full h-16 md:h-24" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V0C45.3,33.47,105.9,62.18,171.19,68.82,217.39,73.52,268.93,66.2,321.39,56.44Z"
                    class="fill-background-light dark:fill-background-dark"></path>
            </svg>
        </div>
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-[#2ecc71] border border-green-400 rounded-2xl shadow-lg p-5 md:p-8">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between mb-8">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Artikel Kesehatan</h1>
                        <p class="text-sm text-green-50 dark:text-green-900">
                            Informasi terbaru seputar kegiatan dan edukasi di SDN Merjoyo.
                        </p>
                    </div>
                    <a href="{{ route('admin.artikel.index') }}"
                        class="inline-flex w-fit items-center justify-center rounded-full bg-white px-4 py-2 text-sm font-bold text-green-600 shadow-sm hover:bg-green-50 transition">
                        Kelola Artikel
                    </a>
                </div>

                <div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_280px]">
                    <div class="space-y-4">
                        @forelse ($articles as $article)
                            <article
                                class="flex flex-col md:flex-row gap-4 rounded-2xl p-4 bg-white dark:bg-surface-dark border border-green-100 dark:border-gray-700 shadow-sm hover:shadow-md transition">
                                <div
                                    class="md:w-48 h-32 md:h-28 rounded-xl overflow-hidden bg-gray-100 dark:bg-gray-800 shrink-0 flex items-center justify-center">
                                    @if ($article->image_url)
                                        <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                                            class="w-full h-full object-cover" />
                                    @else
                                        <span
                                            class="material-icons text-4xl text-gray-300 dark:text-gray-500">photo</span>
                                    @endif
                                </div>
                                <div class="flex-1 flex flex-col justify-between">
                                    <div>
                                        <p class="text-[11px] text-gray-500 dark:text-gray-200 font-medium mb-1">
                                            {{ ($article->published_at ?? $article->created_at)->format('D, d M Y H:i') }}
                                            WIB
                                        </p>
                                        <h2
                                            class="text-base md:text-lg font-bold text-gray-800 dark:text-gray-100 leading-tight">
                                            {{ $article->title }}
                                        </h2>
                                        <p class="text-xs text-gray-600 dark:text-gray-200 mt-2 line-clamp-2">
                                            {{ $article->excerpt ?? \Illuminate\Support\Str::limit(trim(strip_tags($article->content)), 160) }}
                                        </p>
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{ route('artikel.show', $article->slug) }}"
                                            class="inline-flex items-center rounded-full bg-[#00c853] px-4 py-1.5 text-xs font-bold text-white shadow-sm hover:bg-green-600 transition">
                                            Baca Selengkapnya
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div
                                class="border-2 border-dashed border-green-300 rounded-xl p-8 text-center text-gray-700 dark:text-gray-100 text-sm">
                                Belum ada artikel. Klik "Kelola Artikel" untuk menambahkan konten baru.
                            </div>
                        @endforelse

                        @if ($articles->hasPages())
                            <div class="pt-4">
                                {{ $articles->links() }}
                            </div>
                        @endif
                    </div>

                    <aside class="space-y-4">
                        <div
                            class="bg-white dark:bg-surface-dark rounded-2xl p-5 shadow-sm border border-green-100 dark:border-gray-700">
                            <h3
                                class="font-bold text-gray-800 dark:text-gray-100 mb-4 text-sm border-b border-gray-200 dark:border-gray-700 pb-2">
                                Disarankan untuk Anda</h3>
                            <ul class="space-y-3 text-xs text-gray-700 dark:text-gray-100">
                                @forelse ($recommended as $item)
                                    <li class="flex items-start gap-3">
                                        <span class="mt-1 h-2 w-2 rounded-full bg-green-500 shrink-0"></span>
                                        <a href="{{ route('artikel.show', $item->slug) }}"
                                            class="hover:text-green-600 dark:hover:text-green-400 font-medium transition">{{ $item->title }}</a>
                                    </li>
                                @empty
                                    <li class="text-gray-500 dark:text-gray-300 italic">Belum ada rekomendasi.</li>
                                @endforelse
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
</x-main-layout>
