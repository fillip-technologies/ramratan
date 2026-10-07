 <div class="hidden md:flex justify-center bg-white shadow-sm py-3 space-x-8 text-gray-700 text-lg font-light">

     @foreach (App\Models\Category::with('subcate')->get() as $datas)
         <div x-data="{ open: false }" class="relative">
             <a href="#" @click.prevent="open = !open"
                 class="flex items-center space-x-1 hover:text-pink-500 cursor-pointer">
                 <span>{{ $datas->name }}</span>
                 <i class="fas fa-chevron-down text-sm transition-transform" :class="open ? 'rotate-180' : ''"></i>
             </a>
             <div x-show="open" @click.away="open = false" x-transition x-cloak
                 class="absolute top-full left-0 mt-2 w-48 bg-white shadow-lg border rounded z-20">
                 @foreach ($datas->subcate as $sub)
                     <a href="{{ route('sub.product.data',$sub->category_id) }}" class="block px-4 py-2 hover:bg-pink-50">{{ $sub->name }}</a>
                 @endforeach
             </div>
         </div>
     @endforeach
     <style>
         [x-cloak] {
             display: none !important;
         }
     </style>
