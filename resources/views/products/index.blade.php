@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        @if($products->isEmpty())
            <x-empty
                title="No products found"
                message="Try adjusting your search or filter to find what you're looking for."
                button_label="{{ __('Add your first Product') }}"
                button_route="{{ route('products.create') }}"
            />
        @else
            <div class="container container-xl">
                <x-alert/>

                <!-- Excel ixrac düyməsi -->
                <div class="mb-3">
                    <a href="{{ route('products.export') }}" class="btn btn-success">
                        <i class="fas fa-file-excel"></i> Excell Yaradın
                    </a>
                </div>


                @livewire('tables.product-table')
            </div>
        @endif
    </div>
@endsection
