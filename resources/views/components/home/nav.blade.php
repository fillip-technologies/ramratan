<nav x-data="{ mobileMenu: false }"
    class="flex items-center justify-between px-6 md:px-12 py-4 bg-white shadow-sm sticky top-0 z-50">

    <!-- Logo -->
    <a href="/" class="text-3xl font-serif text-rose-500 font-bold cursor-pointer">
        <img src="/images/ramratan.png" class="h-14" />
    </a>

    <!-- Mobile Menu Button -->
    <div class="md:hidden">
        <button @click="mobileMenu = !mobileMenu" class="text-gray-700 focus:outline-none">
            <i class="fas fa-bars text-2xl"></i>
        </button>
    </div>

    <!-- Desktop Search -->
    <div class="hidden md:block flex-1 max-w-xl mx-6 relative">
        <x-home.search-bar />
    </div>

    <!-- Desktop Icons -->
    <div class="hidden md:flex items-center space-x-6 text-gray-700 pr-6">
        <!-- Account -->
        @if (Auth::check())
            <!-- User is logged in -->
            <a href="{{ route('account-overview') }}"
                class="relative flex flex-col items-center hover:text-pink-500 transition">
                <i class="far fa-user text-lg"></i>
                <span class="mt-1 text-xs md:text-sm">Account</span>
            </a>
        @else
            <!-- User is not logged in -->
            <a href="{{ route('login') }}"
                class="relative flex flex-col items-center hover:text-pink-500 transition">
                <i class="far fa-user text-lg"></i>
                <span class="mt-1 text-xs md:text-sm">Sign In</span>
            </a>
        @endif
        <a href="{{ route('wishlist') }}" class="relative flex flex-col items-center hover:text-pink-500 transition">
            <i class="far fa-heart text-lg"></i>
            <span class="mt-1 text-xs md:text-sm">Wishlist</span>
            <div
                class="absolute -top-2 -right-2 bg-pink-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                {{ App\Models\WishList::where('user_id',auth()->id())->count() }}
            </div>
        </a>
        <a href="{{ route('cart') }}" class="relative flex flex-col items-center hover:text-pink-500 transition">
            <i class="fas fa-shopping-cart text-lg"></i>
            <span class="mt-1 text-xs md:text-sm">Cart</span>
            <div
                class="absolute -top-2 -right-5 bg-pink-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                {{ App\Models\CartItem::where('user_id', Auth::id())->count() }}
            </div>
        </a>
    </div>
    <div x-show="mobileMenu" x-transition class="absolute top-full left-0 w-full bg-white shadow-md md:hidden z-40">
        <div class="px-6 py-4 border-b relative overflow-visible">
            <x-home.search-bar />
        </div>

        <!-- Mobile Links -->
        <div class="flex justify-around px-6 py-4 text-gray-700">
            <a href="{{ route('account-overview') }}" class="flex flex-col items-center hover:text-pink-500">
                <i class="far fa-user text-lg"></i>
                <span class="text-xs">Account</span>
            </a>
            <a href="{{ route('wishlist') }}" class="flex flex-col items-center hover:text-pink-500 relative">
                <i class="far fa-heart text-lg"></i>
                <span class="text-xs">Wishlist</span>
                <div
                    class="absolute -top-2 -right-2 bg-pink-600 text-white text-xs font-bold rounded-full h-4 w-4 flex items-center justify-center">
                    5</div>
            </a>
            <a href="{{ route('cart') }}" class="flex flex-col items-center hover:text-pink-500 relative">
                <i class="fas fa-shopping-cart text-lg"></i>
                <span class="text-xs">Cart</span>
                <div
                    class="absolute -top-2 -right-4 bg-pink-600 text-white text-xs font-bold rounded-full h-4 w-4 flex items-center justify-center">
                    1</div>
            </a>
        </div>
    </div>

</nav>
