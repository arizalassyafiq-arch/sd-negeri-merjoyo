<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>SDN Merjoyo Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#4ADE80",
                        secondary: "#22C55E",
                        "background-light": "#FFFFFF",
                        "background-dark": "#111827",
                        "surface-light": "#F3F4F6",
                        "surface-dark": "#1F2937",
                        "text-primary-light": "#1F2937",
                        "text-primary-dark": "#F9FAFB",
                        "text-secondary-light": "#4B5563",
                        "text-secondary-dark": "#D1D5DB",
                    },
                    fontFamily: {
                        display: ["Poppins", "sans-serif"],
                        body: ["Poppins", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.5rem",
                        'xl': '1rem',
                        '2xl': '1.5rem',
                        '3xl': '2rem',
                    },
                    backgroundImage: {
                        'chat-pattern': "radial-gradient(#CBD5E1 1px, transparent 1px)",
                        'chat-pattern-dark': "radial-gradient(#374151 1px, transparent 1px)",
                    },
                    // PINDAHKAN KE SINI
                    animation: {
                        blob: "blob 7s infinite",

                    },
                    keyframes: {
                        blob: {
                            "0%": {
                                transform: "translate(0px, 0px) scale(1)",
                            },
                            "33%": {
                                transform: "translate(30px, -50px) scale(1.1)",
                            },
                            "66%": {
                                transform: "translate(-20px, 20px) scale(0.9)",
                            },
                            "100%": {
                                transform: "translate(0px, 0px) scale(1)",
                            },
                        },
                    },
                },
            },
        };
    </script>
    <style>
        .wave-separator {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
        }

        .wave-separator svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 150px;
        }

        .wave-separator .shape-fill {
            fill: #FFFFFF;
        }

        .dark .wave-separator .shape-fill {
            fill: #111827;
        }

        .wave-top {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            background: linear-gradient(135deg, #86EFAC 0%, #22C55E 100%);
            clip-path: polygon(0 0, 100% 0, 100% 75%, 0 100%);
        }

        .custom-curve-bg {
            background-color: #4ade80;
            background-image:
                radial-gradient(at 0% 0%, hsla(141, 72%, 60%, 1) 0, transparent 50%),
                radial-gradient(at 50% 0%, hsla(152, 81%, 43%, 1) 0, transparent 50%),
                radial-gradient(at 100% 0%, hsla(180, 100%, 40%, 1) 0, transparent 50%);
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 0;
            height: 100%;
        }

        @keyframes pulse-expand {
            0% {
                transform: scale(0.6);
                opacity: 0;
            }

            50% {
                opacity: 0.6;
            }

            100% {
                transform: scale(1.4);
                opacity: 0;
            }
        }

        .animate-pulse-expand {
            animation: pulse-expand 4s infinite ease-out;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .bg-pattern-dots {
            background-size: 20px 20px;
        }

        .chat-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .chat-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .chat-scroll::-webkit-scrollbar-thumb {
            background-color: rgba(156, 163, 175, 0.5);
            border-radius: 20px;
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark font-body antialiased transition-colors duration-300 min-h-screen flex flex-col">
    <nav class="fixed w-full z-50 top-6 px-4 sm:px-8">
        <div
            class="max-w-7xl mx-auto bg-white/90 dark:bg-surface-dark/90 backdrop-blur-md rounded-full shadow-lg px-8 py-4 flex flex-col md:flex-row justify-between items-center transition-all duration-300 gap-4 md:gap-0">
            <div class="flex items-center w-full md:w-auto justify-between md:justify-start space-x-8">
                <div class="flex items-center space-x-6">
                    <a class="text-text-primary-light dark:text-text-primary-dark font-medium hover:text-primary transition-colors"
                        href="#">Beranda</a>
                    <a class="text-text-primary-light dark:text-text-primary-dark font-medium hover:text-primary transition-colors"
                        href="#">Artikel</a>
                    <a class="text-text-primary-light dark:text-text-primary-dark font-medium hover:text-primary transition-colors"
                        href="#">Cari Siswa</a>
                    <button
                        class="text-text-primary-light dark:text-text-primary-dark font-medium hover:text-primary transition-colors flex items-center gap-1 focus:outline-none"
                        onclick="toggleChat()">
                        Diskusi
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                        </span>
                    </button>
                </div>
                <div class="flex md:hidden items-center text-primary">
                    <span class="material-icons">school</span>
                </div>
            </div>
            <div class="hidden md:flex items-center space-x-4 shrink-0">
                <button
                    class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-300 transition-colors"
                    onclick="document.documentElement.classList.toggle('dark')">
                    <span class="material-icons dark:hidden">dark_mode</span>
                    <span class="material-icons hidden dark:block">light_mode</span>
                </button>
                <div class="flex items-center font-bold text-xl text-primary">
                    <span class="material-icons mr-2">school</span>
                    SDN Merjoyo
                </div>
            </div>
        </div>
    </nav>
    <header class="relative pt-40 pb-40 overflow-hidden min-h-[90vh] flex items-center">
        <div class="custom-curve-bg"></div>
        <div class="absolute bottom-0 left-0 w-full overflow-hidden">
            <svg class="relative block w-full h-20 md:h-37.5" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V0C45.3,33.47,105.9,62.18,171.19,68.82,217.39,73.52,268.93,66.2,321.39,56.44Z"
                    class="fill-background-light dark:fill-background-dark"></path>
            </svg>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <span
                        class="inline-block py-1 px-3 rounded-full bg-white/20 dark:bg-black/20 text-gray-800 dark:text-white text-sm font-semibold backdrop-blur-sm border border-white/30">
                        Temukan Informasi Capaian Pembelajaran Siswa
                    </span>
                    <h1 class="text-4xl lg:text-6xl font-bold text-gray-900 dark:text-white leading-tight">
                        Mari Bergabung <br />
                        <span class="text-green-800 dark:text-green-300">Bersama Kami</span>
                    </h1>
                    <p class="text-lg text-gray-800 dark:text-gray-100 max-w-lg leading-relaxed font-medium">
                        Selamat datang di SDN Merjoyo. Website ini menyajikan artikel seputar kegiatan sekolah serta
                        pemantauan pencapaian siswa untuk mendukung proses pembelajaran yang transparan dan berkualitas.
                    </p>
                    <div class="pt-4 flex flex-wrap gap-4">
                        <button
                            class="bg-gray-800 hover:bg-gray-900 text-white dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200 font-semibold py-3 px-8 rounded-lg shadow-lg transform transition hover:-translate-y-1 hover:shadow-xl">
                            Login Siswa
                        </button>
                    </div>
                </div>
                <div class="relative flex justify-center lg:justify-end">
                    <div
                        class="absolute -top-10 -right-10 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob">
                    </div>
                    <div
                        class="absolute -bottom-10 -left-10 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob">
                    </div>
                    <div class="relative z-10 w-full max-w-md">
                        <div class="relative mb-8">
                            <div
                                class="bg-white dark:bg-surface-dark p-4 rounded-3xl shadow-2xl transform rotate-2 hover:rotate-0 transition-transform duration-500">
                                <img alt="Kepala Sekolah SDN Merjoyo" class="rounded-2xl w-full h-64 object-cover mb-4"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAPp5IppDO5tMbR2IxnaTSkKirvig_A4lKIH1QJVQUPaRubatVtG2zfo0XiQnFzmsmtP8KWG4jTDisXcZ3BDI6v87IxXFgljM_vsvpfU99RJ5ENiK7Xt1DH0C4aPTWzTFS8oq0m7orA_wzG1N_xzG-EYp5iG3DIVOCjl8hhW-2h_q9Pcd2qe9mEXRDSJWNuTbUhHfohcvr62ZrkUfbAAk8TwBQWuPxriWs4_z8S7PNb1oxgu1Rnkq8tdum-II66lnZosfHJjoHk5zQI" />
                                <div class="flex items-center gap-4">
                                    <div class="bg-primary/20 p-3 rounded-full text-primary">
                                        <span class="material-icons">school</span>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-text-primary-light dark:text-text-primary-dark">Bpk.
                                            H. Suwandi, M.Pd</h3>
                                        <p class="text-sm text-text-secondary-light dark:text-text-secondary-dark">
                                            Kepala Sekolah SDN Merjoyo</p>
                                    </div>
                                </div>
                            </div>
                            <div class=" absolute bottom-16 right-6 bg-white dark:bg-surface-dark p-4 rounded-xl shadow-lg flex items-center gap-3 animate-bounce"
                                style="animation-duration: 3s;">
                                <div
                                    class="bg-yellow-100 dark:bg-yellow-900 p-2 rounded-lg text-yellow-600 dark:text-yellow-400">
                                    <span class="material-icons">star</span>
                                </div>
                                <div>
                                    <p
                                        class="text-xs text-text-secondary-light dark:text-text-secondary-dark font-medium">
                                        Akreditasi</p>
                                    <p class="font-bold text-text-primary-light dark:text-text-primary-dark">A (Unggul)
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="bg-white/60 dark:bg-surface-dark/60 backdrop-blur-md p-6 rounded-2xl shadow-lg border-l-4 border-primary mt-14">
                            <h4 class="font-bold text-gray-900 dark:text-white mb-2 text-lg flex items-center">
                                <span class="material-icons text-primary mr-2 text-sm">info</span>
                                Tentang Sekolah
                            </h4>
                            <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                SDN Merjoyo adalah institusi pendidikan yang berdedikasi tinggi dalam membentuk karakter
                                siswa yang mandiri, kreatif, dan berakhlak mulia melalui lingkungan belajar yang
                                kondusif.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="grow relative z-20 bg-background-light dark:bg-background-dark  mt-20 pb-20">
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
    <footer class="bg-primary dark:bg-green-800 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8 text-green-900 dark:text-green-100">
                <div class="col-span-1 md:col-span-1">
                    <div class="flex items-center font-bold text-2xl mb-4">
                        <span class="material-icons mr-2">school</span>
                        SDN Merjoyo
                    </div>
                    <p class="text-sm opacity-80 text-justify">
                        Jalan Merjoyo No. 123, <br />
                        Kecamatan Lowokwaru, <br />
                        Kota Malang, Jawa Timur
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
                    <ul class="text-sm opacity-90 text-justify">menyajikan artikel seputar kegiatan sekolah serta
                        pemantauan
                        pencapaian
                        siswa untuk mendukung
                        proses pembelajaran yang transparan dan berkualitas.</ul>
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
            <div
                class="border-t border-green-700/30 pt-8 text-center text-sm text-green-900/60 dark:text-green-100/60">
                © 2024 SDN Merjoyo. Hak Cipta Dilindungi.
            </div>
        </div>
    </footer>
    <div aria-modal="true" class="fixed inset-0 z-[100] hidden" id="chatModal" role="dialog">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity opacity-0" id="chatBackdrop"
            onclick="toggleChat()"></div>
        <div class="absolute bottom-0 sm:bottom-auto sm:top-1/2 sm:left-1/2 sm:-translate-x-1/2 sm:-translate-y-1/2 w-full sm:w-[500px] h-[85vh] sm:h-[650px] bg-white dark:bg-surface-dark sm:rounded-2xl shadow-2xl flex flex-col overflow-hidden transition-all duration-300 transform translate-y-full sm:translate-y-0 sm:scale-95 opacity-0"
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
    <script>
        function toggleChat() {
            const modal = document.getElementById('chatModal');
            const backdrop = document.getElementById('chatBackdrop');
            const container = document.getElementById('chatContainer');
            if (modal.classList.contains('hidden')) {
                // Open
                modal.classList.remove('hidden');
                // Allow display block to render before opacity transition
                setTimeout(() => {
                    backdrop.classList.remove('opacity-0');
                    container.classList.remove('translate-y-full', 'scale-95', 'opacity-0');
                }, 10);
                document.body.style.overflow = 'hidden'; // Prevent scrolling background
            } else {
                // Close
                backdrop.classList.add('opacity-0');
                container.classList.add('translate-y-full', 'scale-95', 'opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden');
                    document.body.style.overflow = '';
                }, 300); // Match transition duration
            }
        }
    </script>

</body>

</html>
