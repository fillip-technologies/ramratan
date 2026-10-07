@extends('layouts.app')

@section('content')
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="//unpkg.com/alpinejs" defer></script>

<div class="max-w-7xl mx-auto px-6 py-10">

    {{-- ✅ Success Message --}}
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show"
             class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
            <span @click="show = false"
                  class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer">
                &times;
            </span>
        </div>
    @endif

    {{-- ✅ Wishlist Section --}}
    <section x-data="wishlistComponent()" class="py-10">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 flex items-center gap-3">
                <i class="fa-regular fa-heart text-pink-500"></i> My Wishlist
            </h2>
            <span class="text-gray-500 text-sm" x-text="wishlist.length + ' items'"></span>
        </div>

        {{-- ✅ Wishlist Grid --}}
        <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
            <template x-for="(item, index) in wishlist" :key="item.id">
                <div class="group relative border rounded-lg shadow hover:shadow-lg transition p-3">
                    <div class="overflow-hidden rounded relative">
                        <img :src=" item.image"
                             alt=""
                             class="w-full h-72 object-cover group-hover:scale-105 transition duration-500 ease-in-out" />

                        {{-- ❌ Remove Button --}}
                        <button @click="removeItem(item.id, index)"
                                class="absolute top-4 right-4 bg-white/90 backdrop-blur-md hover:bg-pink-100 text-pink-600 rounded-full w-10 h-10 flex items-center justify-center shadow">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <div class="mt-4 text-center">
                        <h3 class="text-lg font-medium text-gray-800" x-text="item.name"></h3>
                        <p class="text-pink-600 font-semibold mt-1" x-text="'₹' + item.price"></p>

                        <div class="mt-4">
                            {{-- ✅ Add to Cart --}}
                            @if (Auth::check())
                                <form :action="'{{ route('cart.add') }}'" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                    {{-- ❗ Use item.id instead of $products->id --}}
                                    <input type="hidden" name="product_id" :value="item.id">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit"
                                            class="block text-center w-full bg-gradient-to-r from-pink-400 to-rose-300 hover:opacity-90 text-white font-medium py-2.5 rounded shadow-md transition">
                                        Add to Cart
                                        <i class="fa-solid fa-bag-shopping text-lg ml-2"></i>
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}"
                                   class="block text-center w-full bg-gradient-to-r from-pink-400 to-rose-300 hover:opacity-90 text-white font-medium py-2.5 rounded shadow-md transition">
                                    Login to Add to Cart
                                    <i class="fa-solid fa-right-to-bracket text-lg ml-2"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </template>
        </div>

        {{-- ✅ Empty Wishlist Message --}}
        <div x-show="wishlist.length === 0"
             class="text-center py-20 text-gray-500">
            <i class="fa-regular fa-heart text-5xl text-pink-400 mb-4"></i>
            <p class="text-xl">Your wishlist is empty</p>
            <p class="text-gray-400 mt-1">
                Start adding your favorite products 💖
            </p>
        </div>
    </section>
</div>

{{-- ✅ Alpine.js Logic --}}
<script>
    function wishlistComponent() {
        return {
            wishlist: @json($products),

            async removeItem(productId, index) {
                if (confirm('Remove this product from your wishlist?')) {
                    try {
                        const response = await fetch("{{ route('wishlist.remove') }}", {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({ product_id: productId }),
                        });

                        const data = await response.json();
                        if (data.success) {
                            this.wishlist.splice(index, 1);
                        } else {
                            alert('Failed to remove item.');
                        }
                    } catch (error) {
                        console.error(error);
                        alert('Error removing product.');
                    }
                }
            }
        }
    }
</script>
@endsection
