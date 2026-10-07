@extends('layouts.app')

@section('title', 'Cart Section')

@section('content')
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show"
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
            <span @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer">
                &times;
            </span>
        </div>

    @endif

     @if (session('added'))
        <div x-data="{ show: true }" x-show="show"
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('added') }}
            <span @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer">
                &times;
            </span>
        </div>

    @endif

    <section class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <h2 class="text-2xl text-gray-800 mb-10">Your Shopping Cart</h2>

            <div x-data="cart()" class="grid grid-cols-1 lg:grid-cols-3 gap-12">

                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-8">
                    @foreach ($cartItems as $carts)
                        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6 border px-4 py-3 pb-6">
                            <img src="{{ asset($carts->product->image) }}" alt="{{ $carts->product->name }}"
                                class="w-28 h-28 object-contain mx-auto sm:mx-0" />

                            <div class="flex-1 text-center sm:text-left">
                                <h3 class="text-lg font-medium text-gray-900">{{ $carts->product->name }}</h3>
                                <p class="mt-2 text-pink-600 font-semibold">₹{{ number_format($carts->product->price, 2) }}
                                </p>

                                <!-- Quantity -->
                                <div class="mt-3 flex justify-center sm:justify-start items-center gap-3">
                                    <span class="text-sm text-gray-700">Qty:</span>
                                    <div class="flex items-center border rounded">
                                        <button @click="decreaseQty({{ $carts->id }})"
                                            class="px-3 py-1 text-gray-600 hover:bg-pink-50">-</button>
                                        <input type="number" min="1"
                                            x-model.number="quantities[{{ $carts->id }}]"
                                            @change="updateQty({{ $carts->id }})"
                                            class="w-12 text-center border-x text-gray-800" />
                                        <button @click="increaseQty({{ $carts->id }})"
                                            class="px-3 py-1 text-gray-600 hover:bg-pink-50">+</button>
                                    </div>
                                </div>
                            </div>

                            <div class="flex sm:flex-col items-center sm:items-end justify-center gap-3 mt-4 sm:mt-0">
                                <form action="{{ route('store.wishlist') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ Auth::check() ? Auth::user()->id : '' }}"
                                        name="user_id">
                                    <input type="hidden" value="{{ $carts->product->id }}" name="product_id">
                                    <button class="text-gray-500 hover:text-pink-600 text-sm flex items-center gap-1">
                                        <i class="fa-regular fa-heart"></i> Wishlist
                                    </button>
                                </form>

                                <a href="{{ route('cart.delete', $carts->id) }}"
                                    class="text-pink-500 hover:underline text-sm flex items-center gap-1">
                                    <i class="fa-solid fa-trash"></i> Remove
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Order Summary -->
                <div class="bg-pink-50 border border-pink-600 rounded p-6 shadow-sm lg:sticky lg:top-6 self-start">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6">Order Summary</h3>
                    <dl class="space-y-3 text-gray-700">
                        <div class="flex justify-between">
                            <dt>Subtotal</dt>
                            <dd>₹<span x-text="subtotal.toFixed(2)"></span></dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Shipping</dt>
                            <dd>₹<span x-text="shipping.toFixed(2)"></span></dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Tax</dt>
                            <dd>₹<span x-text="tax.toFixed(2)"></span></dd>
                        </div>
                        <div class="flex justify-between font-semibold border-t pt-3 text-gray-900">
                            <dt>Total</dt>
                            <dd>₹<span x-text="total.toFixed(2)"></span></dd>
                        </div>
                    </dl>

                    <a href="{{ route('checkout') }}"
                        class="block w-full mt-6 bg-pink-600 text-white py-3 rounded shadow-md hover:bg-pink-700 transition font-medium text-center">
                        Proceed to Checkout <i class="fa-solid fa-lock ml-2"></i>
                    </a>
                    {{-- {{ route('shop') }} --}}
                    <a href="{{ url('view-product') }}" class="block mt-4 text-center text-sm text-pink-600 hover:underline">
                        <i class="fa-solid fa-arrow-left"></i> Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script>
        function cart() {
            return {
                quantities: {
                    @foreach ($cartItems as $carts)
                        {{ $carts->id }}: {{ $carts->quantity }},
                    @endforeach
                },
                prices: {
                    @foreach ($cartItems as $carts)
                        {{ $carts->id }}: {{ $carts->product->price }},
                    @endforeach
                },
                shipping: 500,
                tax: 200,
                get subtotal() {
                    let sum = 0;
                    for (const id in this.quantities) {
                        sum += this.quantities[id] * this.prices[id];
                    }
                    return sum;
                },
                get total() {
                    return this.subtotal + this.shipping + this.tax;
                },
                increaseQty(id) {
                    this.quantities[id]++;
                    this.updateQty(id);
                },
                decreaseQty(id) {
                    if (this.quantities[id] > 1) {
                        this.quantities[id]--;
                        this.updateQty(id);
                    }
                },
                updateQty(id) {
                    fetch(`/cart/update/${id}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                quantity: this.quantities[id]
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (!data.success) alert('Failed to update quantity');
                        });
                }
            }
        }
    </script>
@endsection
