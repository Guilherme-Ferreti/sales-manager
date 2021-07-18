@extends('layouts.app')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Order #') . " $order->id" }}</h1>
    </div>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-md-12">
                    <b>{{ __('Address Information') }}:</b> {{ "{$order->address->street}, {$order->address->number}, {$order->address->neighborhood} -  {$order->address->city} / {$order->address->state}" }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <b>{{ __('Sold at') }}:</b> {{ $order->sold_at->format('d/m/Y') }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover text-nowrap mt-5" id="products-table">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Product') }}</th>
                                <th>{{ __('Reference') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Selling Price') }}</th>
                                <th>{{ __('Quantity') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->reference }}</td>
                                    <td>{{ format_currency($product->price) }}</td>
                                    <td>{{ format_currency($product->pivot->selling_price) }}</td>
                                    <td>{{ $product->pivot->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        <b>{{ __('Total') }}: {{ format_currency($order->totalValue) }}</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection