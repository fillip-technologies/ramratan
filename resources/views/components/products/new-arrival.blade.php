<div x-data="carousel()" x-init="init()"
    class="flex flex-col items-center py-16 bg-white relative overflow-hidden">

    <!-- Section Heading -->
    <div class="mb-10 text-center">
        <h2 class="text-3xl font-serif font-semibold text-gray-800 tracking-wide">
            New Arrival
        </h2>
        <p class="text-gray-500 text-sm mt-2">
            Discover our latest collections
        </p>
    </div>

    <div class="relative w-full max-w-7xl">
        <!-- Prev Button -->
        <button @click="prev()"
            class="absolute left-0 top-1/2 -translate-y-1/2 bg-pink-200 shadow-md py-2 px-3 z-10 hover:bg-pink-300 text-pink-700 text-4xl">
            &lt;
        </button>

        <!-- Carousel Container -->
        <div class="overflow-hidden px-5">
            <div class="flex transition-transform duration-500 ease-in-out"
                :style="`transform: translateX(-${currentIndex * step}%);`">

                <!-- Loop through products -->
                @foreach ($arrivalproduct as $arrival)
                    <div
                        class="flex-shrink-0 w-full sm:w-1/2 md:w-1/3 lg:w-1/4 px-4 flex flex-col items-center text-center group cursor-pointer">

                        <div class="w-60 h-60 overflow-hidden rounded-xl shadow-md p-5 text-center">
                            <img src="{{ asset($arrival->image) }}" alt="{{ $arrival->name }}"
                                class="w-full h-full object-contain transform transition duration-500 group-hover:scale-105" />
                        </div>

                        <h3 class="mt-4 text-lg font-medium text-gray-700">{{ $arrival->name }}</h3>

                        <div class="mt-2 flex justify-center items-center space-x-2">
                            <span class="text-pink-700 font-bold text-lg">₹{{ $arrival->price }}</span>
                            {{-- <span class="text-gray-400 line-through text-sm">₹{{  }}</span> --}}
                        </div>

                        <button class="mt-3 px-4 py-2 bg-pink-50 text-pink-600 rounded-lg hover:bg-pink-100 transition">
                            <i class="fa-solid fa-bag-shopping"></i>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Next Button -->
        <button @click="next()"
            class="absolute right-0 top-1/2 -translate-y-1/2 bg-pink-200 hover:bg-pink-300 py-2 px-3 z-10 text-pink-700 text-4xl">
            &gt;
        </button>
    </div>

    <!-- View All Button -->
    <div class="mt-12">
        <a href="{{ route('view-product') }}"
           class="px-6 py-3 bg-white text-pink-600 hover:bg-pink-700 hover:text-white transition border border-pink-600">
           View All
        </a>
    </div>
</div>

<script>
function carousel() {
    return {
        currentIndex: 0,
        step: 25, // Adjust based on number of items per view (4 items = 25%)
        total: {{ $arrivalproduct->count() }},
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
