 <style>
     /* Hide scrollbar */
     .scrollbar-hide {
         -ms-overflow-style: none;
         scrollbar-width: none;
     }

     .scrollbar-hide::-webkit-scrollbar {
         display: none;
     }

     /* Smooth transitions */
     .carousel-item {
         transition: transform 0.3s ease;
     }

     /* Hide buttons on small screens if needed */
     @media (max-width: 640px) {
         .carousel-btn {
             display: none;
         }
     }
 </style>

@php
    $row = App\Models\ManageBv::first();
    $sliderItems = [];

    if ($row && $row->mines_video) {

        // Case 1: Already an array -> use directly
        if (is_array($row->mines_video)) {
            $videos = $row->mines_video;
        }

        // Case 2: JSON array stored in DB
        elseif (is_string($row->mines_video) && str_starts_with(trim($row->mines_video), '[')) {
            $videos = json_decode($row->mines_video, true) ?? [];
        }
        else {
            $videos = [$row->mines_video];
        }


        foreach ($videos as $video) {
            $video = is_string($video) ? $video : ''; 

            $clean = str_replace(['uploads/banner/videos/', '/uploads/banner/videos/'], '', $video);
            $sliderItems[] = asset('uploads/banner/videos/' . $clean);
        }
    }
@endphp


<section class="bg-white py-16">
    <div class="container mx-auto px-4">

        <div class="text-center mb-12">
            <h2 class="text-3xl font-serif font-semibold text-gray-800">The Ramraten Mines</h2>
            <p class="text-gray-500 mt-2 text-sm">Our handpicked selection just for you</p>
        </div>

        <div class="relative">

            <div id="carousel" class="overflow-x-auto scrollbar-hide snap-x snap-mandatory">
                <div id="carousel-inner" class="flex gap-4 px-2 md:px-12">

                    @foreach ($sliderItems as $video)
                        <div class="carousel-item flex-shrink-0 w-4/5 sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 snap-start">
                            <div class="rounded shadow-lg overflow-hidden bg-white h-[50vh] sm:h-[70vh] relative">

                                <video autoplay muted loop playsinline
                                       class="w-full h-full object-cover">
                                    <source src="{{ $video }}" type="video/mp4">
                                </video>

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>
</section>
 <script>
     document.addEventListener('DOMContentLoaded', function() {
         const carousel = document.getElementById("carousel");
         const carouselInner = document.getElementById("carousel-inner");
         const prevBtn = document.getElementById("prevBtn");
         const nextBtn = document.getElementById("nextBtn");

         // Get the first carousel item to calculate width
         const carouselItems = document.querySelectorAll('.carousel-item');
         if (carouselItems.length === 0) return;

         // Calculate scroll amount based on item width
         function getScrollAmount() {
             const itemStyle = window.getComputedStyle(carouselItems[0]);
             const itemWidth = carouselItems[0].offsetWidth +
                 parseInt(itemStyle.marginLeft) +
                 parseInt(itemStyle.marginRight);
             return itemWidth;
         }

         // Scroll to the previous item
         prevBtn.addEventListener("click", () => {
             const scrollAmount = getScrollAmount();
             carousel.scrollBy({
                 left: -scrollAmount,
                 behavior: "smooth",
             });
         });

         // Scroll to the next item
         nextBtn.addEventListener("click", () => {
             const scrollAmount = getScrollAmount();
             carousel.scrollBy({
                 left: scrollAmount,
                 behavior: "smooth",
             });
         });

         // Touch/swipe support for mobile
         let isDown = false;
         let startX;
         let scrollLeft;
         let velocity = 0;
         let frame;
         let timestamp;
         let ticker;

         carousel.addEventListener('mousedown', (e) => {
             isDown = true;
             startX = e.pageX - carousel.offsetLeft;
             scrollLeft = carousel.scrollLeft;
             velocity = 0;
             frame = scrollLeft;
             timestamp = Date.now();
             clearInterval(ticker);
             ticker = setInterval(trackVelocity, 100);
         });

         carousel.addEventListener('mouseleave', () => {
             isDown = false;
             clearInterval(ticker);
             snapToItem();
         });

         carousel.addEventListener('mouseup', () => {
             isDown = false;
             clearInterval(ticker);
             snapToItem();
         });

         carousel.addEventListener('mousemove', (e) => {
             if (!isDown) return;
             e.preventDefault();
             const x = e.pageX - carousel.offsetLeft;
             const walk = (x - startX) * 2; // Scroll-fast
             carousel.scrollLeft = scrollLeft - walk;
         });

         // Touch events
         carousel.addEventListener('touchstart', (e) => {
             isDown = true;
             startX = e.touches[0].pageX - carousel.offsetLeft;
             scrollLeft = carousel.scrollLeft;
             velocity = 0;
             frame = scrollLeft;
             timestamp = Date.now();
             clearInterval(ticker);
             ticker = setInterval(trackVelocity, 100);
         }, {
             passive: false
         });

         carousel.addEventListener('touchend', () => {
             isDown = false;
             clearInterval(ticker);
             snapToItem();
         }, {
             passive: false
         });

         carousel.addEventListener('touchmove', (e) => {
             if (!isDown) return;
             e.preventDefault();
             const x = e.touches[0].pageX - carousel.offsetLeft;
             const walk = (x - startX) * 2;
             carousel.scrollLeft = scrollLeft - walk;
         }, {
             passive: false
         });

         // Track velocity for momentum scrolling
         function trackVelocity() {
             const now = Date.now();
             const elapsed = now - timestamp;
             const distance = carousel.scrollLeft - frame;
             velocity = distance / elapsed;
             frame = carousel.scrollLeft;
             timestamp = now;
         }

         // Snap to nearest item after scrolling
         function snapToItem() {
             const scrollAmount = getScrollAmount();
             const snapPosition = Math.round(carousel.scrollLeft / scrollAmount) * scrollAmount;

             // Apply some momentum based on velocity
             let momentumScroll = 0;
             if (Math.abs(velocity) > 0.5) {
                 momentumScroll = velocity * 200;
                 momentumScroll = Math.max(-scrollAmount, Math.min(scrollAmount, momentumScroll));
             }

             carousel.scrollTo({
                 left: snapPosition + momentumScroll,
                 behavior: 'smooth'
             });
         }

         // Handle window resize
         window.addEventListener('resize', function() {
             // You could add logic to adjust the carousel on resize if needed
         });
     });
 </script>
