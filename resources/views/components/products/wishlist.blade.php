 @if (session('success'))
        <div x-data="{ show: true }" x-show="show"
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
            <span @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer">
                &times;
            </span>
        </div>

    @endif
<section x-data="wishlistComponent()" class="max-w-7xl mx-auto px-4 py-12">
    <div class="flex items-center justify-between mb-10">
        <h2 class="text-2xl font-semibold tracking-wide text-gray-800 flex items-center gap-3">
            <i class="fa-regular fa-heart text-pink-500"></i> My Wishlist
        </h2>
        <span class="text-gray-500 text-sm" x-text="wishlist.length + ' items'"></span>
    </div>

    <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
        <template x-for="(item, index) in wishlist" :key="index">
            <div class="group relative">
                <div class="overflow-hidden rounded relative">
                    <img :src="item.image"
                        class="w-full h-72 object-cover group-hover:scale-105 transition duration-500 ease-in-out" />

                    <button @click="remove(index)"
                        class="absolute top-4 right-4 bg-white/90 backdrop-blur-md hover:bg-pink-100 text-pink-600 rounded-full w-10 h-10 flex items-center justify-center shadow">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="mt-4 text-center">
                    <h3 class="text-lg font-medium text-gray-800  transition" x-text="item.name"></h3>
                    <p class="text-pink-600 font-semibold mt-1" x-text="'₹' + item.price"></p>

                    <div class="mt-4">
                        <button
                            class="w-full bg-gradient-to-r from-pink-400 to-rose-300 hover:opacity-90 text-white font-medium py-2.5 rounded shadow-md transition">
                            Add to Cart  <i class="fa-solid fa-bag-shopping text-lg ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <div x-show="wishlist.length === 0" class="text-center py-20 text-gray-500">
        <i class="fa-regular fa-heart text-5xl text-pink-400 mb-4"></i>
        <p class="text-xl">Your wishlist is empty</p>
        <p class="text-gray-400 mt-1">Start adding your favorite jewelry pieces  <i class="fa-solid fa-wand-magic-sparkles"></i></p>
    </div>
</section>

<script>
    function wishlistComponent() {
        return {
            wishlist: [{
                    name: "Diamond Necklace",
                    price: "12,999",
                    image: "/images/top-product/r1.jpg"
                },
                {
                    name: "Gold Earrings",
                    price: "7,499",
                    image: "/images/top-product/r2.jpg"
                },
                {
                    name: "Silver Bracelet",
                    price: "2,999",
                    image: "/images/top-product/r3.jpg"
                },
                {
                    name: "Emerald Ring",
                    price: "15,999",
                    image: "/images/top-product/r4.jpg"
                }
            ],
            remove(index) {
                this.wishlist.splice(index, 1);
            }
        }
    }
</script>
