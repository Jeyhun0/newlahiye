@extends('layouts.tabler')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center mb-3">
                <div class="col">
                    <h2 class="page-title">
                        {{ __('Mehsul (obyekt yaradın)') }}
                    </h2>
                </div>
            </div>

            @include('partials._breadcrumbs')
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <x-alert/>

            <div class="row row-cards">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">{{ __('Product Image') }}</h3>

                                    <img class="img-account-profile mb-2"
                                         src="{{ asset('assets/img/products/default.webp') }}"
                                         id="image-preview"/>

                                    <div class="small font-italic text-muted mb-2">
                                        Şəkilin həcmi 2 mb
                                    </div>

                                    <input type="file" accept="image/*" id="image" name="product_image"
                                           class="form-control @error('product_image') is-invalid @enderror"
                                           onchange="previewImage();">

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
                                <div class="card-header">
                                    <div>
                                        <h3 class="card-title">{{ __('Məhsul obyektini yaradın') }}</h3>
                                    </div>
                                    <div class="card-actions">
                                        <a href="{{ route('products.index') }}" class="btn-action">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M18 6l-12 12"></path>
                                                <path d="M6 6l12 12"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row row-cards">
                                        <div class="col-md-12">
                                            <x-input name="name" id="name" placeholder="obyektin adı" value="{{ old('name') }}"/>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="category_id" class="form-label">
                                                    İşin novü <span class="text-danger">*</span>
                                                </label>
                                                @if ($categories->count() === 1)
                                                    <select name="category_id" id="category_id"
                                                            class="form-select @error('category_id') is-invalid @enderror"
                                                            readonly>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}" selected>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <select name="category_id" id="category_id"
                                                            class="form-select @error('category_id') is-invalid @enderror">
                                                        <option selected disabled>secim növü:</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}" @if(old('category_id') == $category->id) selected @endif>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif

                                                @error('category_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="customer_id" class="form-label">
                                                    Podratçı təşkilatın adı <span class="text-danger">*</span>
                                                </label>
                                                @if ($customers->count() === 1)
                                                    <select name="customer_id" id="customer_id"
                                                            class="form-select @error('customer_id') is-invalid @enderror"
                                                            readonly>
                                                        @foreach ($customers as $customer)
                                                            <option value="{{ $customer->id }}" selected>
                                                                {{ $customer->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <select name="customer_id" id="customer_id"
                                                            class="form-select @error('customer_id') is-invalid @enderror">
                                                        <option selected disabled>Podratçı təşkilatın adı</option>
                                                        @foreach ($customers as $customer)
                                                            <option value="{{ $customer->id }}" @if(old('customer_id') == $customer->id) selected @endif>
                                                                {{ $customer->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif

                                                @error('customer_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="unit_id" class="form-label">
                                                    Vəsait Mənbəyi <span class="text-danger">*</span>
                                                </label>
                                                @if ($units->count() === 1)
                                                    <select name="unit_id" id="unit_id"
                                                            class="form-select @error('unit_id') is-invalid @enderror"
                                                            readonly>
                                                        @foreach ($units as $unit)
                                                            <option value="{{ $unit->id }}" selected>
                                                                {{ $unit->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <select name="unit_id" id="unit_id"
                                                            class="form-select @error('unit_id') is-invalid @enderror">
                                                        <option selected disabled>Vəsaitin Mənbəyi</option>
                                                        @foreach ($units as $unit)
                                                            <option value="{{ $unit->id }}" @if(old('unit_id') == $unit->id) selected @endif>{{ $unit->name }}</option>
                                                        @endforeach
                                                    </select>
                                                @endif

                                                @error('unit_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="space-y-4">
                                            <div class="p-4 border rounded-md shadow-sm">
                                                <label for="quantity" class="block text-gray-700 font-semibold mb-2">Layihənin ehtimal olunan ümumi dəyəri</label>
                                                <input type="number" name="quantity" id="quantity" placeholder="0" value="{{ old('quantity') }}" class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300"/>
                                            </div>

                                            <div class="p-4 border rounded-md shadow-sm">
                                                <label for="quantity_alert" class="block text-gray-700 font-semibold mb-2">Müqavilənin dəyəri</label>
                                                <input type="text" name="quantity_alert" id="quantity_alert" placeholder="0" value="{{ old('quantity_alert') }}" class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300"/>
                                            </div>

                                            <div class="p-4 border rounded-md shadow-sm">
                                                <label for="buying_price" class="block text-gray-700 font-semibold mb-2">Ayrılmış vəsait</label>
                                                <input type="text" id="buying_price" name="buying_price" placeholder="0" value="{{ old('buying_price') }}" class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300"/>
                                            </div>

                                            <div class="p-4 border rounded-md shadow-sm">
                                                <label for="selling_price" class="block text-gray-700 font-semibold mb-2">Ödənilmiş vəsait</label>
                                                <input type="text" id="selling_price" name="selling_price" placeholder="0" value="{{ old('selling_price') }}" class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300"/>
                                            </div>

                                            <div class="p-4 border rounded-md shadow-sm">
                                                <label for="remaining_amount" class="block text-gray-700 font-semibold mb-2">Qalıq vəsait</label>
                                                <input type="text" id="remaining_amount" name="remaining_amount" placeholder="0" value="{{ old('remaining_amount') }}" class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300"/>
                                            </div>

                                            <div class="p-4 border rounded-md shadow-sm">
                                                <label for="accredited_balance" class="block text-gray-700 font-semibold mb-2">Akkreditivin qalığı</label>
                                                <input type="text" id="accredited_balance" name="accredited_balance" placeholder="0" value="{{ old('accredited_balance') }}" class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300"/>
                                            </div>

                                            <div class="p-4 border rounded-md shadow-sm">
                                                <label for="advance_debt" class="block text-gray-700 font-semibold mb-2">Avans borcu</label>
                                                <input type="text" id="advance_debt" name="advance_debt" placeholder="0" value="{{ old('advance_debt') }}" class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300"/>
                                            </div>

                                            <div class="p-4 border rounded-md shadow-sm">
                                                <label for="project_completion_estimate" class="block text-gray-700 font-semibold mb-2">Layihənin bitməsi üçün tələb olunan ehtimal vəsait</label>
                                                <input type="text" id="project_completion_estimate" name="project_completion_estimate" placeholder="0" value="{{ old('project_completion_estimate') }}" class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300"/>
                                            </div>

                                            <div class="p-4 border rounded-md shadow-sm">
                                                <label for="estimated_funds_2025" class="block text-gray-700 font-semibold mb-2">2025-ci ilə tələb olunan vəsait</label>
                                                <input type="text" id="estimated_funds_2025" name="estimated_funds_2025" placeholder="0" value="{{ old('estimated_funds_2025') }}" class="w-full p-3 border rounded-md focus:ring focus:ring-blue-300"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="project_estimate_documents">Lahiyə smeta sənədləri</label>
                                            <select name="project_estimate_documents" id="project_estimate_documents" class="form-control">
                                                <option value="Yes" {{ old('project_estimate_documents') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="No" {{ old('project_estimate_documents') == 'No' ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="construction_permit">Tikintiyə icarə sənəti</label>
                                            <select name="construction_permit" id="construction_permit" class="form-control">
                                                <option value="Yes" {{ old('construction_permit') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="No" {{ old('construction_permit') == 'No' ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="notes" class="form-label">
                                                    {{ __('Notes') }}
                                                </label>

                                                <textarea name="notes" id="notes" rows="5" class="form-control @error('notes') is-invalid @enderror"
                                                          placeholder="Product notes">{{ old('notes') }}</textarea>

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
                                    <x-button.save type="submit">{{ __('Save') }}</x-button.save>
                                    <x-button.back route="{{ route('products.index') }}">{{ __('Cancel') }}</x-button.back>
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
