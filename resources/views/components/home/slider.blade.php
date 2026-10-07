 <section x-data="{
     activeSlide: 0,
     slides: [
         { image: '{{ asset('/images/s3.jpg') }}', heading: 'Stunning Rings', subheading: 'Shine with confidence' },
         { image: '{{ asset('/images/s2.jpg') }}', heading: 'Luxurious Bracelets', subheading: 'Perfect for every occasion' },
         { image: '{{ asset('/images/s1.jpg') }}', heading: 'Elegant Brooch', subheading: 'Discover timeless beauty' },
     ],
     startCarousel() { setInterval(() => { this.activeSlide = (this.activeSlide + 1) % this.slides.length; }, 5000); }
 }" x-init="startCarousel" class="relative w-full h-[50vh] md:h-[80vh] overflow-hidden">

     <template x-for="(slide, index) in slides" :key="index">
         <div x-show="activeSlide === index" x-transition:enter="transition-opacity duration-1000"
             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             class="absolute top-0 left-0 w-full h-full z-0">
             <img :src="slide.image" alt="Slide" class="w-full h-full object-cover" />
             <div class="absolute inset-0 bg-black/25"></div>
             <div class="absolute bottom-20 left-10 text-white space-y-2">
                 <h2 class="text-3xl md:text-5xl font-bold" x-text="slide.heading"></h2>
                 <p class="text-lg md:text-2xl" x-text="slide.subheading"></p>
             </div>
         </div>
     </template>


     <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 flex space-x-3 z-10">
         <template x-for="(slide, index) in slides" :key="index">
             <button @click="activeSlide = index" :class="activeSlide === index ? 'bg-white' : 'bg-white/50'"
                 class="w-3 h-3 rounded-full transition-all"></button>
         </template>
     </div>

 </section>

 <style>
     [x-cloak] {
         display: none !important;
     }
 </style>
