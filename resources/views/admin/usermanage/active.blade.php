<x-admin-layout>
    <x-slot:title>Wali Murid Aktif</x-slot>

    <section class="pt-28 pb-16 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-6xl mx-auto px-4">

            {{-- HEADER & SEARCH BAR --}}
            <div class="mb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                        Wali Murid Aktif
                    </h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Total {{ number_format($wali->total()) }} wali murid terverifikasi.
                    </p>
                </div>

                {{-- FORM PENCARIAN DENGAN ALPINE JS DEBOUNCE --}}
                <div class="w-full md:w-auto">
                    <form action="{{ route('admin.wali.active') }}" method="GET" class="relative flex items-center">

                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            {{-- Icon Search --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </span>

                        {{-- INPUT SEARCH --}}
                        {{-- @input.debounce.500ms="$el.form.submit()" : Mengirim form otomatis setelah berhenti mengetik 0.5 detik --}}
                        <input type="text" name="search" value="{{ request('search') }}"
                            @input.debounce.500ms="$el.form.submit()" placeholder="Cari Nama / Email..."
                            class="w-full md:w-64 pl-10 pr-10 py-2 rounded-lg border border-gray-300 bg-white dark:bg-gray-800 dark:border-gray-700 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-shadow"
                            autocomplete="off">

                        {{-- Tombol Reset (Muncul jika sedang mencari) --}}
                        @if (request('search'))
                            <a href="{{ route('admin.wali.active') }}"
                                class="absolute right-2 p-1 text-gray-400 hover:text-red-500 transition-colors"
                                title="Hapus Pencarian">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            @if (session('status'))
                <div
                    class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 dark:bg-green-900/30 dark:border-green-800 dark:text-green-300 flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">check_circle</span>
                    {{ session('status') }}
                </div>
            @endif

            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-700/50 whitespace-nowrap">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Nama Wali
                                </th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Email
                                </th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Siswa
                                    Terhubung</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Status
                                </th>
                                <th class="px-4 py-3 text-right font-semibold text-gray-700 dark:text-gray-300">Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700 whitespace-nowrap">
                            @forelse ($wali as $user)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                    <td class="px-4 py-3 font-medium text-gray-800 dark:text-gray-200">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-600 dark:text-gray-400">
                                        {{ $user->email }}
                                    </td>
                                    {{-- Menampilkan Siswa --}}
                                    <td class="px-4 py-3 text-gray-600 dark:text-gray-400">
                                        @if ($user->students->count() > 0)
                                            <div class="flex flex-col gap-1">
                                                @foreach ($user->students as $student)
                                                    <span
                                                        class="inline-flex items-center text-xs bg-blue-50 text-blue-700 px-2 py-0.5 rounded border border-blue-100 dark:bg-blue-900/30 dark:text-blue-300 dark:border-blue-800 w-fit">
                                                        {{ $student->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-xs text-gray-400 italic">Belum ada siswa</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300 border border-green-200 dark:border-green-800">
                                            Aktif
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex justify-end gap-2">
                                            <form method="POST" action="{{ route('admin.wali.reject', $user->id) }}"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menonaktifkan akun ini? Akses wali ke siswa akan dicabut.');">
                                                @csrf
                                                @method('PATCH')
                                                <button
                                                    class="px-3 py-1.5 rounded-full border border-red-200 text-red-600 hover:bg-red-50 dark:border-red-900 dark:text-red-400 dark:hover:bg-red-900/20 text-xs font-semibold transition-colors">
                                                    Nonaktifkan
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center gap-3">
                                            <div
                                                class="h-16 w-16 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-8 h-8">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                                </svg>
                                            </div>
                                            <div class="text-center">
                                                <p class="text-gray-900 dark:text-white font-medium">Tidak ada data
                                                    ditemukan.</p>
                                                <p class="text-gray-500 text-sm mt-1">Coba kata kunci lain atau belum
                                                    ada wali aktif.</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($wali->hasPages())
                <div class="pt-6">
                    {{ $wali->withQueryString()->links() }}
                </div>
            @endif

        </div>
    </section>
</x-admin-layout>
