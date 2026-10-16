@php
    $goldRates = app(\App\Services\GoldRateService::class)->rates();
    $fmt = fn($n) => '₹' . number_format(round($n), 0, '.', ',');
    $updated = $goldRates
        ? \Illuminate\Support\Carbon::parse($goldRates['updated_at'])->timezone('Asia/Kolkata')->format('d M, h:i A')
        : null;
@endphp

{{-- Gold-rate ribbon: always visible under the header on the landing page. --}}
<section id="goldRateRibbon" aria-label="Today's gold rate"
    class="relative bg-gradient-to-r from-stone-900 via-rose-950 to-stone-900 text-amber-50 border-b border-amber-400/30">
    <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-amber-300/70 to-transparent"></div>

    <div class="mx-auto max-w-6xl px-3 sm:px-6 py-2 sm:py-2.5 flex items-center justify-between sm:justify-center gap-3 sm:gap-8">

        <!-- Label -->
        <div class="hidden sm:flex items-center gap-2 shrink-0">
            <span class="relative flex h-2 w-2">
                <span class="absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-70 animate-ping"></span>
                <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-400"></span>
            </span>
            <span class="text-[11px] uppercase tracking-[0.25em] font-semibold text-amber-300">Today's Gold Rate</span>
            <span class="text-[10px] text-amber-100/50">/ gram</span>
        </div>

        <span class="hidden sm:block h-5 w-px bg-amber-300/25"></span>

        <!-- Rates -->
        <ul class="flex flex-1 sm:flex-none items-center justify-around sm:justify-start gap-2 sm:gap-8">
            @foreach (['24K', '22K', '18K'] as $k)
                <li class="flex items-baseline gap-1.5 sm:gap-2">
                    <span class="text-[10px] sm:text-xs font-bold text-amber-300 tracking-wider">{{ $k }}</span>
                    <span class="text-sm sm:text-base font-semibold text-white tabular-nums"
                        data-gold-rate="{{ $k }}">{{ $goldRates ? $fmt($goldRates[$k]) : 'N/A' }}</span>
                </li>
            @endforeach
        </ul>

        <span class="hidden md:block h-5 w-px bg-amber-300/25"></span>

        <!-- Meta + CTA -->
        <div class="flex items-center gap-3 shrink-0">
            @if ($updated)
                <span class="hidden md:inline text-[10px] text-amber-100/50">Updated {{ $updated }} IST</span>
            @endif
            <a href="{{ route('design.create') }}#price-calculator"
                class="hidden sm:inline-flex items-center gap-1.5 rounded-full border border-amber-300/50 px-3 py-1 text-[11px] font-medium text-amber-200 hover:bg-amber-300 hover:text-stone-900 transition-colors">
                Price Calculator <i class="fa-solid fa-arrow-right text-[9px]"></i>
            </a>
        </div>
    </div>

    {{-- Mobile caption --}}
    <p class="sm:hidden pb-1.5 -mt-1 text-center text-[9px] uppercase tracking-[0.2em] text-amber-100/50">
        Gold rate per gram{{ $updated ? ' · ' . $updated : '' }}
    </p>
</section>

<style>
    @media (prefers-reduced-motion: reduce) {
        #goldRateRibbon .animate-ping { animation: none; }
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
