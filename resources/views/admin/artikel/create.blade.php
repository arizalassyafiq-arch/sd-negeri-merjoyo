@php
    $routePrefix = auth()->user()->role === 'guru' ? 'guru.artikel.' : 'admin.artikel.';
@endphp
<x-admin-layout>
    <x-slot:title>Create Artikel</x-slot>

    <section class="pt-28 pb-16 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow border border-gray-100 dark:border-gray-700 p-6 md:p-8">

                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Tambah Artikel Baru</h1>
                    <a href="{{ route($routePrefix . 'index') }}"
                        class="text-sm text-green-600 hover:text-green-700 font-semibold flex items-center gap-1">
                        <span class="material-icons text-sm">arrow_back</span> Kembali
                    </a>
                </div>

                @if ($errors->any())
                    <div
                        class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-600 dark:bg-red-900/30 dark:border-red-800 dark:text-red-300">
                        <ul class="list-disc pl-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- PENTING: Tambahkan enctype="multipart/form-data" --}}
                <form action="{{ route($routePrefix . 'store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Judul
                            Artikel</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            class="w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-green-500 focus:ring-green-500"
                            placeholder="Masukkan judul artikel yang menarik" required />
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Isi Artikel
                        </label>
                        {{-- Tambahkan id="editor" --}}
                        <textarea name="content" id="editor"
                            class="w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-green-500 focus:ring-green-500"
                            placeholder="Tulis konten lengkap artikel di sini...">{{ old('content') }}</textarea>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        {{-- Upload Gambar --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Upload
                                Gambar Utama</label>
                            <input type="file" name="image" accept="image/*"
                                class="block w-full text-sm text-gray-500 dark:text-gray-300
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-green-50 file:text-green-700
                                hover:file:bg-green-100 dark:file:bg-green-900 dark:file:text-green-300
                                border border-gray-200 dark:border-gray-600 rounded-xl cursor-pointer" />
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maksimal 2MB.</p>
                        </div>

                        {{-- Published At --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Waktu
                                Publikasi</label>
                            <input type="datetime-local" name="published_at" value="{{ old('published_at') }}"
                                class="w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-green-500 focus:ring-green-500" />
                            <p class="text-xs text-gray-500 mt-1">Kosongkan jika ingin disimpan sebagai draft.</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route($routePrefix . 'index') }}"
                            class="px-5 py-2.5 rounded-xl border border-gray-200 text-sm font-semibold text-gray-600 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700 transition">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-2.5 rounded-xl bg-green-600 text-sm font-semibold text-white shadow hover:bg-green-700 hover:shadow-lg transition transform hover:-translate-y-0.5">
                            Simpan Artikel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|',
                    'undo', 'redo'
                ],
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        },
                        {
                            model: 'heading3',
                            view: 'h3',
                            title: 'Heading 3',
                            class: 'ck-heading_heading3'
                        }
                    ]
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <style>
        /* Menyesuaikan tinggi editor agar lebih lega */
        .ck-editor__editable_inline {
            font-family: 'Open Sans', sans-serif !important;
            min-height: 400px;
            color: black;
            line-height: 1.8 !important;
            /* Leading loose */
            /* CKEditor default text color */
        }

        /* Agar editor terlihat bagus di dark mode */
        .dark .ck-editor__main>div {
            background-color: #1f2937 !important;
            /* gray-800 */
            color: white !important;
            border-color: #374151 !important;
            /* gray-700 */
        }

        .dark .ck-toolbar {
            background-color: #374151 !important;
            border-color: #4b5563 !important;
        }

        .ck-content h1,
        .ck-content h2,
        .ck-content h3 {
            font-family: 'Poppins', sans-serif !important;
        }
    </style>
</x-admin-layout>
