<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<section class="pt-8 bg-white">
    <div class="max-w-6xl mx-auto px-6">

        <div class="text-center mb-12">
            <h2 class="text-3xl font-serif font-semibold text-gray-800 tracking-wide">
                What Our Customers Say
            </h2>
            <p class="text-gray-500 text-sm mt-2">
                Real experiences from happy shoppers
            </p>
        </div>


        <div class="swiper">
            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    <div
                        class="bg-white border rounded-md shadow-sm p-6 transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                        <div class="flex text-pink-600 mb-3">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            “Absolutely love the quality of the jewelry! The design is elegant
                            and the delivery was super quick.”
                        </p>
                        <h4 class="mt-4 text-gray-800 font-semibold text-sm">
                            — Ananya Sharma
                        </h4>
                    </div>
                </div>


                <div class="swiper-slide">
                    <div
                        class="bg-white border rounded-md shadow-sm p-6 transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                        <div class="flex text-pink-600 mb-3">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            “The checkout was smooth and the customer support was very helpful.
                            Highly recommend this store.”
                        </p>
                        <h4 class="mt-4 text-gray-800 font-semibold text-sm">
                            — Rohan Verma
                        </h4>
                    </div>
                </div>


                <div class="swiper-slide">
                    <div
                        class="bg-white border rounded-md shadow-sm p-6 transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                        <div class="flex text-pink-600 mb-3">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            “Great collection at reasonable prices. I’m impressed with the
                            packaging and attention to detail.”
                        </p>
                        <h4 class="mt-4 text-gray-800 font-semibold text-sm">
                            — Priya Kapoor
                        </h4>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div
                        class="bg-white border rounded-md shadow-sm p-6 transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                        <div class="flex text-pink-600 mb-3">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            “Great diamond collection at reasonable prices. I’m impressed with the
                            product. Highly recommend this store.”
                        </p>
                        <h4 class="mt-4 text-gray-800 font-semibold text-sm">
                            — Ankita Singh
                        </h4>
                    </div>
                </div>
            </div>


            <div class="swiper-pagination mt-16"></div>

        </div>
    </div>
</section>

<style>
    .swiper {
        padding-bottom: 2rem;
    }

    .swiper-pagination {
        bottom: 0 !important;
        text-align: center;
    }
</style>


<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    const swiper = new Swiper(".swiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            768: {
                slidesPerView: 3,
            },
        },
    });
</script>
