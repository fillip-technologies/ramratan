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


<section class="relative bg-gradient-to-r from-pink-100 to-pink-100 text-center">
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
            <a href="{{ route('design.create') }}"
                class="animate-bounce mt-6 w-fit mx-auto md:mx-0 px-8 py-3 bg-gradient-to-r from-rose-600 to-pink-500 hover:from-rose-700 hover:to-pink-600
                   text-white text-sm md:text-base rounded-full shadow-md transition duration-300 transform hover:scale-105">
                Create Your Design
            </a>
        </div>

    </div>





</section>
