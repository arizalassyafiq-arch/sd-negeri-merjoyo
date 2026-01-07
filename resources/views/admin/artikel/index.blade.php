<x-main-layout>
    <section class="pt-28 pb-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Kelola Artikel</h1>
                    <p class="text-sm text-gray-500">Tambah, edit, dan hapus artikel dengan cepat.</p>
                </div>
                <a href="{{ route('admin.artikel.create') }}"
                    class="inline-flex items-center justify-center rounded-full bg-green-600 px-5 py-2 text-sm font-semibold text-white shadow hover:bg-green-700 transition">
                    Tambah Artikel
                </a>
            </div>

            @if (session('status'))
                <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50 text-gray-600">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold">Judul</th>
                                <th class="px-4 py-3 text-left font-semibold">Tanggal</th>
                                <th class="px-4 py-3 text-left font-semibold">Ringkasan</th>
                                <th class="px-4 py-3 text-right font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($articles as $article)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3">
                                        <div class="font-semibold text-gray-800">{{ $article->title }}</div>
                                        <div class="text-xs text-gray-500">{{ $article->slug }}</div>
                                    </td>
                                    <td class="px-4 py-3 text-gray-600 whitespace-nowrap">
                                        {{ ($article->published_at ?? $article->created_at)->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-600">
                                        {{ $article->excerpt ?? \Illuminate\Support\Str::limit(trim(strip_tags($article->content)), 80) }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('artikel.show', $article->slug) }}"
                                                class="px-3 py-1 text-xs rounded-full border border-gray-200 text-gray-600 hover:bg-gray-100 transition">
                                                Lihat
                                            </a>
                                            <a href="{{ route('admin.artikel.edit', $article->id) }}"
                                                class="px-3 py-1 text-xs rounded-full border border-green-200 text-green-700 hover:bg-green-50 transition">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.artikel.destroy', $article->id) }}" method="POST"
                                                onsubmit="return confirm('Hapus artikel ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-3 py-1 text-xs rounded-full border border-red-200 text-red-600 hover:bg-red-50 transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-10 text-center text-gray-500">
                                        Belum ada artikel. Klik "Tambah Artikel" untuk mulai.
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
</x-main-layout>
