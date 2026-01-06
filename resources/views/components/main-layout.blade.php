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
    <x-navbar />
    <x-header />
    <main>
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
