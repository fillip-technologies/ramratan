@extends('layouts.app')

@section('title', 'Create Your Design')

@section('content')
    @php
        $field = 'w-full bg-transparent border-0 border-b border-rose-200 px-0 py-2.5 text-gray-800 placeholder-gray-400 focus:border-rose-500 focus:ring-0 focus:outline-none transition-colors';
        $label = 'block text-[0.7rem] uppercase tracking-[0.18em] text-rose-700 font-medium';
        $materials = ['Gold', 'Silver', 'Platinum', 'Diamond', 'Not sure yet'];
    @endphp

    <section class="bg-rose-50/60 py-12 md:py-20" x-data="designPage(@js($pieces))">
        <div class="max-w-6xl mx-auto px-5 sm:px-8">

            {{-- Heading --}}
            <header class="max-w-2xl">
                <p class="text-[0.7rem] uppercase tracking-[0.3em] text-rose-600">Made to order</p>
                <h1 class="mt-3 text-3xl md:text-5xl font-semibold text-gray-800 leading-tight">
                    A piece that exists<br class="hidden sm:block"> only for you.
                </h1>
                <p class="mt-5 text-gray-600 leading-relaxed">
                    Tell us what you have in mind and see a rough price while you do. Our artisans will call you,
                    talk through the design, and confirm the final quote before anything is made.
                </p>
            </header>

            @if (session('success'))
                <div class="mt-8 border-l-4 border-rose-500 bg-white px-5 py-4 text-sm text-gray-700 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="mt-8 border-l-4 border-red-400 bg-white px-5 py-4 text-sm text-red-600 shadow-sm">
                    Please check the highlighted details below and try again.
                </div>
            @endif

            <div class="mt-12 grid grid-cols-1 lg:grid-cols-12 gap-x-16 gap-y-12">

                {{-- 01 · The piece (feeds the estimate) --}}
                <div class="lg:col-start-1 lg:col-span-7 lg:row-start-1">
                    <div class="flex items-baseline gap-4">
                        <span class="text-4xl font-light text-rose-200 leading-none">01</span>
                        <h2 class="text-xl font-semibold text-gray-800">The piece</h2>
                    </div>
                    <p class="mt-2 ml-[3.25rem] text-sm text-gray-500">Optional, but it gives you a price estimate on the right.</p>

                    <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-x-8 gap-y-7 ml-0 sm:ml-[3.25rem]">
                        <div>
                            <label class="{{ $label }}" for="piece">Type</label>
                            <select id="piece" name="piece" form="designForm" x-model="piece" @change="purity = ''"
                                class="{{ $field }}">
                                <option value="">Choose</option>
                                <template x-for="p in pieces" :key="p.name">
                                    <option :value="p.name" x-text="p.name"></option>
                                </template>
                            </select>
                        </div>
                        <div>
                            <label class="{{ $label }}" for="purity">Purity</label>
                            <select id="purity" name="purity" form="designForm" x-model="purity" :disabled="!piece"
                                class="{{ $field }} disabled:opacity-40">
                                <option value="">Choose</option>
                                <template x-for="k in purities" :key="k">
                                    <option :value="k" x-text="k"></option>
                                </template>
                            </select>
                        </div>
                        <div>
                            <label class="{{ $label }}" for="weight">Weight (grams)</label>
                            <input id="weight" type="number" step="0.01" min="0" inputmode="decimal"
                                name="weight" form="designForm" x-model="weight" placeholder="e.g. 5"
                                class="{{ $field }}">
                        </div>
                    </div>
                </div>

                {{-- Estimate slip --}}
                <aside class="lg:col-start-8 lg:col-span-5 lg:row-start-1 lg:row-span-2">
                    <div class="lg:sticky lg:top-28">
                        <div class="relative bg-white border border-rose-200 shadow-[0_18px_40px_-20px_rgba(190,24,93,0.35)]">
                            {{-- scalloped top edge --}}
                            <div class="h-2 w-full"
                                style="background: radial-gradient(circle at 6px 0, transparent 5px, #fff1f2 5.5px) 0 0 / 12px 8px repeat-x"></div>

                            <div class="px-6 sm:px-8 pt-4 pb-7">
                                <div class="flex items-baseline justify-between">
                                    <h3 class="text-[0.7rem] uppercase tracking-[0.25em] text-rose-700 font-medium">Estimate slip</h3>
                                    <span class="text-[0.7rem] text-gray-400">{{ now()->timezone('Asia/Kolkata')->format('d M Y') }}</span>
                                </div>

                                {{-- rate card --}}
                                <div class="mt-5 grid grid-cols-3 text-center border-y border-dashed border-rose-200 py-3">
                                    @foreach (['24K', '22K', '18K'] as $k)
                                        <div>
                                            <p class="text-[0.65rem] tracking-widest text-gray-400">{{ $k }} / GRAM</p>
                                            <p class="mt-0.5 text-sm font-semibold text-gray-800">
                                                {{ $rates ? '₹' . number_format(round($rates[$k])) : 'N/A' }}</p>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- lines --}}
                                <dl class="mt-5 space-y-3 text-sm">
                                    <template x-for="row in rows" :key="row.label">
                                        <div class="flex items-baseline gap-2">
                                            <dt class="text-gray-600 whitespace-nowrap" x-text="row.label"></dt>
                                            <span class="flex-1 border-b border-dotted border-gray-300 translate-y-[-3px]"></span>
                                            <dd class="text-gray-800 tabular-nums" x-text="row.value"></dd>
                                        </div>
                                    </template>
                                </dl>

                                <div class="mt-6 pt-5 border-t border-rose-200 flex items-end justify-between">
                                    <span class="text-[0.7rem] uppercase tracking-[0.2em] text-gray-500">Approx. total</span>
                                    <span class="text-3xl font-semibold text-rose-700 tabular-nums transition-opacity"
                                        :class="loading && 'opacity-40'" x-text="total"></span>
                                </div>

                                <p class="mt-4 text-xs leading-relaxed text-rose-700" x-show="error" x-text="error" x-cloak></p>
                                <p class="mt-5 text-[0.7rem] leading-relaxed text-gray-400">
                                    Indicative price at today's gold rate. Stones, intricate work and the final design can change it,
                                    and we confirm the exact quote with you before we begin.
                                </p>
                            </div>
                        </div>
                    </div>
                </aside>

                {{-- 02 + 03 · The brief and contact --}}
                <form id="designForm" action="{{ route('add.Customization') }}" method="POST" enctype="multipart/form-data"
                    class="lg:col-start-1 lg:col-span-7 lg:row-start-2 space-y-12">
                    @csrf
                    <input type="hidden" name="estimate" :value="estimate">

                    <div>
                        <div class="flex items-baseline gap-4">
                            <span class="text-4xl font-light text-rose-200 leading-none">02</span>
                            <h2 class="text-xl font-semibold text-gray-800">Your idea</h2>
                        </div>

                        <div class="mt-8 space-y-8 sm:ml-[3.25rem]">
                            <div>
                                <span class="{{ $label }}">Material</span>
                                <div class="mt-3 flex flex-wrap gap-2">
                                    @foreach ($materials as $m)
                                        <label class="cursor-pointer">
                                            <input type="radio" name="material" value="{{ $m }}" class="peer sr-only"
                                                @checked(old('material') === $m)>
                                            <span
                                                class="inline-block rounded-full border border-rose-200 bg-white px-4 py-1.5 text-sm text-gray-600 transition peer-checked:border-rose-600 peer-checked:bg-rose-600 peer-checked:text-white peer-focus-visible:ring-2 peer-focus-visible:ring-rose-400 hover:border-rose-400">{{ $m }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                @error('material') <p class="mt-2 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="{{ $label }}" for="description">Describe it</label>
                                <textarea id="description" name="description" rows="4"
                                    placeholder="Style, occasion, stones, engraving, anything that matters to you…"
                                    class="{{ $field }} resize-none leading-relaxed">{{ old('description') }}</textarea>
                                @error('description') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <span class="{{ $label }}">Reference image</span>
                                <label for="images"
                                    class="mt-3 flex cursor-pointer items-center gap-4 border border-dashed border-rose-300 bg-white/60 px-5 py-4 transition hover:border-rose-500 hover:bg-white">
                                    <i class="fa-regular fa-image text-xl text-rose-400"></i>
                                    <span class="text-sm text-gray-600" x-text="fileName || 'Add a photo or sketch (JPG or PNG, up to 5 MB)'"></span>
                                </label>
                                <input id="images" type="file" name="images" accept=".jpg,.jpeg,.png" class="sr-only"
                                    @change="fileName = $event.target.files[0]?.name || ''">
                                @error('images') <p class="mt-2 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-baseline gap-4">
                            <span class="text-4xl font-light text-rose-200 leading-none">03</span>
                            <h2 class="text-xl font-semibold text-gray-800">How we reach you</h2>
                        </div>

                        <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-7 sm:ml-[3.25rem]">
                            <div>
                                <label class="{{ $label }}" for="name">Full name</label>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" autocomplete="name"
                                    placeholder="Your name" class="{{ $field }}">
                                @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="{{ $label }}" for="contact">Mobile number</label>
                                <input id="contact" type="tel" name="contact" value="{{ old('contact') }}"
                                    autocomplete="tel" placeholder="98765 43210" class="{{ $field }}">
                                @error('contact') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="mt-10 sm:ml-[3.25rem] flex flex-wrap items-center gap-5">
                            <button type="submit"
                                class="rounded-full bg-rose-600 px-9 py-3 text-sm font-medium text-white shadow-md shadow-rose-300/50 transition hover:bg-rose-700">
                                Send to our artisans
                            </button>
                            <span class="text-xs text-gray-400">We usually call back within one working day.</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <style>
        [x-cloak] { display: none !important; }
    </style>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('designPage', (pieces) => ({
                pieces,
                piece: '',
                purity: '',
                weight: '',
                fileName: '',
                result: null,
                loading: false,
                error: '',
                timer: null,
                seq: 0,

                init() {
                    ['piece', 'purity', 'weight'].forEach(k => this.$watch(k, () => this.schedule()));

                    // Arrive pre-filled from the home page calculator (?piece=&purity=&weight=)
                    const q = new URLSearchParams(location.search);
                    if (this.pieces.some(p => p.name === q.get('piece'))) {
                        this.piece = q.get('piece');
                        if (this.purities.includes(q.get('purity'))) this.purity = q.get('purity');
                        if (parseFloat(q.get('weight')) > 0) this.weight = q.get('weight');
                    }
                },

                get purities() {
                    const p = this.pieces.find(x => x.name === this.piece);
                    return p ? p.purities : [];
                },

                get estimate() {
                    return this.result ? this.result.totalChrges : '';
                },

                inr(n) {
                    return '₹' + Number(n).toLocaleString('en-IN', { maximumFractionDigits: 2 });
                },

                get rows() {
                    const r = this.result;
                    const dash = '—';
                    return [
                        { label: 'Gold rate / gram', value: r ? this.inr(r.price) : dash },
                        { label: 'Gold value', value: r ? this.inr(r.gold_value) : dash },
                        { label: 'Making charges', value: r ? this.inr(r.making_charges) : dash },
                        { label: r ? `GST (${r.gst_percent}%)` : 'GST', value: r ? this.inr(r.gst) : dash },
                    ];
                },

                get total() {
                    return this.result ? this.inr(this.result.totalChrges) : '₹ —';
                },

                schedule() {
                    clearTimeout(this.timer);
                    this.error = '';
                    if (!this.piece || !this.purity || !(parseFloat(this.weight) > 0)) {
                        this.result = null;
                        return;
                    }
                    this.timer = setTimeout(() => this.fetchEstimate(), 350);
                },

                async fetchEstimate() {
                    const id = ++this.seq;
                    this.loading = true;
                    try {
                        const q = new URLSearchParams({ product: this.piece, purity: this.purity, weight: this.weight });
                        const res = await fetch(`{{ route('calculate.price') }}?${q}`, { headers: { Accept: 'application/json' } });
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
@endsection
