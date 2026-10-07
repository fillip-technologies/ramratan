@props(['images' => []])

@php
    $images = $images ?: [
        '/images/top-product\r1.jpg',
        '/images/top-product\r2.jpg',
        '/images/top-product\r3.jpg',
        '/images/top-product\r4.jpg',
    ];
@endphp

<section x-data="galleryComponent({{ json_encode($images) }})" class="w-full py-4 md:px-4">
    <div class="grid grid-cols-1 gap-4">
        <!-- Row 1: Big Image -->
        <div class="relative overflow-hidden rounded group cursor-pointer aspect-video w-full">
            <img :src="currentImage"
                class="absolute top-0 left-0 w-full h-full object-cover transition-all duration-500 rounded" />

            <!-- Arrows -->
            <button @click.stop="prev()"
                class="md:hidden absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white rounded-full w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center z-10">
                <i class="fa-solid fa-chevron-left text-xs sm:text-base"></i>
            </button>
            <button @click.stop="next()"
                class="md:hidden absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white rounded-full w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center z-10">
                <i class="fa-solid fa-chevron-right text-xs sm:text-base"></i>
            </button>
        </div>

        <!-- Thumbnails -->
        <div class="md:flex flex-wrap justify-center gap-4 hidden">
            <template x-for="(img, index) in images" :key="index">
                <div @click="select(index)" class="overflow-hidden rounded cursor-pointer border-2"
                    :class="currentIndex === index ? 'border-pink-500' : 'border-transparent'">
                    <img :src="img" class="w-20 h-20 object-cover rounded" />
                </div>
            </template>
        </div>
    </div>
</section>


<script>
    function galleryComponent(images) {
        return {
            images,
            currentIndex: 0,
            get currentImage() {
                return this.images[this.currentIndex];
            },
            next() {
                this.currentIndex = (this.currentIndex + 1) % this.images.length;
            },
            prev() {
                this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
            },
            select(index) {
                this.currentIndex = index;
            }
        }
    }
</script>
