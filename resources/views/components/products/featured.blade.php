
<div class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="text-center mb-12">
            <h2 class="text-3xl font-serif font-semibold text-gray-800">Featured Products</h2>
            <p class="text-gray-500 mt-2 text-sm">Our handpicked selection just for you</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach ($products as $product)
                <a href="{{ route('view-product') }}"
                    class="bg-white border rounded-lg shadow-sm p-5 hover:shadow-md transition-transform duration-300 hover:-translate-y-1">
                    <div class="w-full flex justify-center">
                        <img src="{{ asset($product->image) }}" alt="Platinum Earrings"
                            class="h-44 object-contain transition-transform duration-300 hover:scale-105" />
                    </div>

                    <div class="mt-4 space-y-2">
                        <h3 class="text-gray-800 font-medium text-base truncate">{{ $product->name }}</h3>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <span class="text-pink-700 font-bold text-lg">₹{{ $product->price }}</span>
                                <span class="text-gray-400 line-through text-sm">₹{{ $product->original_price }}</span>
                            </div>
                            <button class="p-2 rounded-full bg-pink-50 text-pink-600 hover:bg-pink-100">
                                <i class="fa-solid fa-bag-shopping text-lg"></i>
                            </button>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-12 text-center">
            <a href="{{ route('view-product') }}"
                class="inline-block bg-white text-pink-600 px-6 py-3 shadow hover:bg-pink-600 hover:text-white border border-pink-600 transition">
                View All Products
            </a>
        </div>
    </div>
</div>
<x-home.customization/>
