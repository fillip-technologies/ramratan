<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
      <script src="https://cdn.tailwindcss.com"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=JetBrains+Mono&display=swap"
        rel="stylesheet" />

    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        a,
        li,
        button,
        input,
        textarea {
            font-family: 'Poppins', sans-serif !important;
        }
    </style>
</head>

<body class="m-0 p-0 overflow-x-hidden scroll-smooth">

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @include('partials.forget-password')


    <div id="whatsappBtn" class="fixed bottom-6 left-6 z-50 hidden">
        <a href="https://wa.me/919999999999" target="_blank"
            class="text-green-600 text-4xl hover:text-6xl transition-all duration-300 ease-in-out">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>

    <div id="scrollToTop" class="fixed bottom-6 right-6 z-50 hidden">
        <button onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
            class="bg-pink-200 hover:bg-pink-700 hover:text-pink-200 text-pink-700 text-base md:text-lg sm:px-4 sm:py-2  px-3 py-1.5 rounded-full shadow-lg transition duration-300">
            <i class="fas fa-arrow-up"></i>
        </button>
    </div>

    <!-- Script to Show/Hide on Scroll -->
    <script>
        const scrollToTopBtn = document.getElementById("scrollToTop");
        const whatsappBtn = document.getElementById("whatsappBtn");

        window.addEventListener("scroll", () => {
            if (window.scrollY > 200) {
                scrollToTopBtn.classList.remove("hidden");
                whatsappBtn.classList.remove("hidden");
            } else {
                scrollToTopBtn.classList.add("hidden");
                whatsappBtn.classList.add("hidden");
            }
        });
    </script>

    <!-- Script for the enquiry form -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('forgotPasswordBtn');
            const modal = document.getElementById('forgotPasswordModal');
            const closeBtn = document.getElementById('closeForgotPassword');

            if (!btn || !modal || !closeBtn) return;

            btn.addEventListener('click', (e) => {
                e.preventDefault();
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });


            closeBtn.addEventListener('click', () => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            });

            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            });
        });
    </script>



</body>

</html>
