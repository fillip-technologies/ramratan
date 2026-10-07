<footer class="bg-gradient-to-r from-rose-50 via-pink-100 to-rose-50 text-gray-800 pt-14 pb-8 border-t border-rose-200">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-10">


        <div>
            <div class="flex items-start mb-4 -ml-3">
                <img src="/images/ramratan.png" class="h-12" alt="Brand Logo" />
            </div>
            <p class="text-gray-600 text-sm leading-relaxed">
                Crafting <span class="text-pink-600 font-medium">timeless jewellery</span> with elegance and precision —
                designed to make every moment truly special.
            </p>
        </div>

        <div>
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Links</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ url('/') }}" class="hover:text-pink-600 transition">Home</a></li>
                <li><a href="{{ route('view-product') }}#shop" class="hover:text-pink-600 transition">Shop</a></li>
                <li><a href="{{ route('about') }}" class="hover:text-pink-600 transition">About</a></li>
                <li><a href="#" class="hover:text-pink-600 transition">Contact</a></li>
            </ul>
        </div>

        <div>
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Customer Service</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ url('/') }}#faqs" class="hover:text-pink-600 transition">FAQs</a></li>
                <li><a href="#" class="hover:text-pink-600 transition">Shipping & Returns</a></li>
                <li><a href="#" class="hover:text-pink-600 transition">Privacy Policy</a></li>
                <li><a href="#" class="hover:text-pink-600 transition">Terms & Conditions</a></li>
            </ul>
        </div>

        <div>
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Us</h3>
            <ul class="space-y-3 text-sm">
                <li class="flex items-start">
                    <i class="fa-solid fa-location-dot text-pink-600 w-5 text-lg mt-1"></i>
                    <span class="ml-3">123, Jewellery Street, Patna, Bihar</span>
                </li>
                <li class="flex items-center">
                    <i class="fa-solid fa-phone text-pink-600 w-5 text-lg"></i>
                    <span class="ml-3">+91 98765 43210</span>
                </li>
                <li class="flex items-center">
                    <i class="fa-solid fa-envelope text-pink-600 w-5 text-lg"></i>
                    <span class="ml-3">support@yourbrand.com</span>
                </li>
            </ul>

            <div class="flex space-x-4 mt-5">
                <a href="#"
                    class="w-9 h-9 flex items-center justify-center rounded-full bg-white shadow hover:bg-pink-50 transition">
                    <i class="fab fa-facebook-f text-pink-600"></i>
                </a>
                <a href="#"
                    class="w-9 h-9 flex items-center justify-center rounded-full bg-white shadow hover:bg-pink-50 transition">
                    <i class="fab fa-instagram text-pink-600"></i>
                </a>
                <a href="#"
                    class="w-9 h-9 flex items-center justify-center rounded-full bg-white shadow hover:bg-pink-50 transition">
                    <i class="fab fa-twitter text-pink-600"></i>
                </a>
            </div>
        </div>

    </div>


    <div class="border-t border-rose-200 mt-12 pt-6 text-center text-sm text-gray-500">
        <div class="mb-1"> © 2025 <span class="font-medium text-pink-600">Ramratan</span>. All Rights Reserved.</div>
        <div>
            Design and Developed by <a href="https://filliptechnologies.com/"
                class="text-pink-600 hover:underline">Fillip
                Technologies</a>
        </div>
    </div>
</footer>
