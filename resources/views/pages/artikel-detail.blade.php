<x-main-layout>
    <div class="relative overflow-hidden bg-background-light dark:bg-background-dark">
        <div class="custom-curve-bg dark:hidden"></div>
        <div class="absolute -top-32 -left-20 h-72 w-72 rounded-full bg-green-400/20 blur-3xl"></div>
        <div class="absolute top-16 right-0 h-72 w-72 rounded-full bg-emerald-300/20 blur-3xl"></div>

        <section class="pt-24 pb-10">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="bg-gray-900 border border-green-200 dark:border-gray-700 rounded-2xl shadow-lg p-6 md:p-8">
                    <a href="{{ route('artikel.index') }}"
                        class="text-sm text-green-300 hover:text-green-200">
                        Kembali ke Artikel
                    </a>
                    <h1 class="mt-4 text-3xl md:text-4xl font-bold text-white">
                        {{ $article->title }}
                    </h1>
                    <p class="mt-2 text-sm text-gray-300">
                        {{ ($article->published_at ?? $article->created_at)->format('D, d M Y H:i') }} WIB
                    </p>

                    <div class="mt-6 rounded-2xl overflow-hidden border border-green-100 dark:border-gray-700 bg-green-50 dark:bg-gray-800">
                        @if ($article->image_url)
                            <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                                class="w-full h-64 object-cover" />
                        @else
                            <div class="h-64 flex items-center justify-center text-green-300 dark:text-green-200">
                                <span class="material-icons text-5xl">photo</span>
                            </div>
                        @endif
                    </div>

                    <div class="mt-6 text-white leading-relaxed space-y-4">
                        {!! nl2br(e($article->content)) !!}
                    </div>
                </div>
            </div>
        </section>

        <section class="pb-16">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="bg-gray-900 border border-gray-700 rounded-2xl shadow-xl p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-white">Artikel Lainnya</h2>
                        <a href="{{ route('artikel.index') }}"
                            class="text-sm font-semibold text-green-300 hover:text-green-200">
                            Lihat Semua
                        </a>
                    </div>
                    <div class="grid gap-4 md:grid-cols-2">
                        @forelse ($recent as $item)
                            <a href="{{ route('artikel.show', $item->slug) }}"
                                class="border border-gray-700 rounded-xl p-4 hover:shadow-md transition bg-gray-900">
                                <p class="text-xs text-white mb-2">
                                    {{ ($item->published_at ?? $item->created_at)->format('D, d M Y H:i') }} WIB
                                </p>
                                <h3 class="font-semibold text-white">{{ $item->title }}</h3>
                                <p class="text-sm text-white mt-2">
                                    {{ $item->excerpt ?? \Illuminate\Support\Str::limit(trim(strip_tags($item->content)), 120) }}
                                </p>
                            </a>
                        @empty
                            <p class="text-sm text-white">Belum ada artikel lainnya.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

        <div class="absolute bottom-0 left-0 w-full overflow-hidden translate-y-px leading-none pointer-events-none">
            <svg class="relative block w-full h-16 md:h-24" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V0C45.3,33.47,105.9,62.18,171.19,68.82,217.39,73.52,268.93,66.2,321.39,56.44Z"
                    class="fill-background-light dark:fill-background-dark"></path>
            </svg>
        </div>
    </div>
</x-main-layout>
