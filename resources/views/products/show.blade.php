@extends('layouts.tabler')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center mb-3">
                <div class="col">
                    <h2 class="page-title">
                        {{ __('Məhsul Məlumatları') }}
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
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">{{ __('Product Image') }}</h3>
                            <img class="img-account-profile mb-2" src="{{ asset($product->image ?? 'assets/img/products/default.webp') }}" id="image-preview"/>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Məhsul Məlumatları') }}</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>{{ __('Obyektin adı') }}</th>
                                    <td>{{ $product->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('İşin növü') }}</th>
                                    <td>{{ $product->category ? $product->category->name : 'Kateqoriya yoxdur' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Podratçı təşkilatın adı') }}</th>
                                    <td>{{ $product->supplier ? $product->supplier->name : 'Təşkilat məlumatı yoxdur' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Vəsait Mənbəyi') }}</th>
                                    <td>{{ $product->unit ? $product->unit->name : 'Məlumat mövcud deyil' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Layihənin ehtimal olunan ümumi dəyəri') }}</th>
                                    <td>{{ number_format($product->quantity, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Müqavilənin dəyəri') }}</th>
                                    <td>{{ number_format($product->quantity_alert, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Ayrılmış vəsait') }}</th>
                                    <td>{{ number_format($product->buying_price, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Ödənilmiş vəsait') }}</th>
                                    <td>{{ number_format($product->selling_price, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Qalıq vəsait') }}</th>
                                    <td>{{ number_format($product->remaining_amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Akkreditivin qalığı') }}</th>
                                    <td>{{ number_format($product->accredited_balance, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Avans borcu') }}</th>
                                    <td>{{ number_format($product->advance_debt, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Yoxlanılan Forma 2') }}</th>
                                    <td>{{ number_format($product->inspection_form_2, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('EMİ də olan Forma 2 sənədi') }}</th>
                                    <td>{{ number_format($product->emi_form_2, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Layihənin bitməsi üçün tələb olunan ehtimal vəsait') }}</th>
                                    <td>{{ number_format($product->project_completion_estimate, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('2025-ci ilə tələb olunan vəsait') }}</th>
                                    <td>{{ number_format($product->estimated_funds_2025, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Layihə smeta sənədləri') }}</th>
                                    <td>{{ $product->project_estimate_documents }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Tikintiyə icarə sənəti') }}</th>
                                    <td>{{ $product->construction_permit }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Qeydlər') }}</th>
                                    <td>{{ $product->notes }}</td>
                                </tr>
                            </table>
                        </div>

                        <!-- Cavabları və şərhləri göstərmək -->
                        <div class="replies-section">
                            <h4>{{ __('Şərhlər') }}</h4>

                            @foreach($replies as $reply)
                                <div class="reply-item mb-3 p-3 border rounded">
                                    <p>{{ $reply->content }}</p>
                                    <small>
                                        @if($reply->created_at)
                                            {{ $reply->created_at->format('d.m.Y H:i') }}
                                        @else
                                            {{ __('Tarix mövcud deyil') }}
                                        @endif
                                    </small>

                                    <!-- Alt cavabları göstəririk -->
                                    @if($reply->children && $reply->children->count() > 0)
                                        @foreach($reply->children as $childReply)
                                            <!-- Alt cavabları göstər -->
                                        @endforeach
                                    @else
                                        <p>{{ __('Alt cavab yoxdur') }}</p>
                                    @endif

                                    <!-- Alt cavab yazmaq üçün forma -->
                                    <form action="{{ route('products.storeReply', $product->id) }}" method="post">

                                        @csrf
                                        <div class="mb-2">
                                            <textarea name="reply" class="form-control" rows="2" placeholder="Cavabınızı yazın..." required></textarea>
                                        </div>
                                        <input type="hidden" name="parent_id" value="{{ $reply->id }}">
                                        <button type="submit" class="btn btn-primary btn-sm">Cavab yaz</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>

                        <!-- Yeni şərh əlavə etmək üçün forma -->

                    </div>
@endsection
