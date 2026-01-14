@php
    // Tentukan prefix route berdasarkan role user yg login
    $routePrefix = auth()->user()->role === 'guru' ? 'guru.artikel.' : 'admin.artikel.';
@endphp
<x-admin-layout>
    <x-slot:title>{{ $article->title }}</x-slot:title>

    <section class="pt-28 pb-16 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-8">
                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center gap-1 text-sm text-green-600 hover:text-green-700 mb-4">
                    <span class="material-icons text-sm">arrow_back</span> Kembali
                </a>

                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 leading-tight">
                    {{ $article->title }}
                </h1>

                <div class="mt-2 flex flex-wrap items-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                    <span>
                        {{ $article->published_at ? $article->published_at->format('d M Y, H:i') : 'Draft' }}
                    </span>
                    <span>•</span>
                    <span> {{ $article->author->name ?? 'Unknown' }}</span>
                </div>
            </div>

            {{-- Gambar Utama --}}
            @if ($article->image_path)
                <div class="mb-8">
                    <img src="{{ asset('storage/' . $article->image_path) }}" alt="{{ $article->title }}"
                        class="w-full max-h-105 object-cover rounded-2xl shadow">
                </div>
            @endif

            {{-- Konten Artikel --}}
            <article
                class="prose prose-green max-w-none dark:prose-invert
                       prose-headings:scroll-mt-28">
                {!! $article->content !!}
            </article>

            {{-- Footer --}}
            <div class="mt-12 pt-6 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">
                        Terakhir diperbarui:
                        {{ $article->updated_at->format('d M Y, H:i') }}
                    </span>

                    <a href="{{ route($routePrefix . 'edit', $article) }}"
                        class="inline-flex items-center gap-1 text-sm font-semibold text-yellow-600 hover:text-yellow-700">
                        <span class="material-icons text-sm">edit</span>
                        Edit Artikel
                    </a>
                </div>
            </div>

        </div>
    </section>
</x-admin-layout>
