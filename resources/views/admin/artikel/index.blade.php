@php
    // Tentukan prefix route berdasarkan role user yg login
    $routePrefix = auth()->user()->role === 'guru' ? 'guru.artikel.' : 'admin.artikel.';
@endphp
<x-admin-layout>
    <x-slot:title>Dashboard Overview</x-slot>
    <section class="pt-28 pb-16 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Kelola Artikel</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Tambah, edit, dan hapus artikel sekolah.</p>
                </div>
                <a href="{{ route($routePrefix . 'create') }}"
                    class="inline-flex items-center justify-center rounded-full bg-green-600 px-5 py-2 text-sm font-semibold text-white shadow hover:bg-green-700 transition">
                    <span class="material-icons text-sm mr-2">add</span> Tambah Artikel
                </a>
            </div>

            @if (session('status'))
                <div
                    class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 dark:bg-green-900/30 dark:border-green-800 dark:text-green-300">
                    {{ session('status') }}
                </div>
            @endif

            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="overflow-x-auto whitespace-nowrap">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-700/50 text-gray-600 dark:text-gray-300">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold">Judul</th>
                                <th class="px-4 py-3 text-left font-semibold">Status & Tanggal</th>
                                <th class="px-4 py-3 text-left font-semibold">Ringkasan Isi</th>
                                <th class="px-4 py-3 text-left font-semibold">Gambar</th>
                                <th class="px-4 py-3 text-right font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse ($articles as $article)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                    <td class="px-4 py-3">
                                        <div class="font-semibold text-gray-800 dark:text-gray-200">
                                            {{ $article->title }}</div>
                                        <div class="text-xs text-gray-400 font-mono mt-1">{{ $article->slug }}</div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="flex flex-col gap-1">
                                            <span class="text-gray-600 dark:text-gray-400 text-xs">
                                                {{ $article->published_at ? $article->published_at->format('d M Y, H:i') : 'Draft' }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-gray-600 dark:text-gray-400 max-w-xs truncate">
                                        {{-- Mengambil 80 karakter dari content karena field excerpt tidak ada --}}
                                        {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 80) }}
                                    </td>

                                    <td class="px-4 py-3">
                                        @if ($article->image_path)
                                            <img src="{{ asset('storage/' . $article->image_path) }}"
                                                alt="{{ $article->title }}"
                                                class="w-20 h-14 object-cover rounded-lg border border-gray-200 dark:border-gray-600">
                                        @else
                                            <div
                                                class="w-20 h-14 flex items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-700 text-xs text-gray-400">
                                                No Image
                                            </div>
                                        @endif
                                    </td>

                                    <td class="px-4 py-3">
                                        <div class="flex items-center justify-end gap-2">
                                            {{-- {{-- Asumsi route publik artikel ada  --}}
                                            <a href="{{ route($routePrefix . 'show', $article) }}"
                                                class="p-2 rounded-full text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/30 transition"
                                                title="Lihat">
                                                <span class="material-icons text-sm">visibility</span>
                                            </a>

                                            <a href="{{ route($routePrefix . 'edit', $article) }}"
                                                class="p-2 rounded-full text-yellow-600 hover:bg-yellow-50 dark:hover:bg-yellow-900/30 transition"
                                                title="Edit">
                                                <span class="material-icons text-sm">edit</span>
                                            </a>

                                            <form action="{{ route($routePrefix . 'destroy', $article) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus artikel ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 rounded-full text-red-600 hover:bg-red-50 dark:hover:bg-red-900/30 transition"
                                                    title="Hapus">
                                                    <span class="material-icons text-sm">delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-10 text-center text-gray-500 dark:text-gray-400">
                                        <span class="material-icons text-4xl mb-2 text-gray-300">article</span>
                                        <p>Belum ada artikel. Klik tombol di atas untuk membuat baru.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($articles->hasPages())
                <div class="pt-6">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>
    </section>
</x-admin-layout>
