@extends('layouts.app')
@section('title', 'Product Details')
@section('content')
    @php
        $galleryImages = [];
        if (!empty($product_details->gallery_images)) {
            $decoded = json_decode($product_details->gallery_images, true);
            if (is_array($decoded)) {
                $galleryImages = $decoded;
            }
        }
    @endphp

    <section class="relative bg-white py-12">
        <div class="w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <div class="flex justify-center items-start md:sticky md:top-24 md:pl-10">

                    <div class="md:sticky md:top-24 w-full">
                        <section x-data="{
                            images: [
                                '{{ asset($product_details->image) }}',
                                @foreach ($galleryImages as $img)
                        '{{ asset($img) }}', @endforeach
                            ],
                            currentIndex: 0,
                            next() {
                                this.currentIndex = (this.currentIndex + 1) % this.images.length;
                            },
                            prev() {
                                this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
                            },
                            select(index) {
                                this.currentIndex = index;
                            }
                        }" class="w-full py-4 md:px-4">
                            <div class="grid grid-cols-1 gap-4">
                                <!-- Big Image -->
                                <div class="relative overflow-hidden rounded group cursor-pointer aspect-video w-full">
                                    <template x-if="images.length">
                                        <img :src="images[currentIndex]"
                                            class="absolute top-0 left-0 w-full h-full object-cover transition-all duration-500 rounded" />
                                    </template>

                                    <!-- Arrows (Mobile Only) -->
                                    <button @click.stop="prev()"
                                        class="md:hidden absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white rounded-full w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center z-10">
                                        <i class="fa-solid fa-chevron-left text-xs sm:text-base"></i>
                                    </button>
                                    <button @click.stop="next()"
                                        class="md:hidden absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white rounded-full w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center z-10">
                                        <i class="fa-solid fa-chevron-right text-xs sm:text-base"></i>
                                    </button>
                                </div>

                                <!-- Thumbnails (Desktop Only) -->
                                <div class="md:flex flex-wrap justify-center gap-4 hidden">
                                    <template x-for="(img, index) in images" :key="index">
                                        <div @click="select(index)"
                                            class="overflow-hidden rounded cursor-pointer border-2 transition-all duration-300"
                                            :class="currentIndex === index ? 'border-pink-500' : 'border-transparent'">
                                            <img :src="img" class="w-20 h-20 object-cover rounded" />
                                        </div>
                                    </template>
                                </div>

                                @php
                                    $videos = json_decode($product_details->product_video, true);
                                @endphp

                                <h2 class="text-lg font-semibold text-gray-800 mb-3">Product Video</h2>

                                @if (!empty($videos) && is_array($videos))
                                    @foreach ($videos as $video)
                                        <div class="mt-6 w-full">
                                            <div class="relative group rounded overflow-hidden shadow-md bg-gray-100">

                                                <!-- Video -->
                                                <video autoplay muted loop class="w-full h-auto object-cover">
                                                    <source src="{{ asset($video) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>

                                                <!-- Play Button Overlay -->
                                                <button
                                                    class="absolute inset-0 flex items-center justify-center bg-black/40 text-white text-4xl opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <i class="fa-solid fa-circle-play text-6xl"></i>
                                                </button>

                                            </div>

                                            <p class="text-xs text-gray-500 mt-2">
                                                *The video shows the real look, shine, and craftsmanship of the jewellery.
                                            </p>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-gray-500">No videos available.</p>
                                @endif




                            </div>
                        </section>
                    </div>
                </div>


                <div class="flex  px-4">
                    <div class="max-w-xl">

                        <!-- ====== Product Category & Rating ====== -->
                        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-2">
                            <div class="flex items-center">
                                <p class="uppercase tracking-wide text-pink-600">
                                    Jewellery / {{ $product_details->category->name ?? 'Jewellery' }}
                                </p>
                            </div>
                            <div class="flex items-center space-x-1">
                                <span class="text-pink-500">★★★★★</span>
                                <span class="text-sm text-gray-500">(5 Star)</span>
                            </div>
                        </div>

                        <!-- ====== Product Name ====== -->
                        <h2 class="font-serif text-3xl md:text-4xl font-semibold text-gray-800 mb-2">
                            {{ $product_details->name }}
                        </h2>

                        <!-- ====== SKU + Stock ====== -->
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center space-x-2">
                                <span id="sku" class="text-sm text-gray-500">
                                    SKU: {{ $product_details->variants->first()->sku ?? 'N/A' }}
                                </span>
                                <button onclick="copySKU()" class="text-pink-500 hover:text-pink-600 transition-colors">
                                    <i class="fa-regular fa-copy"></i>
                                </button>
                            </div>
                            <span class="text-sm text-green-600 font-medium">
                                In Stock ({{ $product_details->variants->first()->stock ?? 'Available' }})
                            </span>
                        </div>

                        <script>
                            function copySKU() {
                                const skuText = document.getElementById('sku').innerText.replace('SKU: ', '');
                                navigator.clipboard.writeText(skuText);
                            }
                        </script>

                        <!-- ====== Pricing ====== -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center justify-between">
                                <span class="text-2xl font-semibold text-gray-800 mr-4">
                                    ₹{{ number_format($product_details->price) }}
                                </span>
                                @if ($product_details->old_price)
                                    <span class="text-lg font-medium text-pink-500 mr-2 line-through">
                                        ₹{{ number_format($product_details->old_price) }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center mb-5">
                            <span class="text-xs text-gray-500 mr-4">(MRP Inclusive of all taxes)</span>
                        </div>

                        <!-- ====== Discount Offer ====== -->
                        <div
                            class="bg-pink-50 border border-pink-200 text-sm text-gray-700 p-3 rounded mb-5 flex space-x-2">
                            <div class="flex items-center justify-center">
                                <i class="fa-solid fa-wand-sparkles text-pink-600"></i>
                            </div>
                            <div>
                                <p>
                                    Get an immediate <strong>{{ $product_details->discount ?? 20 }}% discount</strong> today
                                    - save
                                    ₹{{ number_format($product_details->old_price - $product_details->price ?? 0) }}!
                                </p>
                            </div>
                        </div>

                        <!-- ====== Exchange Offer ====== -->
                        <div
                            class="bg-pink-50 border border-pink-200 text-sm text-gray-800 p-3 rounded mb-5 flex space-x-2">
                            <div class="flex items-center justify-center">
                                <i class="fa-solid fa-coins text-pink-600"></i>
                            </div>
                            <div>
                                <p>{{ $product_details->hylighter_two }}</p>
                            </div>
                        </div>

                        <!-- ====== Description ====== -->
                        <p class="text-gray-600 text-base leading-relaxed mb-6">
                            {!! $product_details->description !!}
                        </p>

                        <!-- ====== Highlights ====== -->
                        <ul class="space-y-3 mb-8 text-sm">
                            <li class="flex items-center gap-2 text-gray-800">
                                <i class="fa-solid fa-certificate text-pink-600"></i>
                                Certified HUID Hallmark
                            </li>
                            <li class="flex items-center gap-2 text-gray-800">
                                <i class="fa-solid fa-rotate-left text-pink-600"></i>
                                15-Day Money-Back Guarantee
                            </li>
                            <li class="flex items-center gap-2 text-gray-800">
                                <i class="fa-solid fa-shield-heart text-pink-600"></i>
                                1-Year Warranty
                            </li>
                            <li class="flex items-center gap-2 text-gray-800">
                                <i class="fa-solid fa-gift text-pink-600"></i>
                                Comes in a Premium Gift Box
                            </li>
                        </ul>

                        <!-- ====== Size Options ====== -->
                        <div class="mb-8">
                            <p class="text-gray-900 text-lg font-medium mb-3">Choose Option</p>
                            <div class="flex flex-wrap gap-3">
                                @foreach ($product_details->variants as $pd)
                                    <button
                                        class="px-4 py-2 border rounded-full text-gray-700 hover:bg-pink-50 hover:border-pink-400">
                                        {{ $pd->size }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <!-- ====== Quantity ====== -->
                        <div x-data="{ quantity: 1 }" class="flex items-center gap-4 mb-8">
                            <span class="text-gray-900 text-lg font-medium">Quantity:</span>
                            <div class="flex items-center border rounded">
                                <button @click="quantity = Math.max(1, quantity - 1)"
                                    class="px-3 py-2 text-gray-700 hover:bg-pink-100">-</button>
                                <input type="text" x-model="quantity" class="w-12 text-center border-x text-gray-900"
                                    readonly />
                                <button @click="quantity++" class="px-3 py-2 text-gray-700 hover:bg-pink-100">+</button>
                            </div>
                        </div>

                        <!-- ====== Delivery Info ====== -->
                        <p class="text-sm text-pink-600 mb-6">
                            <i class="fa-solid fa-truck"></i> Estimated delivery:
                            <span class="text-gray-800 font-medium">5-7 business days</span>
                        </p>

                        <!-- ====== Action Buttons ====== -->
                        <div class="flex flex-col sm:flex-row gap-4 mb-6">
                            @if (!empty(Auth::check()))
                                <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::check() ? Auth::id() : '' }}">
                                    <input type="hidden" name="product_id" value="{{ $product_details->id }}">
                                    <input type="hidden" name="quantity" x-bind:value="quantity" value="1">
                                    <button type="submit"
                                        class="w-full text-center bg-pink-600 text-white py-3 rounded text-lg shadow-md hover:bg-pink-700 transition">
                                        Add to Cart
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}"
                                    class="w-full text-center bg-pink-600 text-white py-3 rounded text-lg shadow-md hover:bg-pink-700 transition">
                                    Add to Cart
                                </a>
                            @endif

                            @if (!empty(Auth::check()))
                                <form action="{{ route('buy.now') }}" method="POST" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::check() ? Auth::id() : '' }}">
                                    <input type="hidden" name="product_id" value="{{ $product_details->id }}">
                                    <input type="hidden" name="quantity" x-bind:value="quantity">
                                    <button type="submit"
                                        class="w-full text-center border border-pink-600 text-pink-600 py-3 rounded text-lg hover:bg-pink-50 transition">
                                        Buy Now
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}"
                                    class="w-full text-center border border-pink-600 text-pink-600 py-3 rounded text-lg hover:bg-pink-50 transition">
                                    Buy Now
                                </a>
                            @endif
                        </div>

                        {{-- Product Specifications --}}
                        <div class="mx-auto mb-5 mt-5 ">
                            <!-- Modern Jewelry Card -->
                            <div
                                class="bg-white border border-pink-200 rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden">

                                <!-- Header -->
                                <div class="bg-gradient-to-r from-pink-100 to-pink-200 px-5 py-3 flex items-center gap-3">
                                    <div class="flex justify-center items-center w-8 h-8 bg-pink-50 rounded-full">
                                        <i class="fa-solid fa-gem text-pink-600 text-lg"></i>
                                    </div>
                                    <h3 class="text-sm font-semibold text-gray-700 tracking-wide">Specifications</h3>
                                </div>

                                <!-- Content -->
                                <div class="p-5 space-y-5">
                                    <!-- Info Row -->
                                    <div class="flex justify-around items-center text-center">
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase tracking-wide">Purity</p>
                                            <p class="text-sm font-medium text-gray-800">{{ $product_details->purity }} KT
                                            </p>
                                        </div>
                                        <div class="h-6 w-px bg-pink-200"></div>
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase tracking-wide">Color</p>
                                            <p class="text-sm font-medium text-gray-800">{{ $product_details->color }}</p>
                                        </div>
                                        <div class="h-6 w-px bg-pink-200"></div>
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase tracking-wide">Dimensions</p>
                                            <p class="text-xs font-medium text-gray-800">2 mm (Width)</p>
                                            <p class="text-xs font-medium text-gray-800">4 mm (Height)</p>
                                        </div>

                                    </div>

                                    <!-- Divider -->
                                    <div class="border-t border-pink-100"></div>

                                    <!-- Weight Info -->
                                    <div class="space-y-2 text-sm">


                                        <div class="flex justify-between items-center">
                                            <div class="flex items-center gap-2 text-gray-600">
                                                <i class="fa-solid fa-weight-scale text-pink-500"></i>
                                                <span>Net Weight</span>
                                            </div>
                                            <span
                                                class="font-medium text-gray-800">{{ $product_details->net_weight }}</span>
                                        </div>


                                        <div class="flex justify-between items-center">
                                            <div class="flex items-center gap-2 text-gray-600">
                                                <i class="fa-solid fa-weight-hanging text-pink-500"></i>
                                                <span>Gross Weight</span>
                                            </div>
                                            <span
                                                class="font-medium text-gray-800">{{ $product_details->gross_weight }}</span>
                                        </div>


                                        <div class="flex justify-between items-center">
                                            <div class="flex items-center gap-2 text-gray-600">
                                                <i class="fa-solid fa-gem text-pink-500"></i>
                                                <span>Diamond Weight</span>
                                            </div>
                                            <span
                                                class="font-medium text-gray-800">{{ $product_details->diamond_weight }}</span>
                                        </div>


                                        <div class="flex justify-between items-center">
                                            <div class="flex items-center gap-2 text-gray-600">
                                                <i class="fa-solid fa-cube text-pink-500"></i>
                                                <span>Stone Weight</span>
                                            </div>
                                            <span
                                                class="font-medium text-gray-800">{{ $product_details->stone_weight }}</span>
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>

                        @php
                            $price_br = App\Models\Pricebrdown::where('product_id', $product_details->id)->first();

                            $makingprice = (int) ($price_br->making_price ?? 0);
                            $material_price = (int) ($price_br->material_price ?? 0);
                            $discount = (int) ($price_br->brdiscount ?? 0);
                            $tax = (int) ($price_br->tax ?? 0);

                            $subtotal = $makingprice + $material_price;

                            $discountAmount = ($subtotal * $discount) / 100;
                            $afterDiscount = $subtotal - $discountAmount;

                            $taxAmount = ($afterDiscount * $tax) / 100;

                            $finalPrice = $afterDiscount + $taxAmount;

                            $originalTax = ($subtotal * $tax) / 100;
                            $originalTotal = $subtotal + $originalTax;
                        @endphp

                        {{-- Price Break --}}
                        <div class="mx-auto mb-5">
                            <!-- Price Breakdown Card -->
                            <div
                                class="bg-white border border-pink-200 rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden">

                                <!-- Header -->
                                <div class="bg-gradient-to-r from-pink-100 to-pink-200 px-5 py-3 flex items-center gap-3">
                                    <div class="flex justify-center items-center w-8 h-8 bg-pink-50 rounded-full">
                                        <i class="fa-solid fa-indian-rupee-sign text-pink-600 text-lg"></i>
                                    </div>
                                    <h3 class="text-sm font-semibold text-gray-700 tracking-wide">Price Breakdown</h3>
                                </div>

                                <!-- Content -->
                                <div class="p-5 space-y-3 text-sm">

                                    <!-- Gold Charges -->
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <i class="fa-solid fa-coins text-pink-500"></i>
                                            <span>{{ $price_br->material ?? ""}} Charges</span>
                                        </div>
                                        <span
                                            class="font-medium text-gray-800">₹{{ number_format($material_price) }}</span>
                                    </div>

                                    <!-- Making Charges -->
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <i class="fa-solid fa-hammer text-pink-500"></i>
                                            <span>Making Charges</span>
                                        </div>
                                        <div class="text-right flex items-start justify-center space-x-2">
                                            <p class="text-gray-400 line-through">₹{{ number_format($makingprice) }}</p>
                                            <p class="text-gray-800 font-medium">
                                                ₹{{ number_format($afterDiscount < $subtotal ? $afterDiscount - $material_price : $makingprice) }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Discount -->
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <i class="fa-solid fa-tag text-pink-500"></i>
                                            <span>Discount ({{ $discount }}%)</span>
                                        </div>
                                        <span class="text-green-600 font-medium">-
                                            ₹{{ number_format($discountAmount) }}</span>
                                    </div>

                                    <!-- Tax -->
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <i class="fa-solid fa-file-invoice text-pink-500"></i>
                                            <span>Tax ({{ $tax }}%)</span>
                                        </div>
                                        <span class="font-medium text-gray-800">₹{{ number_format($taxAmount) }}</span>
                                    </div>

                                    <!-- Divider -->
                                    <div class="border-t border-pink-100 my-2"></div>

                                    <!-- Grand Total -->
                                    <div class="flex justify-between items-center text-base font-semibold">
                                        <div class="flex items-center gap-2 text-gray-700">
                                            <i class="fa-solid fa-sack-dollar text-pink-600"></i>
                                            <span>Grand Total</span>
                                        </div>
                                        <div>
                                            <span
                                                class="text-green-600 font-bold">₹{{ number_format($finalPrice) }}</span>
                                            <span class="text-pink-600 text-xs font-medium line-through">
                                                ₹{{ number_format($originalTotal) }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-500 text-xs">(Includes gold price, making charges, and GST
                                            on gold)</span>
                                    </div>

                                </div>
                            </div>
                        </div>


                        {{-- Logo --}}
                        <div class="max-w-4xl mx-auto mb-5 flex flex-row items-center justify-between">

                            <!-- BIS -->
                            <div class="flex flex-col items-center text-center flex-1">
                                <img src="/images/BIS.png" alt="BIS Logo" class="h-5 object-contain" />
                                <p class="font-semibold text-gray-700 text-[0.6rem]">BIS</p>
                                <p class="text-gray-500 text-[0.5rem]">Hallmarked Jewellery</p>
                            </div>

                            <!-- Trust of Customers -->
                            <div class="flex flex-col items-center text-center flex-1">
                                <img src="/images/ramratan.png" alt="Ramratan Logo" class="h-5 object-contain" />
                                <p class="font-semibold text-gray-700 text-[0.6rem]">Trust of Customers</p>
                                <p class="text-gray-500 text-[0.5rem]">Spirit of Ramratan</p>
                            </div>

                            <!-- Certified -->
                            <div class="flex flex-col items-center text-center flex-1">
                                <img src="/images/certified.png" alt="Certified Logo" class="h-5 object-contain" />
                                <p class="font-semibold text-gray-700 text-[0.6rem]">100% Certified</p>
                                <p class="text-gray-500 text-[0.5rem]">by Ramratan</p>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

{{-- <script>
    function galleryComponent(images) {
        return {
            images,
            currentIndex: 0,
            get currentImage() {
                return this.images[this.currentIndex];
            },
            next() {
                this.currentIndex = (this.currentIndex + 1) % this.images.length;
            },
            prev() {
                this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
            },
            select(index) {
                this.currentIndex = index;
            }
        }
    }
</script> --}}
