<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pemeliharaan Sistem - SD Negeri Merjoyo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap');

        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">
    <div class="bg-white p-8 rounded-2xl shadow-xl max-w-lg w-full text-center border-b-4 border-green-500">

        {{-- Ikon / Ilustrasi --}}
        <div class="mb-6 flex justify-center">
            <div class="bg-green-100 p-4 rounded-full">
                <svg class="w-16 h-16 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                    </path>
                </svg>
            </div>
        </div>

        <h1 class="text-3xl font-bold text-gray-800 mb-3">Sistem Sedang Diupdate</h1>

        <p class="text-gray-600 mb-6 leading-relaxed">
            Mohon maaf, Website SD Negeri Merjoyo sedang dalam pemeliharaan rutin untuk meningkatkan performa.
            <br>Silakan kembali lagi nanti.
        </p>

        @if ($exception->getMessage())
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mb-6">
                <p class="text-yellow-800 text-sm font-semibold">
                    Info: {{ $exception->getMessage() }}
                </p>
            </div>
        @endif

        <div class="text-xs text-gray-400 mt-4">
            &copy; {{ date('Y') }} Tim IT SD Negeri Merjoyo
        </div>
    </div>
</body>

</html>
