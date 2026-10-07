@php
    $goldRates = app(\App\Services\GoldRateService::class)->rates();
    $fmt = fn($n) => '₹' . number_format(round($n), 0, '.', ',');
    $updated = $goldRates
        ? \Illuminate\Support\Carbon::parse($goldRates['updated_at'])->timezone('Asia/Kolkata')->format('d M, h:i A')
        : null;
@endphp

{{-- Discreet gold-rate dock, pinned to the left edge. Click (or hover on desktop) to expand. --}}
<div id="goldRateDock" x-data="{ open: false }" @click.away="open = false" @mouseenter="if (window.matchMedia('(hover: hover)').matches) open = true"
    @mouseleave="if (window.matchMedia('(hover: hover)').matches) open = false"
    class="fixed right-0 top-36 z-40 select-none">

    <div class="gold-dock overflow-hidden rounded-l-2xl border border-r-0 border-pink-200 bg-white/95 backdrop-blur-md text-gray-700 shadow-lg shadow-pink-200/60 transition-all duration-500 ease-out"
        :class="open ? 'w-52 sm:w-56' : 'w-[7.25rem] sm:w-32'">

        <!-- Always-visible header: tap target -->
        <button type="button" @click="open = !open" :aria-expanded="open" aria-label="Today's gold rate"
            class="w-full flex items-center gap-2 px-3 py-2.5 text-left">
            <span class="relative flex h-1.5 w-1.5 shrink-0">
                <span class="absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-60 animate-ping"></span>
                <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-rose-500"></span>
            </span>

            <span class="flex-1 min-w-0">
                <span class="block text-[0.55rem] uppercase tracking-[0.22em] text-pink-700 leading-none font-medium"
                    x-text="open ? 'Today\'s gold rate' : '24K · per gram'"></span>
                <span x-show="!open" class="block mt-1 text-[0.95rem] leading-none font-semibold text-rose-600"
                    data-gold-rate="24K">{{ $goldRates ? $fmt($goldRates['24K']) : 'N/A' }}</span>
            </span>

            <i class="fa-solid fa-chevron-left text-[0.6rem] text-pink-400 transition-transform duration-500"
                :class="open && 'rotate-180'"></i>
        </button>

        <!-- Expanded details -->
        <div x-show="open" x-cloak x-transition:enter="transition duration-500" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="mx-3 border-t border-pink-100"></div>
            <ul class="px-3 py-2 space-y-1.5 bg-pink-50/70">
                @foreach (['24K', '22K', '18K'] as $k)
                    <li class="flex items-baseline justify-between">
                        <span class="text-xs font-semibold text-pink-700">{{ $k }}</span>
                        <span class="text-sm font-semibold text-gray-800"
                            data-gold-rate="{{ $k }}">{{ $goldRates ? $fmt($goldRates[$k]) : 'N/A' }}</span>
                    </li>
                @endforeach
            </ul>
            @if ($updated)
                <p class="px-3 py-1.5 text-[0.6rem] bg-pink-50/70 text-gray-400">Updated {{ $updated }} IST</p>
            @endif
        </div>
    </div>
</div>

<style>
    [x-cloak] {
        display: none !important;
    }

    @media (prefers-reduced-motion: reduce) {
        #goldRateDock .gold-dock { transition: none; }
        #goldRateDock .animate-ping { animation: none; }
    }
</style>

<script>
    // Re-read the cached rate now and then (this never hits GoldAPI; the server controls that).
    setInterval(() => {
        fetch("{{ route('gold.rates') }}")
            .then(r => r.ok ? r.json() : Promise.reject())
            .then(res => {
                document.querySelectorAll('[data-gold-rate]').forEach(el => {
                    el.textContent = '₹' + Math.round(res.data[el.dataset.goldRate]).toLocaleString('en-IN');
                });
            })
            .catch(() => {});
    }, 60 * 60 * 1000);
</script>
