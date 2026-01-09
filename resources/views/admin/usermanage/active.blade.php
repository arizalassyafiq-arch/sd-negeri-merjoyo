<x-admin-layout>
    <x-slot:title>Wali Murid Aktif</x-slot>

    <section class="pt-28 pb-16 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-6xl mx-auto px-4">

            <div class="mb-6 flex justify-between items-end">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                        Wali Murid Aktif
                    </h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Daftar orang tua/wali yang sudah diverifikasi dan aktif.
                    </p>
                </div>
            </div>

            @if (session('status'))
                <div
                    class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 dark:bg-green-900/30 dark:border-green-800 dark:text-green-300">
                    {{ session('status') }}
                </div>
            @endif

            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold">Nama</th>
                                <th class="px-4 py-3 text-left font-semibold">Email</th>
                                <th class="px-4 py-3 text-left font-semibold">Status</th>
                                <th class="px-4 py-3 text-right font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse ($wali as $user)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30">
                                    <td class="px-4 py-3 font-medium text-gray-800 dark:text-gray-200">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-600 dark:text-gray-400">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300">
                                            Aktif
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex justify-end gap-2">
                                            {{-- Tombol Nonaktifkan (Reject) --}}
                                            <form method="POST" action="{{ route('admin.wali.reject', $user->id) }}"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menonaktifkan akun ini?');">
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
                                    <td colspan="4" class="px-4 py-10 text-center text-gray-500 dark:text-gray-400">
                                        Tidak ada data wali murid aktif.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($wali->hasPages())
                <div class="pt-6">
                    {{ $wali->links() }}
                </div>
            @endif

        </div>
    </section>
</x-admin-layout>
