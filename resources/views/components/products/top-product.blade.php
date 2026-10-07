<div x-data="carousel()" x-init="init()"
    class="flex flex-col items-center py-16 bg-white relative overflow-hidden">

    <div class="mb-8 text-center">
        <h2 class="text-3xl font-serif font-semibold text-gray-800 tracking-wide">
            Top Products
        </h2>
        <p class="text-gray-500 text-sm mt-2">Discover our most loved collections</p>
    </div>

    <div class="relative w-full max-w-7xl">
        <!-- Prev Button -->
        <button @click="prev()"
            class="absolute left-0 top-1/2 -translate-y-1/2 bg-pink-200 shadow-md py-2 px-3 z-10 hover:bg-pink-300 text-pink-700 text-4xl">
            &lt;
        </button>

        <div class="overflow-hidden px-5">
            <div class="flex transition-transform duration-500 ease-in-out"
                :style="`transform: translateX(-${currentIndex * step}%);`">

                <!-- Loop through products -->
                @foreach ($topproduct as $top)
                    <div
                        class="flex-shrink-0 w-full sm:w-1/2 md:w-1/4 px-4 flex flex-col items-center text-center group cursor-pointer">

                        <div class="w-60 h-60 overflow-hidden rounded-full shadow-md">
                            <img src="{{ asset($top->image) }}" alt="{{ $top->name }}"
                                class="w-full h-full object-cover transform transition duration-500 group-hover:scale-110" />
                        </div>

                        <h3 class="mt-4 text-lg font-medium text-gray-700">{{ $top->name }}</h3>

                        <a href="{{ route('product_details',$top->slug) }}"
                            class="mt-2 inline-block text-sm font-semibold text-rose-600 hover:text-rose-800 transition">
                            Shop Now
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <button @click="next()"
            class="absolute right-0 top-1/2 -translate-y-1/2 bg-pink-200 hover:bg-pink-300 py-2 px-3 z-10 text-pink-700 text-4xl">
            &gt;
        </button>
    </div>
</div>

<script>
function carousel() {
    return {
        currentIndex: 0,
        step: 25, // Adjust based on number of items per view
        total: {{ $topproduct->count() }},
        init() {},
        prev() {
            this.currentIndex = this.currentIndex > 0 ? this.currentIndex - 1 : this.total - 1;
        },
        next() {
            this.currentIndex = (this.currentIndex + 1) % this.total;
        }
    }
}
</script>
