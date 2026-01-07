<x-main-layout>
    <section class="pt-28 pb-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow border border-gray-100 p-6 md:p-8">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Edit Artikel</h1>
                    <a href="{{ route('admin.artikel.index') }}"
                        class="text-sm text-green-600 hover:text-green-700 font-semibold">
                        Kembali
                    </a>
                </div>

                @if ($errors->any())
                    <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-600">
                        Periksa kembali isian yang masih kosong atau tidak valid.
                    </div>
                @endif

                <form action="{{ route('admin.artikel.update', $article->id) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Judul Artikel</label>
                        <input type="text" name="title" value="{{ old('title', $article->title) }}"
                            class="mt-2 w-full rounded-xl border-gray-200 focus:border-green-500 focus:ring-green-500"
                            placeholder="Masukkan judul artikel" required />
                        @error('title')
                            <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Ringkasan</label>
                        <textarea name="excerpt" rows="3"
                            class="mt-2 w-full rounded-xl border-gray-200 focus:border-green-500 focus:ring-green-500"
                            placeholder="Ringkasan singkat (opsional)">{{ old('excerpt', $article->excerpt) }}</textarea>
                        @error('excerpt')
                            <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Isi Artikel</label>
                        <textarea name="content" rows="8"
                            class="mt-2 w-full rounded-xl border-gray-200 focus:border-green-500 focus:ring-green-500"
                            placeholder="Tulis isi artikel di sini" required>{{ old('content', $article->content) }}</textarea>
                        @error('content')
                            <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="text-sm font-semibold text-gray-700">URL Gambar</label>
                            <input type="text" name="image_url" value="{{ old('image_url', $article->image_url) }}"
                                class="mt-2 w-full rounded-xl border-gray-200 focus:border-green-500 focus:ring-green-500"
                                placeholder="https://contoh.com/foto.jpg" />
                            @error('image_url')
                                <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-gray-700">Tanggal Publikasi</label>
                            <input type="datetime-local" name="published_at"
                                value="{{ old('published_at', optional($article->published_at ?? $article->created_at)->format('Y-m-d\\TH:i')) }}"
                                class="mt-2 w-full rounded-xl border-gray-200 focus:border-green-500 focus:ring-green-500" />
                            @error('published_at')
                                <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('admin.artikel.index') }}"
                            class="px-5 py-2 rounded-full border border-gray-200 text-sm font-semibold text-gray-600 hover:bg-gray-100 transition">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-2 rounded-full bg-green-600 text-sm font-semibold text-white shadow hover:bg-green-700 transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-main-layout>
