<section class="bg-gray-50 py-16" id="shop">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-between mb-6 lg:hidden">
            <p class="text-sm text-gray-600">Showing 1–12 of {{ $allproducts->total() }} products</p>
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
                                    <input type="checkbox" class="accent-pink-500" name="category"
                                        value="{{ $category->id }}" data-id="{{ $category->id }}" />
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
                    <p class="text-sm text-gray-600">Showing 1–12 of {{ $allproducts->total() }} products</p>
                    <select
                        class="border rounded px-3 py-2 text-sm text-pink-600 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 focus:outline-none">
                        <option>Sort by: Newest</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                    </select>
                </div>

                <!-- Product Grid Wrapper -->
                <div id="search_product" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($allproducts as $products)
                        <div
                            class="bg-white border rounded-lg shadow-sm p-5 hover:shadow-md transition-transform duration-300 hover:-translate-y-1">
                            <a href="{{ route('product_details', $products->slug) }}">
                                <img src="{{ asset($products->image) }}" alt="{{ $products->name }}"
                                    class="h-44 object-contain transition-transform duration-300 hover:scale-105" />
                            </a>
                            <div class="mt-4 space-y-2">
                                <h3 class="text-gray-800 font-medium text-base truncate">{{ $products->name }}</h3>
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-pink-700 font-bold text-lg">₹{{ $products->price }}</span>
                                        <span
                                            class="text-gray-400 line-through text-sm">₹{{ $products->original_price }}</span>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center min-h-[1.5rem]">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-gray-400 text-sm">{{ $products->discount }}% discount for
                                            today</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">

                                @if (Auth::check())
                                    <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                                        @csrf
                                        <input type="hidden" name="user_id"
                                            value="{{ Auth::check() ? Auth::id() : '' }}">
                                        <input type="hidden" name="product_id" value="{{ $products->id }}">
                                        <input type="hidden" name="quantity" x-bind:value="quantity"
                                            value="1">
                                        <button type="submit"
                                            class="block text-center w-full bg-gradient-to-r from-pink-400 to-rose-300 hover:opacity-90 text-white font-medium py-2.5 rounded shadow-md transition">
                                            Add to Cart
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="block text-center w-full bg-gradient-to-r from-pink-400 to-rose-300 hover:opacity-90 text-white font-medium py-2.5 rounded shadow-md transition">
                                        Add to Cart
                                        <i class="fa-solid fa-bag-shopping text-lg ml-2"></i>
                                    </a>
                                @endif

                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-center mt-12 gap-2">
                    {{ $allproducts->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    // Sidebar open/close
    const openBtn = document.getElementById("openFilters");
    const closeBtn = document.getElementById("closeFilters");
    const sidebar = document.getElementById("sidebarFilters");
    openBtn?.addEventListener("click", () => sidebar.classList.remove("hidden"));
    closeBtn?.addEventListener("click", () => sidebar.classList.add("hidden"));

    // Multi-category AJAX filter
    $(document).ready(function() {
        $("input[type=checkbox]").on('change', function() {
            let selected = [];
            $("input[type=checkbox]:checked").each(function() {
                selected.push($(this).data('id'));
            });

            if (selected.length === 0) {
                $("#search_product").html(
                    '<p class="col-span-3 text-center text-gray-500">No products found.</p>');
                return;
            }

            $("#search_product").html('<p class="text-center text-gray-500">Loading...</p>');

            $.ajax({
                type: 'GET',
                url: "{{ route('search.category') }}",
                data: {
                    search: selected
                },
                traditional: true,
                success: function(res) {
                    if (res.status && res.data.data.length > 0) {
                        let html = '';
                        res.data.data.forEach(product => {
                            html += `
                            <div class="bg-white border rounded-lg shadow-sm p-5 hover:shadow-md transition-transform duration-300 hover:-translate-y-1">
                                <a href="/product-details/${product.slug}">
                                    <img src="/${product.image}" alt="${product.name}" class="h-44 object-contain transition-transform duration-300 hover:scale-105" />
                                </a>
                                <div class="mt-4 space-y-2">
                                    <h3 class="text-gray-800 font-medium text-base truncate">${product.name}</h3>
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center space-x-2">
                                            <span class="text-pink-700 font-bold text-lg">₹${product.price}</span>
                                            <span class="text-gray-400 line-through text-sm">₹${product.original_price}</span>
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-center min-h-[1.5rem]">
                                        <span class="text-gray-400 text-sm">${product.discount}% discount for today</span>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <a href="/login" class="block text-center w-full bg-gradient-to-r from-pink-400 to-rose-300 hover:opacity-90 text-white font-medium py-2.5 rounded shadow-md transition">
                                        Add to Cart <i class="fa-solid fa-bag-shopping text-lg ml-2"></i>
                                    </a>
                                </div>
                            </div>`;
                        });
                        $("#search_product").html(html);
                    } else {
                        $("#search_product").html(
                            '<p class="col-span-3 text-center text-gray-500">No products found.</p>'
                        );
                    }
                },
                error: function(err) {
                    console.error(err);
                }
            });
        });
    });
</script>
