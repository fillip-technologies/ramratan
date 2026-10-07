<section x-data="categoriesSection()" class="py-16 bg-rose-50 md:hidden ">
    <div class="max-w-7xl mx-auto px-5 text-center">
        <h2 class="text-3xl font-serif font-semibold text-gray-800 tracking-wide">
            Shop by Categories
        </h2>
        <p class="text-gray-500 text-sm mt-2 mb-10">Explore what you love — click to browse each category</p>

        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-7 gap-4 sm:gap-6">
            <template x-for="(cat, index) in categories" :key="index">
                <div @click="goToCategory(cat.link)"
                    class="group flex flex-col items-center text-center cursor-pointer transition-transform hover:-translate-y-1">

                    <!-- Image Wrapper -->
                    <div
                        class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 lg:w-32 lg:h-32 rounded-3xl overflow-hidden shadow-md bg-white flex items-center justify-center">
                        <img :src="cat.img" :alt="cat.name"
                            class="w-full h-full object-cover transition duration-500 group-hover:scale-110" />
                    </div>

                    <!-- Name -->
                    <h3
                        class="mt-2 sm:mt-3 text-[0.75rem] sm:text-sm md:text-base font-semibold text-rose-600 group-hover:text-rose-600 transition">
                        <span x-text="cat.name"></span>
                    </h3>
                </div>
            </template>
        </div>

    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('categoriesSection', () => ({
                categories: [{
                        name: 'Ring',
                        img: '{{ asset('images/categories/1.png') }}',
                        link: ''
                    },
                    {
                        name: 'Necklase',
                        img: '{{ asset('images/categories/2.png') }}',
                        link: ''
                    },
                    {
                        name: 'Solitaires',
                        img: '{{ asset('images/categories/3.png') }}',
                        link: ''
                    },
                    {
                        name: 'Ear Rings',
                        img: '{{ asset('images/categories/4.png') }}',
                        link: ''
                    },
                    {
                        name: 'Pendant',
                        img: '{{ asset('images/categories/5.png') }}',
                        link: ''
                    },
                    {
                        name: 'Mangal Sutra',
                        img: '{{ asset('images/categories/6.png') }}',
                        link: ''
                    },
                    {
                        name: 'Gold Chain',
                        img: '{{ asset('images/categories/7.png') }}',
                        link: ''
                    },
                ],
                goToCategory(link) {
                    window.location.href = link;
                }
            }))
        })
    </script>
</section>
