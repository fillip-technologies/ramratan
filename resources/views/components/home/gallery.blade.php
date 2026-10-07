{{-- <div class="bg-gradient-to-b from-white to-rose-50 py-20">
  <!-- Section Heading -->
  <div class="text-center mb-14">
    <h2 class="text-3xl font-serif font-semibold text-gray-800">
      Our Gallery
    </h2>
    <p class="mt-3 text-gray-500 text-sm">
      A showcase of elegance and timeless craftsmanship
    </p>
  </div>

  <!-- Masonry Style Gallery -->
  <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

    <!-- Large Highlight Image -->
    <div class="relative overflow-hidden rounded shadow-lg group
                sm:col-span-2 sm:row-span-2">
      <img src="/images/s3.jpg" alt="Jewelry Highlight"
        class="w-full h-full object-cover transform transition duration-700 group-hover:scale-110" />
      <div
        class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
      </div>
    </div>

    <!-- Normal Image -->
    <div class="relative overflow-hidden rounded shadow-md group">
      <img src="/images/9644.jpg" alt="Jewelry"
        class="w-full h-64 object-cover transform transition duration-700 group-hover:scale-110" />
      <div class="absolute inset-0 bg-white/10 backdrop-blur-[1px] opacity-0 group-hover:opacity-100 transition"></div>
    </div>

    <!-- Tall Image -->
    <div class="relative overflow-hidden rounded shadow-md group
                sm:row-span-2">
      <img src="/images/052A9172 copy.jpg" alt="Jewelry"
        class="w-full h-full object-cover transform transition duration-700 group-hover:scale-110" />
      <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/20 opacity-0 group-hover:opacity-100 transition"></div>
    </div>

    <!-- Normal Image -->
    <div class="relative overflow-hidden rounded shadow-md group">
      <img src="/images/jewels-sparkle-golden-wedding-rings-lying-leather.jpg" alt="Jewelry"
        class="w-full h-64 object-cover transform transition duration-700 group-hover:scale-110" />
      <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition"></div>
    </div>

  </div>
</div> --}}



<div class="bg-gradient-to-b from-white to-rose-50 py-20">
    <!-- Section Heading -->
    <div class="text-center mb-14">
        <h2 class="text-3xl font-serif font-semibold text-gray-800">
            Our Gallery
        </h2>
        <p class="mt-3 text-gray-500 text-sm">
            A showcase of elegance and timeless craftsmanship
        </p>
    </div>

    <!-- Masonry Style Gallery -->
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        <!-- Large Highlight Image -->
        {{-- <div class="relative overflow-hidden rounded shadow-lg group
                sm:col-span-2 sm:row-span-2">
      <img src="/images/s3.jpg" alt="Jewelry Highlight"
        class="w-full h-full object-cover transform transition duration-700 group-hover:scale-110" />
      <div
        class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
      </div>
    </div> --}}

        @php
            $row = App\Models\ManageBv::first();

            if (is_null($row)) {
                $video = '';
            } else {
                $video = "uploads/banner/galleryVideo/{$row->gallery_video}";
            }
        @endphp

        <div class="relative overflow-hidden rounded shadow-lg group sm:col-span-2 sm:row-span-2">
            <video autoplay muted loop playsinline
                class="w-full h-full object-cover transform transition duration-700 group-hover:scale-110">
                <source src="{{ $video }}" type="video/mp4" />
                Your browser does not support the video tag.
            </video>

            <div
                class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
            </div>
        </div>

        <!-- Normal Image -->
        <div class="relative overflow-hidden rounded shadow-md group">
            <img src="/images/9644.jpg" alt="Jewelry"
                class="w-full h-64 object-cover transform transition duration-700 group-hover:scale-110" />
            <div class="absolute inset-0 bg-white/10 backdrop-blur-[1px] opacity-0 group-hover:opacity-100 transition">
            </div>
        </div>

        <!-- Tall Image -->
        <div class="relative overflow-hidden rounded shadow-md group
                sm:row-span-2">
            <img src="/images/052A9172 copy.jpg" alt="Jewelry"
                class="w-full h-full object-cover transform transition duration-700 group-hover:scale-110" />
            <div
                class="absolute inset-0 bg-gradient-to-b from-transparent to-black/20 opacity-0 group-hover:opacity-100 transition">
            </div>
        </div>

        <!-- Normal Image -->
        <div class="relative overflow-hidden rounded shadow-md group">
            <img src="/images/jewels-sparkle-golden-wedding-rings-lying-leather.jpg" alt="Jewelry"
                class="w-full h-64 object-cover transform transition duration-700 group-hover:scale-110" />
            <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition"></div>
        </div>

    </div>
</div>
