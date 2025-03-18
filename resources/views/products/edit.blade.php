@exten'layouts.tabler')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center mb-3">
                <div class="col">
                    <h2 class="page-title">
                        {{ __('Edit Product') }}
                    </h2>
                </div>
            </div>

            @include('partials._breadcrumbs', ['model' => $product])
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">

                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">

                @csrf
                    @method('put')
                    <div class="space-y-4">
                        <div class="p-4 border rounded-md shadow-sm">
                            <label for="quantity" class="block text-gray-700 font-semibold mb-2">Layihənin ehtimal olunan ümumi dəyəri</label>
                            <input type="number" name="quantity" id="quantity" placeholder="0" value="{{ old('quantity', $product->quantity) }}" class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300"/>
                        </div>

                        <div class="p-4 border rounded-md shadow-sm">
                            <label for="quantity_alert" class="block text-gray-700 font-semibold mb-2">Müqavilənin dəyəri</label>
                            <input type="text" name="quantity_alert" id="quantity_alert" placeholder="0" value="{{ old('quantity_alert', $product->quantity_alert) }}" class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300"/>
                        </div>

                        <div class="p-4 border rounded-md shadow-sm">
                            <label for="buying_price" class="block text-gray-700 font-semibold mb-2">Ayrılmış vəsait</label>
                            <input type="text" id="buying_price" name="buying_price" placeholder="0" value="{{ old('buying_price', $product->buying_price) }}" class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300"/>
                        </div>

                        <div class="p-4 border rounded-md shadow-sm">
                            <label for="selling_price" class="block text-gray-700 font-semibold mb-2">Ödənilmiş vəsait</label>
                            <input type="text" id="selling_price" name="selling_price" placeholder="0" value="{{ old('selling_price', $product->selling_price) }}" class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300"/>
                        </div>

                        <div class="p-4 border rounded-md shadow-sm">
                            <label for="remaining_amount" class="block text-gray-700 font-semibold mb-2">Qalıq vəsait</label>
                            <input type="text" id="remaining_amount" name="remaining_amount" placeholder="0" value="{{ old('remaining_amount', $product->remaining_amount) }}" class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300"/>
                        </div>

                        <div class="p-4 border rounded-md shadow-sm">
                            <label for="accredited_balance" class="block text-gray-700 font-semibold mb-2">Akkreditivin qalığı</label>
                            <input type="text" id="accredited_balance" name="accredited_balance" placeholder="0" value="{{ old('accredited_balance', $product->accredited_balance) }}" class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300"/>
                        </div>

                        <div class="p-4 border rounded-md shadow-sm">
                            <label for="advance_debt" class="block text-gray-700 font-semibold mb-2">Avans borcu</label>
                            <input type="text" id="advance_debt" name="advance_debt" placeholder="0" value="{{ old('advance_debt', $product->advance_debt) }}" class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300"/>
                        </div>

                        <div class="p-4 border rounded-md shadow-sm">
                            <label for="project_completion_estimate" class="block text-gray-700 font-semibold mb-2">Layihənin bitməsi üçün tələb olunan ehtimal vəsait</label>
                            <input type="text" id="project_completion_estimate" name="project_completion_estimate" placeholder="0" value="{{ old('project_completion_estimate', $product->project_completion_estimate) }}" class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300"/>
                        </div>

                        <div class="p-4 border rounded-md shadow-sm">
                            <label for="estimated_funds_2025" class="block text-gray-700 font-semibold mb-2">2025-ci ilə tələb olunan vəsait</label>
                            <input type="text" id="estimated_funds_2025" name="estimated_funds_2025" placeholder="0" value="{{ old('estimated_funds_2025', $product->estimated_funds_2025) }}" class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300"/>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">
                                            {{ __('Product Image') }}
                                        </h3>

                                        <img
                                            class="img-account-profile mb-2"
                                            src="{{ $product->product_image ? asset('storage/products/'.$product->product_image) : asset('assets/img/products/default.webp') }}"
                                            id="image-preview"
                                        >

                                        <div class="small font-italic text-muted mb-2">
                                            JPG or PNG no larger than 2 MB
                                        </div>

                                        <input
                                            type="file"
                                            accept="image/*"
                                            id="image"
                                            name="product_image"
                                            class="form-control @error('product_image') is-invalid @enderror"
                                            onchange="previewImage();"
                                        >

                                        @error('product_image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8">

                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">
                                            {{ __('Product Details') }}
                                        </h3>

                                        <div class="row row-cards">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">
                                                        {{ __('Name') }}
                                                        <span class="text-danger">*</span>
                                                    </label>

                                                    <input type="text"
                                                           id="name"
                                                           name="name"
                                                           class="form-control @error('name') is-invalid @enderror"
                                                           placeholder="Product name"
                                                           value="{{ old('name', $product->name) }}"
                                                    >

                                                    @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6">
                                                <div class="mb-3">
                                                    <label for="category_id" class="form-label">
                                                        Product category
                                                        <span class="text-danger">*</span>
                                                    </label>

                                                    <select name="category_id" id="category_id"
                                                            class="form-select @error('category_id') is-invalid @enderror"
                                                    >
                                                        <option selected="" disabled="">Select a category:</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}" @if(old('category_id', $product->category_id) == $category->id) selected="selected" @endif>{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>

                                                    @error('category_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-sm-6 col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="unit_id">
                                                        {{ __('Unit') }}
                                                        <span class="text-danger">*</span>
                                                    </label>

                                                    <select name="unit_id" id="unit_id"
                                                            class="form-select @error('unit_id') is-invalid @enderror"
                                                    >
                                                        <option selected="" disabled="">
                                                            Select a unit:
                                                        </option>

                                                        @foreach ($units as $unit)
                                                            <option value="{{ $unit->id }}" @if(old('unit_id', $product->unit_id) == $unit->id) selected="selected" @endif>{{ $unit->name }}</option>
                                                        @endforeach
                                                    </select>

                                                    @error('unit_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>



                                            <div class="col-md-12">
                                                <div class="mb-3 mb-0">
                                                    <label for="notes" class="form-label">
                                                        {{ __('Notes') }}
                                                    </label>

                                                    <textarea name="notes"
                                                              id="notes"
                                                              rows="5"
                                                              class="form-control @error('notes') is-invalid @enderror"
                                                              placeholder="Product notes"
                                                    >{{ old('notes', $product->notes) }}</textarea>

                                                    @error('notes')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer text-end">
                                        <x-button.save type="submit">
                                            {{ __('Update') }}
                                        </x-button.save>

                                        <x-button.back route="{{ route('products.index') }}">
                                            {{ __('Cancel') }}
                                        </x-button.back>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    @endsection


@pushonce('page-scripts')
    <script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endpushonce
