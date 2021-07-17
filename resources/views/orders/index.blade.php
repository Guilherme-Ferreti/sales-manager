@extends('layouts.app')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Orders') }}</h1>
    </div>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-7">
                    <h3 class="card-title">{{ __('Orders') }}</h3>
                </div>
                <div class="col-md-5">
                    <div class="row justify-content-end">
                        <a href="{{ route('orders.create') }}" class="btn btn-sm btn-success">
                            <i class="fas fa-plus-circle"></i>
                            {{ __('New') }} 
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table">
                <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Sold at') }}</th>
                    <th>{{ __('Total Items') }}</th>
                    <th>{{ __('Total Value') }}</th>
                    <th class="project-actions text-right">{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->sold_at->format('d/m/Y') }}</td>
                        <td>{{ $order->totalItems }}</td>
                        <td>{{ format_currency($order->totalValue) }}</td>
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-xs" href="{{ route('orders.show', $order) }}">
                                    <i class="fas fa-eye"></i>
                                    {{ __('See') }}
                                </a>
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection