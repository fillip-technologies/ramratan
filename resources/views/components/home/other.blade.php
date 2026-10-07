{{-- <div class="bg-rose-300 text-center p-2 text-gray-700 font-serif">Get 20% discount on the first order</div> --}}

<div class="h-screen flex flex-col">
    <div class="relative z-50">

        <!-- Top bar -->
        <div class="bg-pink-200 text-center text-sm py-1.5 font-serif text-gray-800">
            Get 20% discount on the first order
        </div>

        <!-- Navbar -->
        <nav class="flex items-center justify-between px-8 py-4">
            <!-- Left: Logo -->
            <div class="flex items-center space-x-6">
                <h1 class="text-3xl font-serif text-rose-500">Ramratan JI</h1>

            </div>

            <!-- Search bar -->
            <div class="flex-1 max-w-xl mx-6">
                <div class="relative">
                    <div class="flex border border-gray-400 rounded-lg px-3 py-2 items-center">
                        <input id="searchInput" type="text" placeholder='Search "Necklace"'
                            class="flex-1 text-sm focus:outline-none bg-transparent" />
                        <button class="text-gray-500">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>

                    <!-- Dropdown -->
                    <div id="searchDropdown"
                        class="absolute left-0 w-full bg-white border border-gray-300 rounded-b-lg shadow-lg mt-1 hidden">

                        <div class="grid grid-cols-2 gap-4 p-4">
                            <!-- Suggestions -->
                            <div>
                                <h3 class="text-gray-500 text-sm mb-2">Suggestions</h3>
                                <ul class="space-y-2 text-gray-700 text-sm">
                                    <li class="hover:text-pink-500 cursor-pointer">diamond ring</li>
                                    <li class="hover:text-pink-500 cursor-pointer">silver diamond studs for men</li>
                                    <li class="hover:text-pink-500 cursor-pointer">lab grown diamonds ring</li>
                                    <li class="hover:text-pink-500 cursor-pointer">sui dhaaga</li>
                                    <li class="hover:text-pink-500 cursor-pointer">Next Day Delivery</li>
                                    <li class="hover:text-pink-500 cursor-pointer">CRED Dazzling Diwali</li>
                                    <li class="hover:text-pink-500 cursor-pointer">Diva Desire Collection</li>
                                </ul>
                            </div>

                            <!-- Products -->
                            <div>
                                <h3 class="text-gray-500 text-sm mb-2">Products</h3>
                                <ul class="space-y-4 text-sm">
                                    <li class="flex space-x-3 items-start">
                                        <img src="https://images.unsplash.com/photo-1573408301185-9146fe634ad0?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fGpld2VsbGVyeXxlbnwwfHwwfHx8MA%3D%3D"
                                            class="w-10 h-10 object-contain" />
                                        <div>
                                            <p>Rose Gold Dreamy Crush Dainty Stud Earrings</p>
                                            <p class="text-pink-600 font-semibold">₹1,299 <span
                                                    class="line-through text-gray-400 text-xs">₹1,999</span></p>
                                        </div>
                                    </li>
                                    <li class="flex space-x-3 items-start">
                                        <img src="https://images.unsplash.com/photo-1535632787350-4e68ef0ac584?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTl8fGpld2VsbGVyeXxlbnwwfHwwfHx8MA%3D%3D"
                                            class="w-10 h-10 object-contain" />
                                        <div>
                                            <p>Silver Zircon Drizzle Drop Earrings</p>
                                            <p class="text-pink-600 font-semibold">₹2,099 <span
                                                    class="line-through text-gray-400 text-xs">₹2,799</span></p>
                                        </div>
                                    </li>
                                    <li class="flex space-x-3 items-start">
                                        <img src="https://images.unsplash.com/photo-1603561591411-07134e71a2a9?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8cmluZ3xlbnwwfHwwfHx8MA%3D%3D"
                                            class="w-10 h-10 object-contain" />
                                        <div>
                                            <p>Silver Drizzle Drop Pendant with Box Chain</p>
                                            <p class="text-pink-600 font-semibold">₹2,399 <span
                                                    class="line-through text-gray-400 text-xs">₹3,599</span></p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="border-t px-4 py-2 text-sm text-gray-700 flex justify-between items-center">
                            <span>Search for “<span id="searchText"></span>”</span>
                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Right icons -->
            <div class="flex items-center space-x-6">

                <a href="#" class="flex flex-col items-center hover:text-pink-500 text-gray-700">
                    <i class="far fa-user"></i>
                    <span class="mt-1">ACCOUNT</span>
                </a>
                <a href="#" class="flex flex-col items-center hover:text-pink-500 text-gray-700">
                    <i class="far fa-heart "></i>
                    <span class="mt-1">WISHLIST</span>
                </a>
                <a href="#" class="flex flex-col items-center hover:text-pink-500 text-gray-700">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="mt-1">CART</span>
                </a>
            </div>


        </nav>

        <!-- Include Alpine.js -->
        <script src="https://unpkg.com/alpinejs" defer></script>

        <!-- Bottom navigation links with dropdowns -->
        <div class="flex justify-center space-x-8 py-3 text-lg font-light text-gray-700">

            <!-- Necklace -->
            <div x-data="{ open: false }" class="relative">
                <a href="#" @click.prevent="open = !open" class="flex items-center space-x-1 hover:text-pink-500">
                    <span>Necklace</span>
                    <i class="fas fa-chevron-down text-sm"></i>
                </a>

                <!-- Dropdown content -->
                <div x-show="open" @click.away="open = false" x-transition x-cloak
                    class="absolute top-full left-0 mt-2 w-48 bg-white shadow-lg border rounded z-50">
                    <a href="#" class="block px-4 py-2 hover:bg-pink-100">Gold Necklace</a>
                    <a href="#" class="block px-4 py-2 hover:bg-pink-100">Diamond Necklace</a>
                    <a href="#" class="block px-4 py-2 hover:bg-pink-100">Silver Necklace</a>
                </div>
            </div>

            <!-- Rings -->
            <div x-data="{ open: false }" class="relative">
                <a href="#" @click.prevent="open = !open" class="flex items-center space-x-1 hover:text-pink-500">
                    <span>Rings</span>
                    <i class="fas fa-chevron-down text-sm"></i>
                </a>

                <div x-show="open" @click.away="open = false" x-transition x-cloak
                    class="absolute top-full left-0 mt-2 w-48 bg-white shadow-lg border rounded z-50">
                    <a href="#" class="block px-4 py-2 hover:bg-pink-100">Gold Rings</a>
                    <a href="#" class="block px-4 py-2 hover:bg-pink-100">Diamond Rings</a>
                    <a href="#" class="block px-4 py-2 hover:bg-pink-100">Silver Rings</a>
                </div>
            </div>

            <!-- Ear Rings -->
            <div x-data="{ open: false }" class="relative">
                <a href="#" @click.prevent="open = !open" class="flex items-center space-x-1 hover:text-pink-500">
                    <span>Ear Rings</span>
                    <i class="fas fa-chevron-down text-sm"></i>
                </a>

                <div x-show="open" @click.away="open = false" x-transition x-cloak
                    class="absolute top-full left-0 mt-2 w-48 bg-white shadow-lg border rounded z-50">
                    <a href="#" class="block px-4 py-2 hover:bg-pink-100">Gold Ear Rings</a>
                    <a href="#" class="block px-4 py-2 hover:bg-pink-100">Diamond Ear Rings</a>
                    <a href="#" class="block px-4 py-2 hover:bg-pink-100">Silver Ear Rings</a>
                </div>
            </div>

            <!-- Pendants -->
            <div x-data="{ open: false }" class="relative">
                <a href="#" @click.prevent="open = !open"
                    class="flex items-center space-x-1 hover:text-pink-500">
                    <span>Pendants</span>
                    <i class="fas fa-chevron-down text-sm"></i>
                </a>

                <div x-show="open" @click.away="open = false" x-transition x-cloak
                    class="absolute top-full left-0 mt-2 w-48 bg-white shadow-lg border rounded z-50">
                    <a href="#" class="block px-4 py-2 hover:bg-pink-100">Gold Pendants</a>
                    <a href="#" class="block px-4 py-2 hover:bg-pink-100">Diamond Pendants</a>
                    <a href="#" class="block px-4 py-2 hover:bg-pink-100">Silver Pendants</a>
                </div>
            </div>

            <!-- Solitaires -->
            <div x-data="{ open: false }" class="relative">
                <a href="#" @click.prevent="open = !open"
                    class="flex items-center space-x-1 hover:text-pink-500">
                    <span>Solitaires</span>
                    <i class="fas fa-chevron-down text-sm"></i>
                </a>

                <div x-show="open" @click.away="open = false" x-transition x-cloak
                    class="absolute top-full left-0 mt-2 w-48 bg-white shadow-lg border rounded z-50">
                    <a href="#" class="block px-4 py-2 hover:bg-pink-100">Gold Solitaires</a>
                    <a href="#" class="block px-4 py-2 hover:bg-pink-100">Diamond Solitaires</a>
                    <a href="#" class="block px-4 py-2 hover:bg-pink-100">Silver Solitaires</a>
                </div>
            </div>

            <!-- Gold Coins -->
            <div x-data="{ open: false }" class="relative">
                <a href="#" @click.prevent="open = !open"
                    class="flex items-center space-x-1 hover:text-pink-500">
                    <span>Gold Coins</span>
                    <i class="fas fa-chevron-down text-sm"></i>
                </a>

                <div x-show="open" @click.away="open = false" x-transition x-cloak
                    class="absolute top-full left-0 mt-2 w-48 bg-white shadow-lg border rounded z-50">
                    <a href="#" class="block px-4 py-2 hover:bg-pink-100">22K Gold Coins</a>
                    <a href="#" class="block px-4 py-2 hover:bg-pink-100">24K Gold Coins</a>
                    <a href="#" class="block px-4 py-2 hover:bg-pink-100">Silver Coins</a>
                </div>
            </div>


        </div>

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>



    </div>

    <section x-data="{
        activeSlide: 0,
        slides: [{
                image: 'https://plus.unsplash.com/premium_photo-1724762183134-c17cf5f5bed2?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8bmVja2xlc3N8ZW58MHx8MHx8fDA%3D',
                heading: 'Educational Trip for Students',
                subheading: 'Learning Beyond the Classroom'
            },
            {
                image: 'https://images.unsplash.com/photo-1625627796701-e3c0911b89f3?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fG5lY2tsZXNzfGVufDB8fDB8fHww',
                heading: 'School Cultural Program',
                subheading: 'Celebrating Talent and Traditions'
            },
            {
                image: 'https://images.unsplash.com/photo-1650511266107-a4eff7631409?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTh8fG5lY2tsZXNzfGVufDB8fDB8fHww',
                heading: 'Annual School Examination',
                subheading: 'Assessing Knowledge and Growth'
            }
        ],
    
        startCarousel() {
            setInterval(() => {
                this.activeSlide = (this.activeSlide + 1) % this.slides.length;
            }, 5000);
        }
    }" x-init="startCarousel" class="relative z-0 w-full h-screen overflow-hidden">

        <!-- Carousel Images -->
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="activeSlide === index" x-transition:enter="transition-opacity duration-1000"
                x-transition:enter-start="opacity-60" x-transition:enter-end="opacity-100"
                class="absolute top-0 left-0 w-full h-full z-0">
                <img :src="slide.image" alt="Slide Image" class="w-full h-full object-cover">
            </div>
        </template>

        <!-- Dots / Controls -->
        <div class="absolute bottom-16 left-1/2 transform -translate-x-1/2 z-10 md:flex space-x-3 hidden">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="activeSlide = index" :class="activeSlide === index ? 'bg-white' : 'bg-white/50'"
                    class="w-3 h-3 rounded-full transition-all duration-300"></button>
            </template>
        </div>


    </section>
</div>



<script>
    const input = document.getElementById("searchInput");
    const dropdown = document.getElementById("searchDropdown");
    const searchText = document.getElementById("searchText");

    input.addEventListener("input", () => {
        if (input.value.trim() !== "") {
            dropdown.classList.remove("hidden");
            searchText.textContent = input.value;
        } else {
            dropdown.classList.add("hidden");
        }
    });
</script>
