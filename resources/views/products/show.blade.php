@extends('layouts.tabler')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl mb-3">
            <div class="row g-2 align-items-center mb-3">
                <div class="col">
                    <h2 class="page-title">
                        {{ __('View Product') }}
                    </h2>
                </div>
            </div>

            @include('partials._breadcrumbs', ['model' => $product])
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">
                                    {{ __('Product Image') }}
                                </h3>
                                <img class="img-account-profile mb-2" src="{{ asset('assets/img/products/'.$product->image) }}" alt="Product Image" id="image-preview" />
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    {{ __('Product Details') }}
                                </h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered card-table table-vcenter text-nowrap datatable">
                                    <tbody>
                                    <tr>
                                        <td><strong>{{ __('name') }}</strong></td>
                                        <td>{{ $product->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Slug') }}</strong></td>
                                        <td>{{ $product->slug }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Code') }}</strong></td>
                                        <td>{{ $product->code }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Barcode') }}</strong></td>
                                        <td>{!! $barcode !!}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Category') }}</strong></td>
                                        <td>
                                            <a href="{{ route('categories.show', $product->category) }}" class="badge bg-blue-lt">
                                                {{ $product->category->name }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Unit') }}</strong></td>
                                        <td>
                                            <a href="{{ route('units.show', $product->unit) }}" class="badge bg-blue-lt">
                                                {{ $product->unit->short_code }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Quantity') }}</strong></td>
                                        <td>{{ $product->quantity }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Quantity Alert') }}</strong></td>
                                        <td>
                                            <span class="badge bg-red-lt">{{ $product->quantity_alert }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Buying Price') }}</strong></td>
                                        <td>{{ $product->buying_price }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Selling Price') }}</strong></td>
                                        <td>{{ $product->selling_price }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Tax') }}</strong></td>
                                        <td>
                                            <span class="badge bg-red-lt">{{ $product->tax }} %</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Tax Type') }}</strong></td>
                                        <td>{{ $product->tax_type->label() }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Notes') }}</strong></td>
                                        <td>{{ $product->notes }}</td>
                                    </tr>

                                    <!-- New fields -->
                                    <tr>
                                        <td><strong>{{ __('Advance Debt') }}</strong></td>
                                        <td>{{ $product->advance_debt }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Project Completion Estimate') }}</strong></td>
                                        <td>{{ $product->project_completion_estimate }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Estimated Funds 2025') }}</strong></td>
                                        <td>{{ $product->estimated_funds_2025 }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Construction Permit') }}</strong></td>
                                        <td>
                                            @if ($product->construction_permit)
                                                <span class="badge bg-success">{{ __('Granted') }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ __('Not Granted') }}</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><strong>{{ __('Created At') }}</strong></td>
                                        <td>{{ $product->created_at->format('d-m-Y H:i:s') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Updated At') }}</strong></td>
                                        <td>{{ $product->updated_at->format('d-m-Y H:i:s') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>{{ __('Status') }}</strong></td>
                                        <td>
                                            <span class="badge bg-{{ $product->status == 'active' ? 'success' : 'danger' }}">
                                                {{ ucfirst($product->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer text-end">
                                <x-button.edit route="{{ route('products.edit', $product) }}">
                                    {{ __('Edit') }}
                                </x-button.edit>

                                <x-button.back route="{{ route('products.index') }}">
                                    {{ __('Back to Products') }}
                                </x-button.back>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
