<!DOCTYPE html>
<html lang="id" class="overflow-y-scroll">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>SDN Merjoyo Dashboard</title>
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
