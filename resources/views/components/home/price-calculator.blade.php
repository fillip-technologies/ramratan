@php
    $calcPieces = \App\Models\PriceSetting::all()->map(fn ($p) => [
        'name' => $p->name,
        'purities' => array_values((array) json_decode($p->purity, true)),
    ])->values();
    $calcRates = app(\App\Services\GoldRateService::class)->rates();
@endphp

@if ($calcPieces->isNotEmpty())
    <section id="price-calculator" class="bg-white py-16 md:py-20" x-data="goldCalculator(@js($calcPieces), @js($calcRates), '{{ route('calculate.price') }}', '{{ route('design.create') }}')">
        <div class="max-w-5xl mx-auto px-5 sm:px-8">

            <div class="text-center">
                <h2 class="text-3xl font-semibold text-gray-800 tracking-wide">What Will It Cost?</h2>
                <p class="mt-2 text-gray-500 text-sm">Pick a piece, set the weight and see the price at today's gold rate</p>
            </div>

            <div class="mt-12 grid grid-cols-1 md:grid-cols-5 overflow-hidden rounded-lg border border-pink-200 shadow-sm">

                {{-- Inputs --}}
                <div class="md:col-span-3 p-6 sm:p-9 space-y-9">

                    {{-- Piece --}}
                    <div>
                        <p class="text-[0.7rem] uppercase tracking-[0.2em] text-pink-700 font-medium">1 · Piece</p>
                        <div class="mt-3 flex flex-wrap gap-2">
                            <template x-for="p in pieces" :key="p.name">
                                <button type="button" @click="setPiece(p.name)" x-text="p.name"
                                    :class="piece === p.name ? 'bg-pink-700 border-pink-700 text-white' : 'bg-white border-pink-200 text-gray-600 hover:border-pink-400'"
                                    class="rounded-full border px-5 py-1.5 text-sm transition"></button>
                            </template>
                        </div>
                    </div>

                    {{-- Purity: hallmark stamps --}}
                    <div>
                        <p class="text-[0.7rem] uppercase tracking-[0.2em] text-pink-700 font-medium">2 · Purity</p>
                        <div class="mt-3 grid grid-cols-3 gap-3">
                            <template x-for="k in purities" :key="k">
                                <button type="button" @click="purity = k"
                                    :class="purity === k ? 'bg-pink-50 border-pink-700 ring-1 ring-pink-700' : 'bg-white border-pink-200 hover:border-pink-400'"
                                    class="relative rounded-md border px-3 py-3 text-left transition">
                                    <span class="block text-xl font-semibold leading-none"
                                        :class="purity === k ? 'text-pink-700' : 'text-gray-700'" x-text="k"></span>
                                    <span class="mt-1.5 block text-[0.65rem] tracking-widest text-gray-400"
                                        x-text="hallmark[k] ? 'HALLMARK ' + hallmark[k] : ''"></span>
                                    <span class="mt-1 block text-xs text-gray-500" x-text="rateOf(k)"></span>
                                </button>
                            </template>
                        </div>
                    </div>

                    {{-- Weight: scale --}}
                    <div>
                        <div class="flex items-end justify-between">
                            <p class="text-[0.7rem] uppercase tracking-[0.2em] text-pink-700 font-medium">3 · Weight</p>
                            <label class="flex items-baseline gap-1.5 border-b border-pink-300 focus-within:border-pink-700">
                                <input type="number" min="0.5" max="10000" step="0.5" x-model="weight"
                                    aria-label="Weight in grams"
                                    class="w-20 bg-transparent border-0 p-0 text-right text-2xl font-semibold text-gray-800 focus:ring-0 focus:outline-none">
                                <span class="text-sm text-gray-500">grams</span>
                            </label>
                        </div>

                        <div class="mt-5">
                            <input type="range" min="0.5" max="50" step="0.5" x-model="weight" aria-label="Weight slider"
                                class="calc-range w-full" :style="`--fill:${Math.min(100, Math.max(0, (weight - 0.5) / 49.5 * 100))}%`">
                            <div class="relative mt-1 h-3">
                                <template x-for="t in [0.5, 10, 20, 30, 40, 50]" :key="t">
                                    <span class="absolute -translate-x-1/2 text-[0.65rem] text-gray-400"
                                        :style="`left:${(t - 0.5) / 49.5 * 100}%`" x-text="t"></span>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Result --}}
                <div class="md:col-span-2 bg-pink-700 text-white p-6 sm:p-9 flex flex-col">
                    <p class="text-[0.7rem] uppercase tracking-[0.2em] text-pink-200">Approx. total</p>
                    <p class="mt-2 text-4xl sm:text-[2.6rem] font-semibold leading-none tabular-nums transition-opacity"
                        :class="loading && 'opacity-60'" x-text="totalText"></p>

                    {{-- Where the money goes --}}
                    <div class="mt-7">
                        <div class="flex h-2.5 w-full overflow-hidden rounded-full bg-white/15">
                            <div class="bg-white transition-all duration-500" :style="`width:${share('gold_value')}%`"></div>
                            <div class="bg-pink-300 transition-all duration-500" :style="`width:${share('making_charges')}%`"></div>
                            <div class="bg-pink-500 transition-all duration-500" :style="`width:${share('gst')}%`"></div>
                        </div>

                        <dl class="mt-5 space-y-3 text-sm">
                            <div class="flex items-center gap-2.5">
                                <span class="h-2 w-2 rounded-full bg-white"></span>
                                <dt class="text-pink-100">Gold</dt>
                                <dd class="ml-auto tabular-nums" x-text="money('gold_value')"></dd>
                            </div>
                            <div class="flex items-center gap-2.5">
                                <span class="h-2 w-2 rounded-full bg-pink-300"></span>
                                <dt class="text-pink-100">Making charges</dt>
                                <dd class="ml-auto tabular-nums" x-text="money('making_charges')"></dd>
                            </div>
                            <div class="flex items-center gap-2.5">
                                <span class="h-2 w-2 rounded-full bg-pink-500"></span>
                                <dt class="text-pink-100" x-text="result ? `GST (${result.gst_percent}%)` : 'GST'"></dt>
                                <dd class="ml-auto tabular-nums" x-text="money('gst')"></dd>
                            </div>
                        </dl>
                    </div>

                    <p class="mt-5 text-xs text-pink-100" x-show="error" x-text="error" x-cloak></p>

                    <div class="mt-auto pt-8">
                        <a :href="designUrl"
                            class="inline-flex items-center gap-2 rounded-full bg-white px-6 py-2.5 text-sm font-medium text-pink-700 transition hover:bg-pink-50">
                            Design it your way <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>
                        <p class="mt-4 text-[0.7rem] leading-relaxed text-pink-200">
                            Indicative price. Stones and detailed work can change it; we confirm the exact quote first.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .calc-range {
                -webkit-appearance: none; appearance: none; height: 6px; border-radius: 9999px; outline: none;
                background: linear-gradient(to right, #be185d var(--fill, 0%), #fbcfe8 var(--fill, 0%));
            }
            .calc-range::-webkit-slider-thumb {
                -webkit-appearance: none; appearance: none; width: 22px; height: 22px; border-radius: 9999px;
                background: #fff; border: 3px solid #be185d; cursor: grab; box-shadow: 0 2px 8px rgba(190, 24, 93, .35);
            }
            .calc-range::-moz-range-thumb {
                width: 18px; height: 18px; border-radius: 9999px; background: #fff; border: 3px solid #be185d; cursor: grab;
            }
            .calc-range:focus-visible::-webkit-slider-thumb { box-shadow: 0 0 0 4px rgba(190, 24, 93, .25); }
        </style>
    </section>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('goldCalculator', (pieces, rates, calcUrl, designBase) => ({
                pieces, rates, calcUrl, designBase,
                piece: pieces[0].name,
                purity: '',
                weight: 5,
                result: null,
                loading: false,
                error: '',
                shown: 0,
                hallmark: { '24K': '999', '22K': '916', '18K': '750' },
                timer: null,
                seq: 0,

                init() {
                    this.purity = this.purities.includes('22K') ? '22K' : (this.purities[0] || '');
                    ['piece', 'purity', 'weight'].forEach(k => this.$watch(k, () => this.schedule()));
                    this.$watch('result', r => this.tween(r ? r.totalChrges : 0));
                    this.fetchEstimate();
                },

                get purities() {
                    const p = this.pieces.find(x => x.name === this.piece);
                    return p ? p.purities : [];
                },

                setPiece(name) {
                    this.piece = name;
                    if (!this.purities.includes(this.purity)) this.purity = this.purities[0] || '';
                },

                rateOf(k) {
                    return this.rates && this.rates[k] ? this.inr(this.rates[k]) + ' / g' : '';
                },

                inr(n) {
                    return '₹' + Number(n).toLocaleString('en-IN', { maximumFractionDigits: 0 });
                },

                money(key) {
                    return this.result ? this.inr(this.result[key]) : '—';
                },

                share(key) {
                    return this.result ? (this.result[key] / this.result.totalChrges * 100).toFixed(2) : 0;
                },

                get totalText() {
                    return this.result ? this.inr(this.shown) : '₹ —';
                },

                get designUrl() {
                    const q = new URLSearchParams({ piece: this.piece, purity: this.purity, weight: this.weight });
                    return `${this.designBase}?${q}`;
                },

                tween(to) {
                    const from = this.shown, start = performance.now(), dur = 450;
                    const step = now => {
                        const t = Math.min(1, (now - start) / dur);
                        this.shown = from + (to - from) * (1 - Math.pow(1 - t, 3));
                        if (t < 1) requestAnimationFrame(step);
                    };
                    requestAnimationFrame(step);
                },

                schedule() {
                    clearTimeout(this.timer);
                    if (!this.piece || !this.purity || !(parseFloat(this.weight) > 0)) {
                        this.result = null;
                        return;
                    }
                    this.timer = setTimeout(() => this.fetchEstimate(), 250);
                },

                async fetchEstimate() {
                    if (!this.purity || !(parseFloat(this.weight) > 0)) return;
                    const id = ++this.seq;
                    this.loading = true;
                    this.error = '';
                    try {
                        const q = new URLSearchParams({ product: this.piece, purity: this.purity, weight: this.weight });
                        const res = await fetch(`${this.calcUrl}?${q}`, { headers: { Accept: 'application/json' } });
                        const json = await res.json();
                        if (id !== this.seq) return;
                        if (res.ok && json.status === 1) {
                            this.result = json.data;
                        } else {
                            this.result = null;
                            this.error = json.message || 'We could not calculate that right now.';
                        }
                    } catch (e) {
                        if (id === this.seq) {
                            this.result = null;
                            this.error = 'We could not calculate that right now.';
                        }
                    } finally {
                        if (id === this.seq) this.loading = false;
                    }
                },
            }));
        });
    </script>
@endif
