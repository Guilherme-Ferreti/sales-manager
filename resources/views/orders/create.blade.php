@extends('layouts.app')

@section('content-header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('New order') }}</h1>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <form method="post" action="{{ route('orders.store') }}" id="order-form">
                @csrf
                <div id="product-container"></div>
                <div class="card-body">
                    <div class="row">
                        <h5 class="mb-4">{{ __('Address Information') }}</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cep">{{ __('CEP') }}</label>
                                <div class="input-group mb-3">
                                    <x-form.input
                                        type="text"
                                        id="cep-input" 
                                        name="address[cep]"
                                        placeholder="{{ __('CEP') }}"
                                        :value="old('address.cep')"
                                        errorKey="address.cep"
                                        icon="fa-search"
                                        autofocus
                                        required
                                        tabindex="1"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="street">{{ __('Street') }}</label>
                                <x-form.input
                                    type="text"
                                    id="street-input" 
                                    name="address[street]"
                                    placeholder="{{ __('Street') }}"
                                    :value="old('address.street')"
                                    errorKey="address.street"
                                    required
                                    tabindex="2"
                                />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="number">{{ __('Number') }}</label>
                                <x-form.input
                                    type="text"
                                    id="number-input" 
                                    name="address[number]"
                                    placeholder="{{ __('Number') }}"
                                    :value="old('address.number')"
                                    errorKey="address.number"
                                    required
                                    tabindex="3"
                                />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="neighborhood">{{ __('Neighborhood') }}</label>
                                <x-form.input
                                    type="text"
                                    id="neighborhood-input" 
                                    name="address[neighborhood]"
                                    placeholder="{{ __('Neighborhood') }}"
                                    :value="old('address.neighborhood')"
                                    errorKey="address.neighborhood"
                                    required
                                    tabindex="4"
                                /> 
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="city">{{ __('City') }}</label>
                                <x-form.input
                                    type="text"
                                    id="city-input"
                                    name="address[city]"
                                    placeholder="{{ __('City') }}"
                                    :value="old('address.city')"
                                    errorKey="address.city"
                                    required
                                    tabindex="5"
                                /> 
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="state">{{ __('State') }}</label>
                                <x-form.select
                                    id="state-select" 
                                    name="address[state]"
                                    :value="old('address.state')"
                                    errorKey="address.state"
                                    required
                                    tabindex="6"
                                    >
                                    @foreach ($states as $state)
                                        <option value="{{ $state['initials'] }}" @if (old('address.state') === $state['initials']) selected @endif>
                                            {{ $state['name'] }}
                                        </option>
                                    @endforeach
                                </x-form.select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <h5 class="mb-4 mt-4">{{ __('Order Information') }}</h5>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="sold_at">{{ __('Sold at') }}</label>
                                <x-form.input 
                                    type="date"
                                    name="sold_at"
                                    :value="old('sold_at')"
                                    required
                                    tabindex="6"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <h5 class="mt-4 mb-4">{{ __('Products') }}</h5>
                    </div>

                    <div class="row" id="add-product-form">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#product-search-modal">
                                        {{ __('Search') }} <span class="fas fa-search ml-3"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="product-id-input">{{ __('ID') }}</label>
                                        <input type="text" class="form-control" id="product-id-input" disabled/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="product-name-input">{{ __('Name') }}</label>
                                        <input type="text" class="form-control" id="product-name-input" disabled/>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="product-name-input">{{ __('Reference') }}</label>
                                        <input type="text" class="form-control" id="product-reference-input" disabled/>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="product-name-input">{{ __('Price') }}</label>
                                        <input type="number" class="form-control" id="product-price-input" step="0.01" min="0.01" disabled/>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="product-name-input">{{ __('Selling Price') }}</label>
                                        <input type="number" class="form-control" id="product-selling-price-input" step="0.01" min="0.01"/>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="product-name-input">{{ __('Quantity') }}</label>
                                        <input type="number" class="form-control" id="product-quantity-input" step="1" min="1"/>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex flex-column justify-content-center">
                                        <button type="button" class="btn btn-success mt-3" id="add-product-button">
                                            <span class="fas fa-plus"></span> 
                                            &nbsp; {{ __('Add to order') }}
                                        </button>
                                </div>
                            </div>
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
                                        <th>{{ __('Supplier(s)') }}</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            <div>
                                <b>{{ __('Total') }}: <span id="products-table-total">0,00</span></b>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="product-search-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Search for a product') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group">
                            <x-form.input 
                                type="text"
                                id="product-search-input"
                                name="product-search-input"
                                placeholder="{{ __('Search by name or reference') }}"
                                icon="fa-search"
                            />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hover text-nowrap mt-5 d-none" id="product-search-table">
                            <thead>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Reference') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th class="project-actions text-right">{{ __('Actions') }}</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    @include('scripts.orders.create')
@endsection