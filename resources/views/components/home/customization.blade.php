{{-- {{-- <div class="flex flex-col md:flex-row relative overflow-hidden">
    <!-- Left Side - Image Section -->
    <div class="flex-1 relative md:py-32">
        <video src="/images/Nearby-Store-Video.mp4" autoplay muted loop playsinline
            class="w-full h-full absolute md:left-auto md:right-[-80px] md:top-1/2 md:-translate-y-1/2 z-10 scale-90 object-cover"></video>
    </div>


    <!-- Right Side - Content Section -->
    <div class="flex-1 bg-rose-50 text-white flex items-center relative z-0">
        <div class="px-6 md:px-28 py-16">
            <div class="w-full mx-auto px-6">
                <!-- Banner Content -->
                <h2 class="text-2xl md:text-3xl font-serif font-semibold text-gray-800">
                    Design Your Own Jewellery
                </h2>
                <p class="mt-3 text-gray-600 text-sm md:text-base">
                    Have a design in mind? Let our artisans craft your dream piece — just for you.
                </p>
                <button @click="openForm = true"
                    class="mt-6 px-6 py-3 bg-pink-700 hover:bg-pink-800 text-white text-sm md:text-base rounded-full shadow-md transition duration-300">
                    Create Your Design
                </button>

            </div>
        </div>
    </div>
</div> --}}
@php
    $row = App\Models\ManageBv::first();

    if (is_null($row)) {
        $video = '';
    } else {
        $video = "uploads/banner/singleVideo/{$row->during_video}";
    }
@endphp


<section x-data="{ openForm: false }" class="relative bg-gradient-to-r from-pink-100 to-pink-100 text-center">
    {{-- <div class="w-full mx-auto px-6">
        <!-- Banner Content -->
        <h2 class="text-2xl md:text-3xl font-serif font-semibold text-gray-800">
            Design Your Own Jewellery
        </h2>
        <p class="mt-3 text-gray-600 text-sm md:text-base">
            Have a design in mind? Let our artisans craft your dream piece — just for you.
        </p>
        <button @click="openForm = true"
            class="mt-6 px-6 py-3 bg-pink-700 hover:bg-pink-800 text-white text-sm md:text-base rounded-full shadow-md transition duration-300">
            Create Your Design
        </button>

    </div> --}}


    <div class="w-full mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 items-center py-8 px-6 md:px-0">

        <!-- Video Section -->
        <div class="w-full flex justify-center">
            <div class="relative  overflow-hidden shadow-lg w-full aspect-video bg-black">
              
                <video autoplay muted loop playsinline class="w-full h-full object-cover">
                    <source src="{{ $video }}" type="video/mp4" />
                </video>


            </div>
        </div>

        <!-- Content Section -->
        <div class="flex flex-col justify-center text-center md:text-left">
            <h2 class="text-xl md:text-4xl font-serif font-semibold text-gray-800 leading-snug">
                Get Your Favorite Design
            </h2>
            <p class="mt-4 text-gray-600 text-sm md:text-base leading-relaxed max-w-md">
                Have a design in mind? Let our expert artisans craft your dream piece — made uniquely for you with
                precision and elegance.
            </p>
            <button @click="openForm = true"
                class="animate-bounce mt-6 w-fit mx-auto md:mx-0 px-8 py-3 bg-gradient-to-r from-rose-600 to-pink-500 hover:from-rose-700 hover:to-pink-600
                   text-white text-sm md:text-base rounded-full shadow-md transition duration-300 transform hover:scale-105">
                Create Your Design
            </button>
        </div>

    </div>





    <!-- Modal -->
    <div x-show="openForm" x-transition.opacity x-cloak
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 overflow-y-auto">
        <div @click.away="openForm = false"
            class="bg-white w-11/12 md:w-3/4 lg:w-3/4 p-6 rounded-2xl shadow-xl relative max-h-[90vh] overflow-y-auto">

            <!-- Close Button -->
            <button @click="openForm = false" class="absolute top-3 right-3 hover:text-gray-400 text-pink-500 text-3xl">
                &times;
            </button>

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mt-8">

                <!-- LEFT: Jewelry Price Calculator -->
                <div class=" p-6 rounded border border-pink-200 bg-bray-50">
                    <div class="flex flex-col md:flex-row items-center justify-center gap-2 mb-1">
                        <i class="fa-solid fa-gem text-pink-500 text-2xl"></i>
                        <h3 class="text-xl font-bold text-gray-800">Jewelry Price Calculator</h3>
                    </div>

                    <!-- Tagline section -->
                    <div class="mb-4 text-center">
                        <p class="text-pink-700 font-sm">Know the worth of your sparkle!</p>
                        <p class="text-gray-600 text-xs mt-1">
                            Get an instant estimate for your favorite jewelry piece.
                        </p>

                    </div>

                    <div class="mb-4 p-4 rounded-lg bg-pink-50 border border-pink-100">
                        <p class="text-pink-700 font-medium mb-2">Today's Gold Price</p>

                        <div class="grid grid-cols-3 gap-4 text-center">
                            <div>
                                <p id="gold24" class="text-gray-800 text-sm font-semibold">Loading...</p>
                                <p class="text-gray-600 text-xs">per gram (24K)</p>
                            </div>

                            <div>
                                <p id="gold22" class="text-gray-800 text-sm font-semibold">Loading...</p>
                                <p class="text-gray-600 text-xs">per gram (22K)</p>
                            </div>

                            <div>
                                <p id="gold18" class="text-gray-800 text-sm font-semibold">Loading...</p>
                                <p class="text-gray-600 text-xs">per gram (18K)</p>
                            </div>
                        </div>
                    </div>
                    @php
                        $getdata = App\Models\PriceSetting::all();
                    @endphp

                    <div class="text-left space-y-3">
                        <div>
                            <label class="text-sm font-semibold text-gray-700">Select Product:</label>
                            <select
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-pink-400 focus:outline-none"
                                name="product_get">
                                <option>Select Product</option>
                                @foreach ($getdata as $name)
                                    <option data-name="{{ $name->name }}">{{ $name->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-700">Enter Weight (grams):</label>
                            <input type="number" name="weight" placeholder="Enter weight in grams" id="weight"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-pink-400 focus:outline-none">
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-700">Select Purity:</label>
                            <select
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-pink-400 focus:outline-none"
                                name="purity_get">
                                <option value="">Choose Purity</option>

                                @foreach ($getdata as $item)
                                    @php
                                        $purityArray = json_decode($item->purity, true);
                                    @endphp

                                    @if (!empty($purityArray))
                                        @foreach ($purityArray as $pur)
                                            <option data-purity="{{ $pur }}">{{ $pur }}</option>
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                        </div>


                        <button
                            class="w-full bg-pink-600 hover:bg-pink-700 text-white py-2 rounded-lg font-semibold transition"
                            id="calculate">
                            Calculate Price
                        </button>

                        <div
                            class="bg-pink-50 border border-pink-300 p-4 rounded-lg text-pink-700 text-sm mt-7 space-y-1">
                            <div class="flex justify-between items-center">
                                <p><strong>Gold Rate:</strong></p>
                                <p id="price">₹0 per gram</p>
                            </div>
                            <div class="flex justify-between items-center">
                                <p><strong>Gold Value:</strong></p>
                                <p id="gold_value">₹0</p>
                            </div>
                            <div class="flex justify-between items-center">
                                <p><strong>Making Charge:</strong></p>
                                <p id="making_charges">₹0</p>
                            </div>
                            <div class="flex justify-between items-center">
                                <p><strong>Subtotal:</strong></p>
                                <p id="subtotal">₹0</p>
                            </div>
                            <div class="flex justify-between items-center">
                                <p><strong id="gst_label">GST (3%):</strong></p>
                                <p id="gst">₹0</p>
                            </div>
                            <div class="flex justify-between items-center">
                                <p><strong>Total Price:</strong></p>
                                <p id="total"><strong>₹0</strong></p>
                            </div>
                            {{-- <p><strong>Gold Rate:</strong> ₹0 per gram</p>
                            <p><strong>Making Charge:</strong> ₹0</p>
                            <p><strong>Subtotal:</strong> ₹0</p>
                            <p><strong>GST (3%):</strong> ₹0</p>
                            <p><strong>Total Price:</strong> ₹0</p> --}}
                        </div>
                    </div>




                    <div class=" text-center">

                        <p class="text-gray-500 text-xs mt-2">
                            Transparent pricing. Trusted craftsmanship. Tailored for you.
                        </p>
                    </div>

                </div>

                <!-- RIGHT: Customization Form -->
                <div class="text-left">
                    <h3 class="text-xl text-center font-semibold text-gray-800 mb-1">Jewellery Customization Form</h3>
                    <p class="text-xs md:text-sm text-pink-600 mb-4 text-center">
                        Fill out the details below <br> our expert team will contact you soon to bring your design to
                        life.
                    </p>
                    <form class="space-y-4" action="{{ route('add.Customization') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label class="text-sm font-semibold text-gray-700">Full Name</label>
                            <input type="text" placeholder="Enter your name" name="name"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-pink-400 focus:outline-none">
                            @error('name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-700">Contact Details</label>
                            <input type="text" placeholder="Enter mobile number" name="contact"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-pink-400 focus:outline-none">
                            @error('contact')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-700">Material Preference</label>
                            <input type="text" placeholder="Gold, Silver, Diamond..." name="material"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-pink-400 focus:outline-none">
                            @error('material')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-700">Description / Custom Request</label>
                            <textarea placeholder="Describe your dream jewellery..." name="description"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-pink-400 focus:outline-none h-24"></textarea>
                            @error('description')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-700">Upload Reference Image</label>
                            <input type="file" name="images"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 cursor-pointer focus:ring-2 focus:ring-pink-400 focus:outline-none">
                            @error('images')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full bg-pink-600 hover:bg-pink-700 text-white font-semibold py-2 rounded-lg transition duration-300">
                            Submit Request
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>


<script>
    const inr = n => '₹' + Number(n).toLocaleString('en-IN', {
        maximumFractionDigits: 2
    });

    fetch("{{ route('gold.rates') }}")
        .then(r => r.ok ? r.json() : Promise.reject(r.status))
        .then(res => {
            ['24', '22', '18'].forEach(k => {
                document.getElementById('gold' + k).innerText = inr(Math.round(res.data[k + 'K']));
            });
        })
        .catch(() => {
            ['24', '22', '18'].forEach(k => document.getElementById('gold' + k).innerText = 'N/A');
        });
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready(function() {
        $("#calculate").click(function(e) {
            e.preventDefault();
            var product = $("select[name='product_get'] option:selected").data('name');
            var purity = $("select[name='purity_get'] option:selected").data('purity');
            var weight = $("#weight").val();

            if (!product || !purity || !weight) {
                alert("Please fill all fields before calculating!");
                return;
            }

            $.ajax({
                type: 'GET',
                url: "{{ route('calculate.price') }}",
                data: {
                    product: product,
                    purity: purity,
                    weight: weight
                },
                success: function(data) {
                    const d = data.data;
                    $('#price').text(inr(d.price) + ' per gram');
                    $('#gold_value').text(inr(d.gold_value));
                    $('#making_charges').text(inr(d.making_charges));
                    $('#subtotal').text(inr(d.subtotal));
                    $('#gst_label').text('GST (' + d.gst_percent + '%):');
                    $('#gst').text(inr(d.gst));
                    $('#total').html('<strong>' + inr(d.totalChrges) + '</strong>');
                },
                error: function(xhr) {
                    const msg = xhr.responseJSON && xhr.responseJSON.message;
                    alert(msg || 'Could not calculate the price right now. Please try again.');
                }
            });

        });

    });
</script>
