<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Parent Registration - KuloSehat</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons&display=block" rel="stylesheet">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round&display=block" rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=block"
        rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-body bg-kulo-gradient min-h-screen flex flex-col selection:bg-green-200 selection:text-green-900 overflow-x-hidden transition-colors duration-300">

    {{-- <header class="w-full px-4 pt-6 z-50">
        <nav
            class="max-w-6xl mx-auto bg-white/90 dark:bg-gray-800/90 backdrop-blur-md rounded-full px-6 py-3 shadow-lg flex justify-between items-center transition-colors duration-300">
            <div class="hidden md:flex items-center space-x-6">
                <a class="text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-primary transition"
                    href="#">Beranda</a>
                <div class="relative group">
                    <button
                        class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-primary transition">
                        Kategori <span class="material-icons-round text-sm ml-1">expand_more</span>
                    </button>
                </div>
                <a class="text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-primary transition"
                    href="#">Artikel</a>
            </div>

            <button class="md:hidden text-gray-700 dark:text-gray-200">
                <span class="material-icons-round">menu</span>
            </button>

            <a class="text-xl font-bold text-gray-800 dark:text-white flex items-center gap-1" href="#">
                <span class="text-primary">Kulo</span>Sehat
            </a>

            <div class="hidden md:block w-24"></div>
        </nav>
    </header> --}}

    <main class="grow flex items-center justify-center relative px-4 py-12">
        {{ $slot }}
    </main>

</body>

</html>
