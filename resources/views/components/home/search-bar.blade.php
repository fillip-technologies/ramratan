<div class="relative w-full search-container">
    <div class="flex items-center w-full bg-stone-50/80 hover:bg-white focus-within:bg-white border border-gray-200 hover:border-rose-300 focus-within:border-rose-400 focus-within:ring-2 focus-within:ring-rose-100/70 rounded-full px-3.5 py-1.5 transition-all duration-200 shadow-sm">
        <form action="{{ route('search.product') }}" method="GET" class="flex w-full items-center">
            <i class="fas fa-search text-gray-400 text-xs mr-2.5"></i>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search jewellery, rings, gold, diamonds..."
                autocomplete="off"
                class="search-input flex-1 text-xs md:text-sm text-gray-800 placeholder-gray-400 focus:outline-none bg-transparent"
            />
            <button type="submit" class="text-gray-400 hover:text-rose-600 transition px-1.5 focus:outline-none" aria-label="Search">
                <i class="fas fa-arrow-right text-xs"></i>
            </button>
        </form>
    </div>

    <!-- Dropdown -->
    <div class="search-dropdown absolute left-0 w-full top-full bg-white border border-gray-100 rounded-2xl shadow-2xl mt-2 hidden z-50 overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 max-h-96 overflow-y-auto">
            <!-- Suggestions -->
            <div>
                <h3 class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-2">Popular Searches</h3>
                <ul class="space-y-1 text-gray-700 text-xs">
                    <li class="suggestion-item hover:text-rose-600 hover:bg-rose-50/60 px-2 py-1.5 rounded-lg cursor-pointer transition flex items-center space-x-2">
                        <i class="fas fa-search text-[10px] text-gray-300"></i>
                        <span>Diamond Ring</span>
                    </li>
                    <li class="suggestion-item hover:text-rose-600 hover:bg-rose-50/60 px-2 py-1.5 rounded-lg cursor-pointer transition flex items-center space-x-2">
                        <i class="fas fa-search text-[10px] text-gray-300"></i>
                        <span>Gold Necklace</span>
                    </li>
                    <li class="suggestion-item hover:text-rose-600 hover:bg-rose-50/60 px-2 py-1.5 rounded-lg cursor-pointer transition flex items-center space-x-2">
                        <i class="fas fa-search text-[10px] text-gray-300"></i>
                        <span>Silver Studs</span>
                    </li>
                    <li class="suggestion-item hover:text-rose-600 hover:bg-rose-50/60 px-2 py-1.5 rounded-lg cursor-pointer transition flex items-center space-x-2">
                        <i class="fas fa-search text-[10px] text-gray-300"></i>
                        <span>Solitaire Pendants</span>
                    </li>
                    <li class="suggestion-item hover:text-rose-600 hover:bg-rose-50/60 px-2 py-1.5 rounded-lg cursor-pointer transition flex items-center space-x-2">
                        <i class="fas fa-search text-[10px] text-gray-300"></i>
                        <span>Bracelets</span>
                    </li>
                    <li class="suggestion-item hover:text-rose-600 hover:bg-rose-50/60 px-2 py-1.5 rounded-lg cursor-pointer transition flex items-center space-x-2">
                        <i class="fas fa-search text-[10px] text-gray-300"></i>
                        <span>Gold Coins</span>
                    </li>
                </ul>
            </div>

            <!-- Products -->
            <div>
                <h3 class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-2">Featured Picks</h3>
                <ul class="space-y-3 text-xs">
                    <li class="flex space-x-3 items-center p-1.5 rounded-lg hover:bg-rose-50/50 transition cursor-pointer">
                        <img src="https://images.unsplash.com/photo-1573408301185-9146fe634ad0?w=600&auto=format&fit=crop&q=60"
                            class="w-10 h-10 rounded-md object-cover border border-gray-100" />
                        <div>
                            <p class="font-medium text-gray-800 line-clamp-1">Rose Gold Stud Earrings</p>
                            <p class="text-rose-600 font-semibold text-xs">₹1,299 <span class="line-through text-gray-400 text-[10px]">₹1,999</span></p>
                        </div>
                    </li>
                    <li class="flex space-x-3 items-center p-1.5 rounded-lg hover:bg-rose-50/50 transition cursor-pointer">
                        <img src="https://images.unsplash.com/photo-1535632787350-4e68ef0ac584?w=600&auto=format&fit=crop&q=60"
                            class="w-10 h-10 rounded-md object-cover border border-gray-100" />
                        <div>
                            <p class="font-medium text-gray-800 line-clamp-1">Silver Zircon Drop Earrings</p>
                            <p class="text-rose-600 font-semibold text-xs">₹2,099 <span class="line-through text-gray-400 text-[10px]">₹2,799</span></p>
                        </div>
                    </li>
                    <li class="flex space-x-3 items-center p-1.5 rounded-lg hover:bg-rose-50/50 transition cursor-pointer">
                        <img src="https://images.unsplash.com/photo-1603561591411-07134e71a2a9?w=600&auto=format&fit=crop&q=60"
                            class="w-10 h-10 rounded-md object-cover border border-gray-100" />
                        <div>
                            <p class="font-medium text-gray-800 line-clamp-1">Silver Drizzle Pendant</p>
                            <p class="text-rose-600 font-semibold text-xs">₹2,399 <span class="line-through text-gray-400 text-[10px]">₹3,599</span></p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-100 px-4 py-2.5 text-xs text-gray-600 bg-stone-50/60 flex justify-between items-center hover:bg-rose-50/40 cursor-pointer">
            <span>Search for “<span class="search-text font-semibold text-rose-600"></span>”</span>
            <i class="fas fa-arrow-right text-xs text-rose-500"></i>
        </div>
    </div>
</div>

<script>
    if (!window.__searchBarInitialized) {
        window.__searchBarInitialized = true;
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".search-container").forEach(function (container) {
                const input = container.querySelector(".search-input");
                const dropdown = container.querySelector(".search-dropdown");
                const searchText = container.querySelector(".search-text");

                if (!input || !dropdown) return;

                input.addEventListener("input", function () {
                    const query = input.value.trim();
                    if (query !== "") {
                        dropdown.classList.remove("hidden");
                        if (searchText) searchText.textContent = query;
                    } else {
                        dropdown.classList.add("hidden");
                    }
                });

                container.querySelectorAll(".suggestion-item").forEach(function (item) {
                    item.addEventListener("click", function () {
                        const text = item.querySelector("span") ? item.querySelector("span").textContent.trim() : item.textContent.trim();
                        input.value = text;
                        const form = input.closest("form");
                        if (form) form.submit();
                    });
                });
            });

            document.addEventListener("click", function (e) {
                document.querySelectorAll(".search-container").forEach(function (container) {
                    if (!container.contains(e.target)) {
                        const dropdown = container.querySelector(".search-dropdown");
                        if (dropdown) dropdown.classList.add("hidden");
                    }
                });
            });
        });
    }
</script>
