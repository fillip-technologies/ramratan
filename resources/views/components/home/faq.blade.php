<section class="py-16 bg-white" id="faqs">
    <div class="max-w-4xl mx-auto px-6">
        <!-- Heading -->
        <div class="text-center mb-12">
            <h2 class="text-3xl font-serif font-semibold text-gray-800">Frequently Asked Questions</h2>
            <p class="mt-2 text-gray-500 text-sm">Your queries answered for a smooth shopping experience</p>
        </div>

        <!-- FAQ Items -->
        <div class="space-y-4">


            <div x-data="{ open: true }" class="border rounded-lg shadow-sm">
                <button @click="open = !open"
                    class="w-full flex justify-between items-center px-5 py-4 text-left font-medium focus:outline-none">
                    <span :class="open ? 'text-pink-600' : 'text-gray-800'">
                        What materials are used in your jewellery?
                    </span>
                    <i
                        :class="open ? 'fa-solid fa-chevron-up text-pink-600' : 'fa-solid fa-chevron-down text-gray-400'"></i>
                </button>
                <div x-show="open" x-transition class="px-5 pb-4 text-gray-600 text-sm leading-relaxed">
                    We use certified sterling silver, 18k gold plating, and conflict-free gemstones to ensure premium
                    quality and sustainability.
                </div>
            </div>


            <div x-data="{ open: false }" class="border rounded-lg shadow-sm">
                <button @click="open = !open"
                    class="w-full flex justify-between items-center px-5 py-4 text-left font-medium focus:outline-none">
                    <span :class="open ? 'text-pink-600' : 'text-gray-800'">
                        Do you provide a warranty on your products?
                    </span>
                    <i
                        :class="open ? 'fa-solid fa-chevron-up text-pink-600' : 'fa-solid fa-chevron-down text-gray-400'"></i>
                </button>
                <div x-show="open" x-transition class="px-5 pb-4 text-gray-600 text-sm leading-relaxed">
                    Yes, all our products come with a 6-month warranty covering manufacturing defects and plating
                    issues.
                </div>
            </div>


            <div x-data="{ open: false }" class="border rounded-lg shadow-sm">
                <button @click="open = !open"
                    class="w-full flex justify-between items-center px-5 py-4 text-left font-medium focus:outline-none">
                    <span :class="open ? 'text-pink-600' : 'text-gray-800'">
                        How long does delivery take?
                    </span>
                    <i
                        :class="open ? 'fa-solid fa-chevron-up text-pink-600' : 'fa-solid fa-chevron-down text-gray-400'"></i>
                </button>
                <div x-show="open" x-transition class="px-5 pb-4 text-gray-600 text-sm leading-relaxed">
                    Orders are typically delivered within 5–7 business days across India. Express shipping is also
                    available at checkout.
                </div>
            </div>


            <div x-data="{ open: false }" class="border rounded-lg shadow-sm">
                <button @click="open = !open"
                    class="w-full flex justify-between items-center px-5 py-4 text-left font-medium focus:outline-none">
                    <span :class="open ? 'text-pink-600' : 'text-gray-800'">
                        What is your return policy?
                    </span>
                    <i
                        :class="open ? 'fa-solid fa-chevron-up text-pink-600' : 'fa-solid fa-chevron-down text-gray-400'"></i>
                </button>
                <div x-show="open" x-transition class="px-5 pb-4 text-gray-600 text-sm leading-relaxed">
                    We offer a 7-day easy return policy. Items must be unused and in original packaging for a full
                    refund or exchange.
                </div>
            </div>

        </div>
    </div>
</section>
