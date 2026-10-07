<section x-data="{ openForm: false }" class="relative bg-gradient-to-r from-pink-100 to-pink-100 py-16 text-center">
    <div class="max-w-5xl mx-auto px-6">
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


                <div class=" p-6 rounded border border-pink-200 bg-bray-50">
                    <div class="flex flex-col md:flex-row items-center justify-center gap-2 mb-1">
                        <i class="fa-solid fa-gem text-pink-500 text-2xl"></i>
                        <h3 class="text-xl font-bold text-gray-800">Jewelry Price Calculator</h3>
                    </div>

                    <div class="mb-4 text-center">
                        <p class="text-pink-700 font-sm">Know the worth of your sparkle!</p>
                        <p class="text-gray-600 text-xs mt-1">
                            Get an instant estimate for your favorite jewelry piece.
                        </p>

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
                            class="w-full bg-pink-600 hover:bg-pink-700 text-white py-2 rounded-lg font-semibold transition" id="calculate">
                            Calculate Price
                        </button>

                        <div
                            class="bg-pink-50 border border-pink-300 p-4 rounded-lg text-pink-700 text-sm mt-7 space-y-1">
                            <div class="flex justify-between items-center">
                                <p><strong>Gold Rate:</strong></p>
                                <p id="price">₹0 per gram</p>
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
                                <p><strong>GST (3%):</strong></p>
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
                $('#price').text('₹'+data.data.price);
                $('#making_charges').text('₹'+data.data.making_charges);
                $("#subtotal").text('₹'+data.data.subtotal);
                $("#gst").text(data.data.gst+"%");
                $("#total").text('₹'+data.data.totalChrges);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });

    });

});
</script>



