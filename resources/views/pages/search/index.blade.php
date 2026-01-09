<x-main-layout>
    <div
        class="relative min-h-screen flex flex-col justify-center overflow-hidden bg-background-light dark:bg-background-dark">

        <div class="absolute inset-0 bg-hero-gradient dark:bg-hero-gradient-dark z-0">
            <div
                class="absolute top-1/4 right-1/4 w-96 h-96 bg-blue-400/30 rounded-full blur-3xl mix-blend-overlay animate-pulse">
            </div>
            <div class="absolute bottom-1/4 left-1/4 w-72 h-72 bg-yellow-200/20 rounded-full blur-3xl mix-blend-overlay">
            </div>
        </div>

        <main class="relative z-10 w-full px-4 py-20 md:py-24 mt-10">
            <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center">

                <div class="text-white space-y-6 animate-fade-in-up">
                    <div
                        class="inline-block bg-white/20 backdrop-blur-md border border-white/30 px-4 py-1 rounded-full text-sm font-medium">
                        🔍 Pencarian Data Siswa
                    </div>

                    <h1 class="text-4xl md:text-5xl font-bold leading-tight drop-shadow-sm">
                        Pantau Hasil <br />
                        <span class="text-emerald-900 dark:text-emerald-200">Belajar Siswa</span>
                    </h1>

                    <p class="text-lg md:text-xl text-emerald-50 max-w-md font-light leading-relaxed">
                        Masukkan Nomor Induk Kependudukan (NIK) siswa untuk mengakses rapor digital dan riwayat
                        pencapaian akademik terkini.
                    </p>

                    <div
                        class="mt-8 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-6 shadow-lg transform hover:-translate-y-1 transition-transform duration-300">
                        <div class="flex items-start gap-4">
                            <div class="bg-emerald-500 p-2 rounded-full shrink-0 shadow-md">
                                <span class="material-icons-round text-white">privacy_tip</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg mb-1">Keamanan Data</h3>
                                <p class="text-sm text-emerald-50 opacity-90">
                                    Pastikan NIK yang Anda masukkan benar. Data siswa dilindungi dan hanya dapat diakses
                                    oleh wali murid yang sah.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-surface-light dark:bg-surface-dark rounded-3xl p-8 shadow-2xl w-full max-w-md mx-auto relative overflow-hidden group border border-white/50 dark:border-emerald-800">
                    <div
                        class="absolute top-0 right-0 w-24 h-24 bg-linear-to-bl from-primary/10 to-transparent rounded-bl-3xl">
                    </div>

                    <div class="relative z-10">
                        <div class="mb-8 text-center">
                            <div
                                class="w-16 h-16 bg-emerald-100 dark:bg-emerald-900/50 rounded-2xl flex items-center justify-center mx-auto mb-4 text-primary dark:text-emerald-400">
                                <span class="material-icons-round text-3xl">person_search</span>
                            </div>
                            <h2 class="text-2xl font-bold text-text-main-light dark:text-text-main-dark mb-2">Cek Rapor
                                Siswa</h2>
                            <p class="text-text-muted-light dark:text-text-muted-dark text-sm">Silakan lengkapi formulir
                                di bawah ini</p>
                        </div>

                        <form action="#" method="POST" class="space-y-6">
                            @csrf
                            <div class="space-y-2">
                                <label
                                    class="block text-sm font-semibold text-text-main-light dark:text-text-main-dark ml-1"
                                    for="nik">
                                    Nomor Induk Kependudukan (NIK)
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <span class="material-icons-round text-gray-400 text-xl">badge</span>
                                    </div>
                                    <input type="text" id="nik" name="nik" pattern="[0-9]{16}"
                                        placeholder="Contoh: 3507..." required
                                        title="Mohon masukkan 16 digit NIK yang valid"
                                        class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 dark:bg-emerald-900/30 border border-gray-200 dark:border-emerald-700 rounded-xl text-text-main-light dark:text-text-main-dark placeholder-gray-400 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none" />
                                </div>
                                <p
                                    class="text-xs text-text-muted-light dark:text-text-muted-dark ml-1 flex items-center gap-1">
                                    <span class="material-icons-round text-xs">info</span>
                                    Masukkan 16 digit angka sesuai Kartu Keluarga
                                </p>
                            </div>

                            <div
                                class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-emerald-900/20 rounded-lg border border-gray-100 dark:border-emerald-800/50">
                                <input type="checkbox" id="human"
                                    class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary" required />
                                <label for="human"
                                    class="text-sm text-text-muted-light dark:text-text-muted-dark select-none cursor-pointer">
                                    Saya bukan robot
                                </label>
                            </div>

                            <button type="submit"
                                class="w-full bg-slate-800 hover:bg-slate-700 dark:bg-emerald-600 dark:hover:bg-emerald-500 text-white font-semibold py-4 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2 group-invalid:opacity-50 group-invalid:pointer-events-none">
                                <span class="material-icons-round">search</span>
                                Lihat Hasil Belajar
                            </button>
                        </form>

                        <div class="mt-6 text-center">
                            <a href="#"
                                class="text-xs font-medium text-primary hover:text-emerald-600 dark:text-emerald-400 dark:hover:text-emerald-300 transition-colors underline decoration-2 decoration-transparent hover:decoration-current">
                                Lupa NIK? Hubungi Tata Usaha
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <div class="relative w-full h-24 z-10 mt-auto">
            <svg class="absolute bottom-0 w-full h-full text-white dark:text-[#111827] fill-current"
                preserveAspectRatio="none" viewBox="0 0 1440 320">
                <path
                    d="M0,224L80,213.3C160,203,320,181,480,181.3C640,181,800,203,960,202.7C1120,203,1280,181,1360,170.7L1440,160L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"
                    fill-opacity="1"></path>
            </svg>
        </div>
    </div>
</x-main-layout>
