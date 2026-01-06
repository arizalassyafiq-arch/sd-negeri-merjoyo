<x-main-layout>
    <main class="grow relative z-20 bg-background-light dark:bg-background-dark  pt-32 pb-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center">
            <h2 class="text-3xl font-bold text-text-primary-light dark:text-text-primary-dark mb-6">
                SDN Merjoyo: Membentuk Karakter, <br /> Meraih Prestasi
            </h2>
            <p class="text-lg font-medium text-primary mb-8">Bergabunglah bersama kami!!</p>
            <p class="text-text-secondary-light dark:text-text-secondary-dark leading-relaxed mb-12 max-w-2xl mx-auto">
                Pertama, kenali lingkungan sekolah kami yang asri dan kondusif. Mulai dari fasilitas perpustakaan
                lengkap hingga laboratorium komputer modern, semua sarana kami dapat diakses untuk menunjang
                pembelajaran. Mulai bangun masa depan cerah putra-putri Anda sekarang!
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16">
                <div
                    class="bg-surface-light dark:bg-surface-dark p-8 rounded-2xl shadow-sm hover:shadow-md transition-shadow group">
                    <div
                        class="w-14 h-14 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center text-blue-600 dark:text-blue-300 mb-6 mx-auto group-hover:scale-110 transition-transform">
                        <span class="material-icons text-3xl">menu_book</span>
                    </div>
                    <h3 class="text-xl font-bold text-text-primary-light dark:text-text-primary-dark mb-3">Kurikulum
                        Merdeka</h3>
                    <p class="text-text-secondary-light dark:text-text-secondary-dark text-sm">
                        Menerapkan kurikulum terbaru yang berfokus pada pengembangan minat dan bakat siswa.
                    </p>
                </div>
                <div
                    class="bg-surface-light dark:bg-surface-dark p-8 rounded-2xl shadow-sm hover:shadow-md transition-shadow group">
                    <div
                        class="w-14 h-14 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center text-green-600 dark:text-green-300 mb-6 mx-auto group-hover:scale-110 transition-transform">
                        <span class="material-icons text-3xl">sports_soccer</span>
                    </div>
                    <h3 class="text-xl font-bold text-text-primary-light dark:text-text-primary-dark mb-3">
                        Ekstrakurikuler</h3>
                    <p class="text-text-secondary-light dark:text-text-secondary-dark text-sm">
                        Beragam kegiatan ekstrakurikuler untuk menyalurkan hobi dan kreativitas siswa.
                    </p>
                </div>
                <div
                    class="bg-surface-light dark:bg-surface-dark p-8 rounded-2xl shadow-sm hover:shadow-md transition-shadow group">
                    <div
                        class="w-14 h-14 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center text-purple-600 dark:text-purple-300 mb-6 mx-auto group-hover:scale-110 transition-transform">
                        <span class="material-icons text-3xl">emoji_events</span>
                    </div>
                    <h3 class="text-xl font-bold text-text-primary-light dark:text-text-primary-dark mb-3">Prestasi
                        Sekolah</h3>
                    <p class="text-text-secondary-light dark:text-text-secondary-dark text-sm">
                        Mencetak siswa berprestasi di tingkat kecamatan, kota, hingga provinsi.
                    </p>
                </div>
            </div>
        </div>
    </main>

    <div aria-modal="true" class="fixed inset-0 z-100 hidden" id="chatModal" role="dialog">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity opacity-0" id="chatBackdrop"
            onclick="toggleChat()"></div>
        <div class="absolute bottom-0 sm:bottom-auto sm:top-1/2 sm:left-1/2 sm:-translate-x-1/2  w-full sm:w-125 h-[85vh] sm:h-162.5 bg-white dark:bg-surface-dark sm:rounded-2xl shadow-2xl flex flex-col overflow-hidden transition-all duration-300 transform translate-y-full sm:translate-y-0 sm:scale-95 opacity-0"
            id="chatContainer">
            <div
                class="bg-white dark:bg-surface-dark border-b border-gray-100 dark:border-gray-700 p-4 flex items-center justify-between shrink-0 relative z-10 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-primary/20 text-primary flex items-center justify-center">
                        <span class="material-symbols-outlined">forum</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 dark:text-white text-lg leading-tight">Ruang Diskusi</h3>
                        <div class="flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                            <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">Forum Wali Murid &amp;
                                Sekolah</p>
                        </div>
                    </div>
                </div>
                <button
                    class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition-colors text-gray-500 dark:text-gray-400"
                    onclick="toggleChat()">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div
                class="flex-1 overflow-y-auto p-4 space-y-6 bg-surface-light dark:bg-[#1a202c] bg-chat-pattern bg-pattern-dots dark:bg-chat-pattern-dark chat-scroll relative">
                <div class="flex justify-center">
                    <span
                        class="bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-[10px] py-1 px-3 rounded-full font-medium shadow-sm">
                        Hari Ini
                    </span>
                </div>
                <div class="flex gap-3 max-w-[85%]">
                    <div
                        class="w-8 h-8 rounded-full bg-purple-500 text-white flex items-center justify-center text-xs font-bold shrink-0 shadow-md">
                        BW
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-xs text-gray-500 dark:text-gray-400 ml-1">Bambang Wijaya (Wali Murid)</span>
                        <div
                            class="bg-white dark:bg-gray-800 p-3.5 rounded-2xl rounded-tl-none shadow-sm border border-gray-100 dark:border-gray-700">
                            <p class="text-sm text-gray-800 dark:text-gray-200">
                                Selamat pagi bapak/ibu guru. Apakah untuk kegiatan outing class besok anak-anak perlu
                                membawa bekal tambahan?
                            </p>
                        </div>
                        <span class="text-[10px] text-gray-400 ml-1">08:12</span>
                    </div>
                </div>
                <div class="flex gap-3 max-w-[85%]">
                    <div
                        class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center text-xs font-bold shrink-0 shadow-md">
                        ZA
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-xs text-gray-500 dark:text-gray-400 ml-1">Zain (Guru Kelas 4)</span>
                        <div
                            class="bg-white dark:bg-gray-800 p-3.5 rounded-2xl rounded-tl-none shadow-sm border border-gray-100 dark:border-gray-700">
                            <p class="text-sm text-gray-800 dark:text-gray-200">
                                Halo Pak Bambang <span class="inline-block align-middle">👋</span>. Cukup bawa snack
                                ringan saja pak, makan siang sudah disediakan sekolah.
                            </p>
                        </div>
                        <span class="text-[10px] text-gray-400 ml-1">08:15</span>
                    </div>
                </div>
                <div class="flex gap-3 max-w-[85%]">
                    <div
                        class="w-8 h-8 rounded-full bg-pink-500 text-white flex items-center justify-center text-xs font-bold shrink-0 shadow-md">
                        YA
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-xs text-gray-500 dark:text-gray-400 ml-1">Yahya</span>
                        <div
                            class="bg-white dark:bg-gray-800 p-3.5 rounded-2xl rounded-tl-none shadow-sm border border-gray-100 dark:border-gray-700">
                            <p class="text-sm text-gray-800 dark:text-gray-200">
                                ok siap pak
                            </p>
                        </div>
                        <span class="text-[10px] text-gray-400 ml-1">08:20</span>
                    </div>
                </div>
                <div class="flex gap-3 max-w-[85%] ml-auto flex-row-reverse">
                    <div
                        class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold shrink-0 shadow-md">
                        DA
                    </div>
                    <div class="flex flex-col gap-1 items-end">
                        <div class="bg-primary text-white p-3.5 rounded-2xl rounded-tr-none shadow-md">
                            <p class="text-sm">
                                Terima kasih informasinya Pak Zain! Keren responsif sekali.
                            </p>
                        </div>
                        <div class="flex items-center gap-1 mr-1">
                            <span class="text-[10px] text-gray-400">23:25</span>
                            <span class="material-symbols-outlined text-[12px] text-primary">done_all</span>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center pt-2">
                    <span class="text-xs text-gray-400 italic">Bpk. H. Suwandi sedang mengetik...</span>
                </div>
            </div>
            <div class="bg-white dark:bg-surface-dark border-t border-gray-100 dark:border-gray-700 p-4 shrink-0">
                <div class="relative flex items-end gap-2">
                    <button class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                        <span class="material-symbols-outlined">add_circle</span>
                    </button>
                    <div class="flex-1 bg-surface-light dark:bg-black/20 rounded-2xl px-4 py-2 flex items-center">
                        <input
                            class="w-full bg-transparent border-0 focus:ring-0 text-sm text-gray-800 dark:text-white p-0 placeholder-gray-400"
                            placeholder="Ketik pesan diskusi..." type="text" />
                        <button class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 ml-2">
                            <span class="material-symbols-outlined text-xl">sentiment_satisfied</span>
                        </button>
                    </div>
                    <button
                        class="p-2 bg-primary hover:bg-secondary text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center">
                        <span class="material-symbols-outlined">send</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
