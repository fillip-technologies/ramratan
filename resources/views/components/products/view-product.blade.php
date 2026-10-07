@php
    $selectedCategories = array_map('intval', (array) request('category', []));
    $currentSort = request('sort', '');
@endphp
<section class="bg-gray-50 py-16" id="shop">
    <form id="filterForm" method="GET" action="{{ url()->current() }}">
        @if (request()->filled('search'))
            <input type="hidden" name="search" value="{{ request('search') }}">
        @endif
    </form>
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-between mb-6 lg:hidden">
            <p class="text-sm text-gray-600">@if ($allproducts->total() > 0)
                Showing {{ $allproducts->firstItem() }}–{{ $allproducts->lastItem() }} of {{ $allproducts->total() }} products
            @else
                No products found
            @endif</p>
            <button id="openFilters" class="px-4 py-2 border rounded text-sm text-pink-600">
                <i class="fa-solid fa-sliders"></i> Filters
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
            <!-- Sidebar Filters -->
            <aside id="sidebarFilters"
                class="hidden lg:block lg:col-span-1 bg-white rounded shadow p-6 space-y-6 border border-rose-100 self-start fixed lg:static top-0 left-0 h-full w-80 overflow-y-auto lg:w-auto lg:h-auto">

                <div class="flex items-center justify-end lg:hidden mb-4">
                    <button id="closeFilters" class="text-gray-500 hover:text-gray-800">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>

                <h3 class="text-lg text-gray-800 font-semibold">Filter Products</h3>

                <div>
                    <h4 class="text-sm font-medium text-gray-700 mb-2">Categories</h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        @foreach (App\Models\Category::all() as $category)
                            <li>
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" class="accent-pink-500" form="filterForm" name="category[]"
                                        value="{{ $category->id }}" @checked(in_array($category->id, $selectedCategories))
                                        onchange="this.form.submit()" />
                                    {{ $category->name }}
                                </label>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </aside>

            <!-- Products Grid -->
            <div class="lg:col-span-3">
                <div class="hidden lg:flex items-center justify-between mb-8">
                    <p class="text-sm text-gray-600">@if ($allproducts->total() > 0)
                Showing {{ $allproducts->firstItem() }}–{{ $allproducts->lastItem() }} of {{ $allproducts->total() }} products
            @else
                No products found
            @endif</p>
                    <select form="filterForm" name="sort" onchange="this.form.submit()"
                        class="border rounded px-3 py-2 text-sm text-pink-600 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 focus:outline-none">
                        <option value="">Sort by: Newest</option>
                        <option value="price_asc" @selected($currentSort === 'price_asc')>Price: Low to High</option>
                        <option value="price_desc" @selected($currentSort === 'price_desc')>Price: High to Low</option>
                    </select>
                </div>

                <!-- Product Grid Wrapper -->
                <div id="search_product" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($allproducts as $product)
                        <x-products.product-card :product="$product" />
                    @empty
                        <p class="col-span-full text-center text-gray-500 py-12">No products found.</p>
                    @endforelse
                </div>

                <div class="flex justify-center mt-12 gap-2">
                    {{ $allproducts->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    // Sidebar open/close
    const openBtn = document.getElementById("openFilters");
    const closeBtn = document.getElementById("closeFilters");
    const sidebar = document.getElementById("sidebarFilters");
    openBtn?.addEventListener("click", () => sidebar.classList.remove("hidden"));
    closeBtn?.addEventListener("click", () => sidebar.classList.add("hidden"));

</script>
