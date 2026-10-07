<section class="bg-gradient-to-b from-rose-50 via-white to-pink-50 py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">

        <!-- Heading -->
        <div class="text-center mb-16">
            <h1 class="text-3xl md:text-4xl font-serif font-bold text-gray-800">
                About <span class="text-pink-600">Us</span>
            </h1>
            <p class="mt-4 text-gray-600 text-xl max-w-2xl mx-auto">
                Crafting timeless jewellery with elegance, precision, and a touch of love because every jewel tells a
                story.
            </p>
        </div>

        <!-- Hero Image + Story -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

            <!-- Video + Stats -->
            <div class="flex flex-col items-center">
                <!-- Autoplay Video -->
                <div
                    class="relative rounded-3xl overflow-hidden shadow-xl mb-12 max-w-4xl w-full transform hover:scale-105 transition duration-500">
                    <video autoplay muted loop playsinline class="w-full rounded-2xl">
                        <source src="/images/video-one.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-8 w-full max-w-4xl">
                    <div class="text-center">
                        <h3 class="text-3xl font-bold text-pink-600">25+</h3>
                        <p class="text-gray-600 text-sm mt-2">Years of Excellence</p>
                    </div>
                    <div class="text-center">
                        <h3 class="text-3xl font-bold text-yellow-500">150+</h3>
                        <p class="text-gray-600 text-sm mt-2">Expert Artisans</p>
                    </div>
                    <div class="text-center">
                        <h3 class="text-3xl font-bold text-pink-600">5000+</h3>
                        <p class="text-gray-600 text-sm mt-2">Timeless Designs</p>
                    </div>
                    <div class="text-center">
                        <h3 class="text-3xl font-bold text-yellow-500">3000+</h3>
                        <p class="text-gray-600 text-sm mt-2">Happy Customers</p>
                    </div>
                </div>
            </div>

            <!-- Story -->
            <div class="flex flex-col items-start justify-start space-y-6 h-full">
                <h2 class="text-xl md:text-2xl font-semibold text-gray-800">Our Story</h2>
                <p class="text-gray-600 leading-relaxed text-justify">
                    Founded with a passion for fine craftsmanship, <span class="text-pink-600 font-medium">Ramratan
                        Jewels</span> has been creating exquisite jewellery that celebrates life’s most precious
                    moments. From heritage-inspired masterpieces to contemporary elegance, each piece is thoughtfully
                    designed to embody grace, sophistication, and timeless beauty. Our artisans blend traditional
                    techniques with modern innovation, ensuring every creation tells a unique story and resonates with
                    your personal style.
                </p>

                <p class="text-gray-600 leading-relaxed text-justify">
                    At <span class="text-pink-600 font-medium">Ramratan Jewels</span>, we take pride in our commitment
                    to excellence. With ethically sourced materials, certified gemstones, and meticulous attention to
                    detail, we guarantee that every jewel is as authentic as the emotion it represents. Whether it’s a
                    gift for a loved one, a symbol of achievement, or a treasured heirloom, our collections are designed
                    to make every occasion unforgettable.
                </p>

               

            </div>


        </div>

        <!-- Call to Action -->
        <div class="text-center mt-20">
            <h2 class="text-xl md:text-2xl text-gray-800 mb-6 font-semibold">
                Discover Jewellery That Speaks to Your Heart
            </h2>
            <a href="{{ route('home') }}#shop"
                class="inline-block bg-pink-600 text-white px-6 py-2 rounded-full shadow-lg hover:bg-pink-700 hover:shadow-xl transition">
                Explore Collection <i class="fa-solid fa-arrow-right ml-2"></i>
            </a>
        </div>

    </div>
</section>
