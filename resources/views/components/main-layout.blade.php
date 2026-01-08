<!DOCTYPE html>
<html lang="id" class="overflow-y-scroll">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>SDN Merjoyo Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="bg-background-light dark:bg-background-dark font-body antialiased transition-colors duration-300 min-h-screen flex flex-col">
    <x-navbar />



    <main class="grow">
        {{ $slot }}
    </main>

    <x-footer />

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
