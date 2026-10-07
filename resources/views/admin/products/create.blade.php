@extends('admin.include.layout')

@section('heading', 'Products')
@section('title', 'Add Product')

@section('content')
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-6">Add New Product</h2>

        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Product Details --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-semibold">Product Name</label>
                    <input type="text" name="name" class="w-full border p-2 rounded" value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Product Video</label>
                    <input type="file" name="product_video[]" class="w-full border p-2 rounded" accept="video/*"
                        multiple>
                    @error('product_video')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>


                <div>
                    <label class="block mb-1 font-semibold">View Product Section</label>
                    <select name="show_product" class="w-full border p-2 rounded">
                        <option value="">-- Select Section --</option>
                        <option value="top" {{ old('show_product') == 'top' ? 'selected' : '' }}>Top Product</option>
                        <option value="new_arrival" {{ old('show_product') == 'new' ? 'selected' : '' }}>New Arrival
                        </option>

                    </select>
                    @error('show_product')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>


                <div>
                    <label class="block mb-1 font-semibold">Category</label>
                    <select name="category_id" class="w-full border p-2 rounded">
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Price</label>
                    <input type="number" name="price" step="0.01" class="w-full border p-2 rounded"
                        value="{{ old('price') }}">
                    @error('price')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Discount (%)</label>
                    <input type="number" name="discount" step="0.01" class="w-full border p-2 rounded"
                        value="{{ old('discount') }}">
                    @error('discount')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Stock</label>
                    <input type="number" name="stock" class="w-full border p-2 rounded" value="{{ old('stock') }}">
                    @error('stock')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Main Image</label>
                    <input type="file" name="image" class="w-full border p-2 rounded">
                    @error('image')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Gallery Images</label>
                    <input type="file" name="gallery_images[]" multiple class="w-full border p-2 rounded">
                    @error('gallery_images.*')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Purity</label>
                    <input type="text" name="purity" class="w-full border p-2 rounded" value="{{ old('purity') }}">
                    @error('purity')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Color</label>
                    <input type="text" name="color" class="w-full border p-2 rounded" value="{{ old('color') }}">
                    @error('color')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Type</label>
                    <input type="text" name="type" class="w-full border p-2 rounded" value="{{ old('type') }}">
                    @error('type')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Min-Highlighter</label>
                    <input type="text" name="hylighter" class="w-full border p-2 rounded"
                        value="{{ old('hylighter') }}">
                    @error('hylighter')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Max-Highlighter</label>
                    <input type="text" name="hylighter_two" class="w-full border p-2 rounded"
                        value="{{ old('hylighter_two') }}">
                    @error('hylighter_two')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">MRP (Text)</label>
                    <input type="text" name="mrptext" class="w-full border p-2 rounded" value="{{ old('mrptext') }}">
                    @error('mrptext')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Net-Weight</label>
                    <input type="text" name="net_weight" class="w-full border p-2 rounded"
                        value="{{ old('net_weight') }}">
                    @error('net_weight')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Gross-Weight</label>
                    <input type="text" name="gross_weight" class="w-full border p-2 rounded"
                        value="{{ old('mrptext') }}">
                    @error('gross_weight')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Stone-Weight</label>
                    <input type="text" name="stone_weight" class="w-full border p-2 rounded"
                        value="{{ old('stone_weight') }}">
                    @error('stone_weight')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Silver-Weight</label>
                    <input type="text" name="silver_weight" class="w-full border p-2 rounded"
                        value="{{ old('silver_weight') }}">
                    @error('silver_weight')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Gold-Weight</label>
                    <input type="text" name="gold_weight" class="w-full border p-2 rounded"
                        value="{{ old('gold_weight') }}">
                    @error('gold_weight')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Diamond-Weight</label>
                    <input type="text" name="diamond_weight" class="w-full border p-2 rounded"
                        value="{{ old('diamond_weight') }}">
                    @error('diamond_weight')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>


            </div>

            {{-- Product Description --}}
            <div class="mt-4">
                <label class="block mb-1 font-semibold">Description</label>
                <textarea name="description" id="product_description" rows="6" class="border rounded-md p-2 w-full">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

          
            <h3 class="text-xl font-bold my-4">Pic BreackPoint</h3>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Making Price</label>
                <input type="number" step="0.01" name="making_price" class="w-full border p-2 rounded"
                    value="{{ old('making_price') }}">
                @error('making_price')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Material</label>
                <input type="text" name="material" class="w-full border p-2 rounded" value="{{ old('material') }}">
                @error('material')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Material Charges</label>
                <input type="number" step="0.01" name="material_price" class="w-full border p-2 rounded"
                    value="{{ old('material_price') }}">
                @error('material_price')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Discount (%)</label>
                <input type="number" step="0.01" name="brdiscount" class="w-full border p-2 rounded"
                    value="{{ old('brdiscount') }}">
                @error('brdiscount')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Tax (%)</label>
                <input type="number" step="0.01" name="tax" class="w-full border p-2 rounded"
                    value="{{ old('tax') }}">
                @error('tax')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save Product</button>
            </div>
        </form>
    </div>

    {{-- CKEditor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#product_description')).catch(error => console.error(error));

        // Dynamic Variant & Option Fields
        let variantIndex = 1;

        document.getElementById('add-variant').addEventListener('click', function() {
            const wrapper = document.getElementById('variants-wrapper');
            const firstVariant = wrapper.querySelector('.variant');
            const newVariant = firstVariant.cloneNode(true);

            // Reset values
            newVariant.querySelectorAll('input').forEach(input => input.value = '');

            // Update names
            newVariant.querySelectorAll('[name]').forEach(input => {
                input.name = input.name.replace(/\d+/, variantIndex);
            });

            wrapper.appendChild(newVariant);
            variantIndex++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('add-option')) {
                const optionsWrapper = e.target.previousElementSibling;
                const variantIdx = e.target.closest('.variant')
                    .querySelector('input[name^="variants"]').name.match(/\d+/)[0];
                const optionIndex = optionsWrapper.querySelectorAll('.option').length;

                const newOption = document.createElement('div');
                newOption.classList.add('option', 'flex', 'gap-2', 'mb-2');
                newOption.innerHTML = `
                <input type="text" name="variants[${variantIdx}][options][${optionIndex}][name]" placeholder="Option Name" class="border p-2 rounded w-1/2">
                <input type="text" name="variants[${variantIdx}][options][${optionIndex}][value]" placeholder="Option Value" class="border p-2 rounded w-1/2">
            `;
                optionsWrapper.appendChild(newOption);
            }

            // Remove Variant
            if (e.target.classList.contains('remove-variant')) {
                const variant = e.target.closest('.variant');
                if (document.querySelectorAll('.variant').length > 1) variant.remove();
            }
        });
    </script>
@endsection
