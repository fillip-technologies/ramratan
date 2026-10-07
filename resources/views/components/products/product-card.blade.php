@props(['product'])

<div
    class="bg-white border rounded-lg shadow-sm p-5 hover:shadow-md transition-transform duration-300 hover:-translate-y-1">
    <a href="{{ route('product_details', $product->slug) }}">
        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
            class="h-44 w-full object-contain transition-transform duration-300 hover:scale-105" />
    </a>
    <div class="mt-4 space-y-2">
        <h3 class="text-gray-800 font-medium text-base truncate">{{ $product->name }}</h3>
        <div class="flex items-center space-x-2">
            <span class="text-pink-700 font-bold text-lg">₹{{ number_format($product->price, 2) }}</span>
            @if ($product->original_price && $product->original_price > $product->price)
                <span class="text-gray-400 line-through text-sm">₹{{ number_format($product->original_price, 2) }}</span>
            @endif
        </div>
        <div class="min-h-[1.5rem]">
            @if ($product->discount > 0)
                <span class="text-gray-400 text-sm">{{ $product->discount }}% discount for today</span>
            @endif
        </div>
    </div>
    <div class="mt-4">
        @auth
            <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit"
                    class="block text-center w-full bg-gradient-to-r from-pink-400 to-rose-300 hover:opacity-90 text-white font-medium py-2.5 rounded shadow-md transition">
                    Add to Cart
                </button>
            </form>
        @else
            <a href="{{ route('login') }}"
                class="block text-center w-full bg-gradient-to-r from-pink-400 to-rose-300 hover:opacity-90 text-white font-medium py-2.5 rounded shadow-md transition">
                Add to Cart
                <i class="fa-solid fa-bag-shopping text-lg ml-2"></i>
            </a>
        @endauth
    </div>
</div>
