@php
    // Fetch the first row
    $row = App\Models\ManageBv::first();

    $sliderItems = [];

    if ($row) {
        if (is_string($row->slider_image) && str_starts_with(trim($row->slider_image), '[')) {
            $images = json_decode($row->slider_image, true);
        }

        else {
            $images = [$row->slider_image];
        }
        foreach ($images as $img) {
            $clean = str_replace(['uploads/banner/images/', '/uploads/banner/images/'], '', $img);
            $sliderItems[] = [
                'img' => asset('uploads/banner/images/' . $clean)
            ];
        }
    }
@endphp

<section
x-data="{
    active: 0,
    items: {{ json_encode($sliderItems) }},
    next() { this.active = (this.active + 1) % this.items.length },
    prev() { this.active = (this.active - 1 + this.items.length) % this.items.length }
}"
class="relative bg-gray-50 md:py-16 py-5 overflow-hidden">

    <div class="w-full mx-auto md:px-12 px-6 relative">

        <!-- Slides -->
        <template x-for="(item, index) in items" :key="index">
            <div x-show="active === index"
                x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                class="flex justify-center items-center rounded-xl overflow-hidden md:shadow-lg md:h-[300px] md:bg-white">

                <img :src="item.img"
                     class="md:object-cover w-full h-full transition-all duration-700 hover:scale-105">
            </div>
        </template>

        <!-- Pagination -->
        <div class="flex justify-center items-center gap-2 mt-5">
            <template x-for="(item, index) in items" :key="index">
                <button @click="active = index"
                    class="w-1.5 h-1.5 rounded-full transition-all duration-300"
                    :class="active === index ? 'bg-pink-600 w-4' : 'bg-gray-400 hover:bg-gray-600'">
                </button>
            </template>
        </div>

        <!-- Next / Prev Buttons -->
        <div class="absolute -bottom-8 right-12 md:flex gap-3 hidden">

            <button @click="prev"
                class="p-3 bg-white/80 hover:bg-white text-gray-700 rounded-full shadow-lg backdrop-blur-sm border border-gray-300 transition transform hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <button @click="next"
                class="p-3 bg-white/80 hover:bg-white text-gray-700 rounded-full shadow-lg backdrop-blur-sm border border-gray-300 transition transform hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>

        </div>

    </div>
</section>
