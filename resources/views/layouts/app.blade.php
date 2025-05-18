<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jester</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
    <link rel="stylesheet" href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
</head>

<body class="bg-white min-h-screen">
    <nav class="bg-gray-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-0">
            <div class="flex justify-between items-center py-4">
                <a href="#" class="font-bold text-xl">Jester Production</a>

                <div class="hidden md:flex gap-6 items-center uppercase text-sm">
                    <a href="{{ route('index') }}"
                        class="text-gray-900 hover:text-black transition duration-300 hover:scale-105">Portfolio</a>
                    <a href="{{ route('about') }}"
                        class="text-gray-900 hover:text-black transition duration-300 hover:scale-105">About</a>
                    <a href="{{ route('contact') }}"
                        class="text-gray-900 hover:text-black transition duration-300 hover:scale-105">Contact</a>
                    <a href="https://instagram.com/jes_production" target="_blank"
                        class="font-extralight text-gray-500 hover:text-black transition duration-300 hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                            class="bi bi-instagram" viewBox="0 0 16 16">
                            <path
                                d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                        </svg>
                    </a>
                </div>

                <div class="md:hidden">
                    <button type="button"
                        class="text-gray-900 hover:text-black focus:outline-none transition-transform duration-300 active:scale-95"
                        id="mobile-menu-button">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="menu-icon">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="md:hidden max-h-0 overflow-hidden transition-all duration-500 ease-in-out" id="mobile-menu">
                <div class="flex flex-col gap-4 uppercase text-sm pb-4">
                    <a href="{{ route('index') }}"
                        class="block px-3 py-2 text-gray-900 hover:text-black transition duration-300 hover:bg-gray-50 rounded transform hover:translate-x-1">Portfolio</a>
                    <a href="{{ route('about') }}"
                        class="block px-3 py-2 text-gray-900 hover:text-black transition duration-300 hover:bg-gray-50 rounded transform hover:translate-x-1">About</a>
                    <a href="route('contact')"
                        class="block px-3 py-2 text-gray-900 hover:text-black transition duration-300 hover:bg-gray-50 rounded transform hover:translate-x-1">Contact</a>
                    <a href="https://instagram.com/jes_production" target="_blank"
                        class="md:block px-3 py-2 font-extralight text-gray-500 hover:text-black transition duration-300 flex items-center gap-2 hover:bg-gray-50 rounded transform hover:translate-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                            class="bi bi-instagram" viewBox="0 0 16 16">
                            <path
                                d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                        </svg>
                        Instagram
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto">
        @yield('content')
    </div>

    <footer class="text-center py-6">
        <p class="text-xs md:text-sm text-gray-500 font-extralight">Made by Syahreza Satria Alfath © Jester Production
            2025
        </p>
    </footer>

    <script>
        // Toggle mobile menu with animation
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            const icon = document.getElementById('menu-icon');

            // Toggle menu
            if (menu.classList.contains('max-h-0')) {
                menu.classList.remove('max-h-0');
                menu.classList.add('max-h-96'); // Adjust this value based on your content height
                icon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />'; // X icon
            } else {
                menu.classList.add('max-h-0');
                menu.classList.remove('max-h-96');
                icon.innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />'; // Hamburger icon
            }
        });
    </script>
    @yield('scripts')
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
</body>

</html>
