@extends('layouts.app')

@section('title', 'Checkout Section')

@section('content')

    <section class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <h2 class="text-2xl text-gray-800 mb-10">Checkout</h2>


            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-8">
                  

                        <div class="max-w-3xl mx-auto py-8">
                            <div class="bg-white rounded-lg shadow-sm border p-6 mb-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-lg font-semibold text-gray-900">Shipping Address</h2>
                                    <button type="button" id="changeAddressBtn"
                                        class="text-pink-600 hover:text-pink-700 text-sm font-medium transition-colors">
                                        <i class="fas fa-edit mr-1"></i>Change Address
                                    </button>
                                </div>

                                <!-- Show saved address -->
                                <p id="savedAddress" class="text-gray-800">
                                    {{ auth()->user()->address ?? 'No address saved yet' }}
                                </p>

                                <!-- Address Form -->
                                <form id="addressForm" action="{{ route('add.address') }}" method="POST" class="hidden">
                                    @csrf
                                    <div class="mt-4">
                                        <label for="address"
                                            class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                        <input type="text" id="address" name="address"
                                            value="{{ old('address', auth()->user()->address) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-pink-600" />
                                    </div>

                                    <div class="flex space-x-3 mt-6">
                                        <button type="submit"
                                            class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700 transition-colors font-medium">
                                            Save Address
                                        </button>
                                        <button type="button" id="cancelAddressBtn"
                                            class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300 transition-colors font-medium">
                                            Cancel
                                        </button>
                                    </div>
                                </form>

                                <!-- Success message -->
                                <div id="addressSuccess" class="hidden mt-4 p-3 bg-green-100 text-green-700 rounded">
                                    ✅ Address saved successfully!
                                </div>
                            </div>
                        </div>



                    <div class="bg-white rounded-lg shadow-sm border p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-6">
                            Payment Method
                        </h2>
                        <!-- Payment Options -->
                        <div class="space-y-4 mb-6">
                            <!-- Razorpay Option -->
                            <label
                                class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                <input type="radio" name="payment" value="razorpay" checked
                                    class="h-4 w-4 text-pink-600 focus:ring-pink-600 border-gray-300" />
                                <div class="ml-4 flex items-center">
                                    <img src="https://razorpay.com/assets/razorpay-logo.svg" alt="Razorpay"
                                        class="h-8 w-auto" />
                                </div>
                            </label>

                            <!-- COD Option -->
                            <label
                                class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                <input type="radio" name="payment" value="cod"
                                    class="h-4 w-4 text-pink-600 focus:ring-pink-600 border-gray-300" />
                                <div class="ml-4 flex items-center gap-2">
                                    <i class="fa-solid fa-wallet text-2xl text-green-500"></i>
                                    <span class="text-gray-800 font-medium">Cash on Delivery</span>
                                </div>
                            </label>

                        </div>
                    </div>
                </div>


                <!-- Order Summary -->
                <div
                    class="bg-pink-50 border border-pink-600 rounded p-6 shadow-sm
            lg:sticky lg:top-6 self-start
             overflow-y-auto">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6">Order Summary</h3>

                    <div class="mb-6 space-y-5">
                        @foreach ($getcheckout as $checkout)
                            <div class="flex items-center space-x-4">
                                <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <img src="{{ asset($checkout->product->image) }}" alt="Product"
                                        class="w-full h-full object-cover rounded" />
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-medium text-gray-900">{{ $checkout->product->name }}</h3>

                                    <div class="flex items-center justify-between mt-1">
                                        <span class="text-sm text-gray-600">Qty: {{ $checkout->quantity }}</span>

                                        <span class="font-medium text-gray-900">₹{{ $checkout->product->price }}</span>
                                        <span>
                                            <a href="{{ route('cart.delete', $checkout->id) }}"
                                                class="text-pink-500 hover:underline text-sm flex items-center gap-1">
                                                <i class="fa-solid fa-trash"></i> Remove
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>



                    <dl class="space-y-3 text-gray-700">
                        <div class="flex justify-between">
                            <dt>Subtotal</dt>
                            <dd>₹{{ number_format($subtotal, 2) }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Shipping</dt>
                            <dd>₹500</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Tax</dt>
                            <dd>₹{{ number_format($tax, 2) }}</dd>
                        </div>
                        <div class="flex justify-between text-green-600">
                            <dt>Discount (JEWELLERY 2025)</dt>
                            <dd>- ₹2,000</dd>
                        </div>
                        <div class="flex justify-between font-semibold border-t pt-3 text-gray-900">
                            <dt>Total</dt>
                            <dd>₹{{ number_format($total, 2) }}</dd>
                        </div>
                    </dl>

                    <form action="{{ route('order.confirm') }}" method="POST" class="block mt-6">
                        @csrf
                        <button type="submit"
                            class="w-full bg-pink-600 text-white py-3 rounded shadow-md hover:bg-pink-700 transition font-medium text-center">
                            Complete Order <i class="fa-solid fa-lock ml-2"></i>
                        </button>
                    </form>
                    <div class="mt-4 text-center">
                        <p class="text-xs text-gray-500">
                            <i class="fas fa-shield-alt mr-1"></i>
                            Your payment information is secure and encrypted
                        </p>
                    </div>

                </div>

            </div>
        </div>
    </section>


    <script>
        // Address form toggle functionality
        const changeAddressBtn = document.getElementById("changeAddressBtn");
        const currentAddress = document.getElementById("currentAddress");
        const addressForm = document.getElementById("addressForm");
        const saveAddressBtn = document.getElementById("saveAddressBtn");
        const cancelAddressBtn = document.getElementById("cancelAddressBtn");

        changeAddressBtn.addEventListener("click", function() {
            currentAddress.classList.add("hidden");
            addressForm.classList.remove("hidden");
            changeAddressBtn.textContent = "Editing Address...";
            changeAddressBtn.classList.add("text-gray-500");
            changeAddressBtn.classList.remove(
                "text-pink-600",
                "hover:text-pink-700"
            );
        });

        saveAddressBtn.addEventListener("click", function() {
            // Update the current address display with form values
            const firstName = document.getElementById("firstName").value;
            const lastName = document.getElementById("lastName").value;
            const address = document.getElementById("address").value;
            const apartment = document.getElementById("apartment").value;
            const city = document.getElementById("city").value;
            const state = document.getElementById("state").value;
            const zipCode = document.getElementById("zipCode").value;
            const phone = document.getElementById("phone").value;

            const addressDisplay = `
                <div class="flex items-start justify-between">
                    <div>
                        <p class="font-medium text-gray-900">${firstName} ${lastName}</p>
                        <p class="text-gray-600">${address}</p>
                        ${
                          apartment
                            ? `<p class="text-gray-600">${apartment}</p>`
                            : ""
                        }
                        <p class="text-gray-600">${city}, ${state} ${zipCode}</p>
                        <p class="text-gray-600">United States</p>
                        <p class="text-gray-600 mt-2">Phone: ${phone}</p>
                    </div>
                    <div class="text-green-600">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            `;

            currentAddress.innerHTML = addressDisplay;
            currentAddress.classList.remove("hidden");
            addressForm.classList.add("hidden");
            changeAddressBtn.innerHTML =
                '<i class="fas fa-edit mr-1"></i>Change Address';
            changeAddressBtn.classList.remove("text-gray-500");
            changeAddressBtn.classList.add("text-pink-600", "hover:text-pink-700");
        });

        cancelAddressBtn.addEventListener("click", function() {
            currentAddress.classList.remove("hidden");
            addressForm.classList.add("hidden");
            changeAddressBtn.innerHTML =
                '<i class="fas fa-edit mr-1"></i>Change Address';
            changeAddressBtn.classList.remove("text-gray-500");
            changeAddressBtn.classList.add("text-pink-600", "hover:text-pink-700");
        });
    </script>

    <script>
        document.getElementById("changeAddressBtn").addEventListener("click", () => {
            document.getElementById("addressForm").classList.remove("hidden");
        });

        document.getElementById("cancelAddressBtn").addEventListener("click", () => {
            document.getElementById("addressForm").classList.add("hidden");
        });
    </script>

@endsection
