@php
    $wishlistCount = Auth::check() ? App\Models\WishList::where('user_id', Auth::id())->count() : 0;
    $cartCount = Auth::check() ? App\Models\CartItem::where('user_id', Auth::id())->count() : 0;
@endphp

<nav x-data="{ mobileMenu: false }"
    class="relative flex items-center justify-between px-4 sm:px-6 md:px-10 lg:px-12 py-2 md:py-2.5 bg-transparent">

    <!-- Logo -->
    <a href="/" class="flex items-center transition-opacity hover:opacity-90">
        <img src="/images/ramratan.png" alt="Ramratan Jewellers" class="h-9 md:h-10 w-auto object-contain" />
    </a>

    <!-- Desktop Search -->
    <div class="hidden md:block flex-1 max-w-md lg:max-w-lg mx-4 lg:mx-8 relative">
        <x-home.search-bar />
    </div>

    <!-- Desktop Icons -->
    <div class="hidden md:flex items-center space-x-6 lg:space-x-8 text-gray-700">
        <!-- Account -->
        @if (Auth::check())
            <a href="{{ route('account-overview') }}"
                class="group flex flex-col items-center text-gray-700 hover:text-rose-600 transition-colors duration-200">
                <i class="far fa-user text-base lg:text-[17px] group-hover:scale-110 transition-transform duration-200"></i>
                <span class="mt-0.5 text-[10px] lg:text-[11px] font-medium tracking-wider uppercase text-gray-600 group-hover:text-rose-600">Account</span>
            </a>
        @else
            <a href="{{ route('login') }}"
                class="group flex flex-col items-center text-gray-700 hover:text-rose-600 transition-colors duration-200">
                <i class="far fa-user text-base lg:text-[17px] group-hover:scale-110 transition-transform duration-200"></i>
                <span class="mt-0.5 text-[10px] lg:text-[11px] font-medium tracking-wider uppercase text-gray-600 group-hover:text-rose-600">Sign In</span>
            </a>
        @endif

        <!-- Wishlist -->
        <a href="{{ route('wishlist') }}"
            class="group flex flex-col items-center text-gray-700 hover:text-rose-600 transition-colors duration-200">
            <div class="relative">
                <i class="far fa-heart text-base lg:text-[17px] group-hover:scale-110 transition-transform duration-200"></i>
                @if ($wishlistCount > 0)
                    <span class="absolute -top-1.5 -right-2.5 bg-gradient-to-r from-rose-500 to-pink-600 text-white text-[10px] font-bold rounded-full h-4 min-w-[16px] px-1 flex items-center justify-center shadow-sm ring-1 ring-white">
                        {{ $wishlistCount }}
                    </span>
                @endif
            </div>
            <span class="mt-0.5 text-[10px] lg:text-[11px] font-medium tracking-wider uppercase text-gray-600 group-hover:text-rose-600">Wishlist</span>
        </a>

        <!-- Cart -->
        <a href="{{ route('cart') }}"
            class="group flex flex-col items-center text-gray-700 hover:text-rose-600 transition-colors duration-200">
            <div class="relative">
                <i class="fas fa-shopping-cart text-base lg:text-[17px] group-hover:scale-110 transition-transform duration-200"></i>
                @if ($cartCount > 0)
                    <span class="absolute -top-1.5 -right-2.5 bg-gradient-to-r from-rose-500 to-pink-600 text-white text-[10px] font-bold rounded-full h-4 min-w-[16px] px-1 flex items-center justify-center shadow-sm ring-1 ring-white">
                        {{ $cartCount }}
                    </span>
                @endif
            </div>
            <span class="mt-0.5 text-[10px] lg:text-[11px] font-medium tracking-wider uppercase text-gray-600 group-hover:text-rose-600">Cart</span>
        </a>
    </div>

    <!-- Mobile Header Actions (Cart Quick Access + Menu Toggle) -->
    <div class="md:hidden flex items-center space-x-1.5">
        <a href="{{ route('cart') }}" class="relative p-2 text-gray-700 hover:text-rose-600 transition" aria-label="Shopping Cart">
            <i class="fas fa-shopping-cart text-lg"></i>
            @if ($cartCount > 0)
                <span class="absolute top-0.5 right-0.5 bg-gradient-to-r from-rose-500 to-pink-600 text-white text-[9px] font-bold rounded-full h-3.5 min-w-[14px] px-0.5 flex items-center justify-center ring-1 ring-white">
                    {{ $cartCount }}
                </span>
            @endif
        </a>
        <button @click="mobileMenu = !mobileMenu"
                class="p-2 text-gray-700 hover:text-rose-600 focus:outline-none transition rounded-lg hover:bg-rose-50/60"
                aria-label="Toggle navigation menu">
            <i class="fas text-xl" :class="mobileMenu ? 'fa-times' : 'fa-bars'"></i>
        </button>
    </div>

    <!-- Mobile Menu Drawer -->
    <div x-show="mobileMenu"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         @click.away="mobileMenu = false"
         class="absolute top-full left-0 w-full bg-white shadow-2xl border-b border-gray-200 md:hidden z-40 max-h-[80vh] overflow-y-auto">

        <!-- Mobile Search -->
        <div class="px-4 py-3 border-b border-gray-100">
            <x-home.search-bar />
        </div>

        <!-- Mobile Navigation Shortcuts -->
        <div class="grid grid-cols-3 gap-2 px-4 py-3 border-b border-gray-100 bg-stone-50/50">
            <a href="{{ Auth::check() ? route('account-overview') : route('login') }}"
               class="flex flex-col items-center py-2 px-1 text-gray-700 hover:text-rose-600 rounded-lg hover:bg-white transition">
                <i class="far fa-user text-base mb-1"></i>
                <span class="text-[11px] font-medium">{{ Auth::check() ? 'Account' : 'Sign In' }}</span>
            </a>
            <a href="{{ route('wishlist') }}"
               class="flex flex-col items-center py-2 px-1 text-gray-700 hover:text-rose-600 rounded-lg hover:bg-white transition relative">
                <div class="relative">
                    <i class="far fa-heart text-base mb-1"></i>
                    @if ($wishlistCount > 0)
                        <span class="absolute -top-1 -right-2 bg-gradient-to-r from-rose-500 to-pink-600 text-white text-[9px] font-bold rounded-full h-3.5 min-w-[14px] px-0.5 flex items-center justify-center">
                            {{ $wishlistCount }}
                        </span>
                    @endif
                </div>
                <span class="text-[11px] font-medium">Wishlist</span>
            </a>
            <a href="{{ route('cart') }}"
               class="flex flex-col items-center py-2 px-1 text-gray-700 hover:text-rose-600 rounded-lg hover:bg-white transition relative">
                <div class="relative">
                    <i class="fas fa-shopping-cart text-base mb-1"></i>
                    @if ($cartCount > 0)
                        <span class="absolute -top-1 -right-2 bg-gradient-to-r from-rose-500 to-pink-600 text-white text-[9px] font-bold rounded-full h-3.5 min-w-[14px] px-0.5 flex items-center justify-center">
                            {{ $cartCount }}
                        </span>
                    @endif
                </div>
                <span class="text-[11px] font-medium">Cart</span>
            </a>
        </div>

        <!-- Mobile Categories -->
        <div class="py-2 px-3 divide-y divide-gray-50">
            <p class="px-3 pt-2 pb-1 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Collections & Categories</p>
            @foreach (App\Models\Category::with('subcate')->get() as $cat)
                <div x-data="{ subOpen: false }" class="py-0.5">
                    <div class="flex items-center justify-between px-3 py-2 text-sm text-gray-700 hover:text-rose-600 rounded-lg cursor-pointer transition"
                         @click="subOpen = !subOpen">
                        <span class="font-medium text-xs uppercase tracking-wide">{{ $cat->name }}</span>
                        @if ($cat->subcate->count() > 0)
                            <i class="fas fa-chevron-down text-[10px] transition-transform duration-200"
                               :class="subOpen ? 'rotate-180 text-rose-500' : 'text-gray-400'"></i>
                        @endif
                    </div>
                    @if ($cat->subcate->count() > 0)
                        <div x-show="subOpen" x-cloak class="pl-5 pr-2 py-1 space-y-1 bg-stone-50/70 rounded-lg my-1">
                            @foreach ($cat->subcate as $sub)
                                <a href="{{ route('sub.product.data', $sub->category_id) }}"
                                   class="block py-1.5 px-2 text-xs text-gray-600 hover:text-rose-600 hover:bg-white rounded transition">
                                    {{ $sub->name }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

</nav>
