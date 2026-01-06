<div class="relative h-48 w-full overflow-hidden">
    <svg class="absolute bottom-0 w-full h-full text-green-300 dark:text-green-900 opacity-30" fill="currentColor"
        preserveAspectRatio="none" viewBox="0 0 1440 320">
        <path
            d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"
            fill-opacity="1"></path>
    </svg>
    <svg class="absolute bottom-0 w-full h-32 text-primary dark:text-green-800" fill="currentColor"
        preserveAspectRatio="none" viewBox="0 0 1440 320">
        <path
            d="M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,160C960,139,1056,149,1152,160C1248,171,1344,181,1392,186.7L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"
            fill-opacity="1"></path>
    </svg>
</div>

<footer class="bg-primary dark:bg-green-800 pt-4 pb-8 -mt-1">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8 text-green-900 dark:text-green-100">
            <div class="col-span-1 md:col-span-1">
                <div class="flex items-center font-bold text-2xl mb-4">
                    <span class="material-icons mr-2">school</span>
                    SDN Merjoyo
                </div>
                <p class="text-sm opacity-80 text-justify">
                    Woromarto, Kec. <br>
                    Purwoasri, Kabupaten <br>
                    Kediri, Jawa Timur 64154
                </p>
            </div>
            <div>
                <h4 class="font-bold text-lg mb-4">Navigasi</h4>
                <ul class="space-y-2 text-sm opacity-90">
                    <li><a class="hover:underline" href="#">Beranda</a></li>
                    <li><a class="hover:underline" href="#">Artikel</a></li>
                    <li><a class="hover:underline" href="#">Cari Siswa</a></li>
                    <li><a class="hover:underline" href="#">Diskusi</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-lg mb-4">Tentang Kami</h4>
                <p class="text-sm opacity-90 text-justify">
                    Menyajikan artikel seputar kegiatan sekolah serta pemantauan pencapaian siswa.
                </p>
            </div>
            <div>
                <h4 class="font-bold text-lg mb-4">Hubungi Kami</h4>
                <ul class="space-y-2 text-sm opacity-90">
                    <li class="flex items-center gap-2"><span class="material-icons text-sm">phone</span> (0341)
                        555-6789</li>
                    <li class="flex items-center gap-2"><span class="material-icons text-sm">email</span>
                        info@sdnmerjoyo.sch.id</li>
                    <div class="flex gap-4 mt-4">
                        <a class="hover:text-white transition-colors" href="#"><i
                                class="material-icons">facebook</i></a>
                        <a class="hover:text-white transition-colors" href="#"><i
                                class="material-icons">camera_alt</i></a>
                    </div>
                </ul>
            </div>
        </div>
        <div class="border-t border-green-700/30 pt-8 text-center text-sm text-green-900/60 dark:text-green-100/60">
            © 2024 SDN Merjoyo. Hak Cipta Dilindungi.
        </div>
    </div>
</footer>
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
