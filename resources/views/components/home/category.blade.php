<div class="hidden md:flex justify-center items-center bg-white/95 border-t border-gray-100/80 py-1.5 md:py-2 space-x-6 lg:space-x-10 text-gray-700">

    @foreach (App\Models\Category::with('subcate')->get() as $datas)
        <div x-data="{ open: false }" class="relative" @mouseenter="open = true" @mouseleave="open = false">
            <a href="#" @click.prevent="open = true"
                class="group flex items-center space-x-1.5 py-1 text-xs lg:text-[12.5px] font-medium uppercase tracking-[0.08em] text-gray-700 hover:text-rose-600 transition-colors duration-200 cursor-pointer">
                <span class="relative">
                    {{ $datas->name }}
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-rose-500 group-hover:w-full transition-all duration-300"></span>
                </span>
                @if ($datas->subcate->count() > 0)
                    <i class="fas fa-chevron-down text-[9px] text-gray-400 group-hover:text-rose-500 transition-transform duration-200" :class="open ? 'rotate-180 text-rose-500' : ''"></i>
                @endif
            </a>
            @if ($datas->subcate->count() > 0)
                <div x-show="open"
                     @click.away="open = false"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 -translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-1"
                     x-cloak
                     class="absolute top-full left-0 pt-3 min-w-[13rem] z-30">
                    <div class="relative bg-white shadow-xl ring-1 ring-black/5 rounded-xl py-2 max-h-80 overflow-y-auto">
                        @foreach ($datas->subcate as $sub)
                            <a href="{{ route('sub.product.data', $sub->category_id) }}"
                               class="block mx-1.5 px-3 py-2 rounded-lg text-[13px] normal-case tracking-normal font-medium text-gray-600 whitespace-nowrap hover:text-rose-600 hover:bg-rose-50 transition-colors">
                                {{ $sub->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    @endforeach
</div>
<style>
    [x-cloak] {
        display: none !important;
    }
</style>
