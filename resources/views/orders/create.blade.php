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
<script>
    function appendToTemplate(element, tagName, html) {
        const wrappElement = document.createElement(tagName);

        wrappElement.innerHTML = html;

        element.append(wrappElement);

        return wrappElement;
    }

    function showErrorForInput(input, message = '') {
        input.classList.add('is-invalid');

        const spanEl = document.getElementById(`${input.id}-error-message`);

        spanEl.classList.remove('d-none');
        spanEl.innerText = message;

        setTimeout(() => {
            spanEl.classList.add('d-none');
            input.classList.remove('is-invalid');
        }, 5000);
    }

    const cepInput = document.getElementById('cep-input');
    const streetInput = document.getElementById('street-input');
    const numberInput = document.getElementById('number-input');
    const neighborhoodInput = document.getElementById('neighborhood-input');
    const cityInput = document.getElementById('city-input');
    const stateSelect = document.getElementById('state-select');

    const searchCepButton = cepInput.nextElementSibling;

    searchCepButton.addEventListener('click', e => {
        const ajax = new XMLHttpRequest();

        ajax.onload = function () {
            const response = JSON.parse(this.responseText);

            if (this.status !== 200 || response.erro) {
                showErrorForInput(cepInput, "{{ __('Impossible to localize the given CEP. Please try again.') }}");
                return;
            }

            streetInput.value = `${response.logradouro}`;
            neighborhoodInput.value = response.bairro;
            cityInput.value = response.localidade;
            stateSelect.value = response.uf;
        }

        ajax.onerror = function () {
            showErrorForInput(cepInput, "{{ __('Something went wrong. Please try again.') }}");
        }

        ajax.open('GET', `https://viacep.com.br/ws/${cepInput.value.replace(/[^0-9]+/g, '')}/json/`, true);

        ajax.setRequestHeader('Accept', 'application/json');

        ajax.send();
    });

    const productIdInput = document.getElementById('product-id-input');
    const productNameInput = document.getElementById('product-name-input');
    const productReferenceInput = document.getElementById('product-reference-input');
    const productPriceInput = document.getElementById('product-price-input');
    const productSellingPriceInput = document.getElementById('product-selling-price-input');
    const productQuantityInput = document.getElementById('product-quantity-input');
    const addProductButton = document.getElementById('add-product-button');

    const productsTable = document.getElementById('products-table');

    const orderForm = document.getElementById('order-form');
    
    const addProductForm = orderForm.querySelector('#add-product-form');

    const setSelectedProduct = (product) => {
        productIdInput.value = product.id;
        productNameInput.value = product.name;
        productReferenceInput.value = product.reference;
        productPriceInput.value = product.price;
        productSellingPriceInput.value = product.price;
        productQuantityInput.value = 1;

        sessionStorage.setItem('selected_product', JSON.stringify(product));
    }

    const getSelectedProduct = () => {
        return JSON.parse(sessionStorage.getItem('selected_product'));
    }

    function clearSelectedProduct() {
        productIdInput.value = '';
        productNameInput.value = '';
        productReferenceInput.value = '';
        productPriceInput.value = '';
        productSellingPriceInput.value = '';
        productQuantityInput.value = '';

        sessionStorage.removeItem('selected_product');
    }

    const productSearchInput = document.getElementById('product-search-input');
    const productSearchButton = productSearchInput.nextElementSibling;
    const productSearchTable = document.getElementById('product-search-table');
    const productSearchModal = document.getElementById('product-search-modal');

    const renderSearchProductTable = (products) => {
        const tbodyEl = productSearchTable.querySelector('tbody');

        tbodyEl.innerHTML = '';

        products.forEach(product => {
            const html = `
                <td>${product.id}</td>
                <td>${product.name}</td>
                <td>${product.reference}</td>
                <td>${product.price}</td>
                <td class="project-actions text-right">
                    <button class="btn btn-info btn-xs" href="#">
                        <i class="fas fa-plus"></i>
                        {{ __('Choose') }}
                    </button>
                </td>
            `;

            const tr = appendToTemplate(tbodyEl, 'tr', html);

            tr.querySelector('button').addEventListener('click', () => {
                setSelectedProduct(product);

                productSearchModal.querySelector('button[data-dismiss=modal]').click();
            });
        });

        productSearchTable.classList.remove('d-none');
    }

    const clearProductSearchTable = () => {
        productSearchTable.classList.add('d-none');

        productSearchTable.querySelector('tbody').innerHTML = '';
    }

    function searchProduct() {
        const search = productSearchInput.value;

        if (search === '') {
            return;
        }

        const ajax = new XMLHttpRequest();

        ajax.onerror = function () {
            clearProductSearchTable();

            showErrorForInput(productSearchInput, "{{ __('Something went wrong. Please try again.') }}");
            return;
        }

        ajax.onload = function () {
            if (this.status !== 200) {
                clearProductSearchTable();

                showErrorForInput(productSearchInput, "{{ __('Something went wrong. Please try again.') }}");
                return;
            }

            const response = JSON.parse(this.responseText);

            if (response.data.length === 0) {
                showErrorForInput(productSearchInput, "{{ __('No products were found.') }}");
                return;
            }

            renderSearchProductTable(response.data);
        }

        ajax.open('GET', `{{ route('api.products.index') }}?search=${search}`, true);

        ajax.setRequestHeader('Accept', 'application/json');

        ajax.send();
    }

    function productIsValid(product) {
        let isValid = true;

        Object.keys(product).forEach(key => {
            if (product[key] === '') {
                isValid = false;
            }
        });

        if (+product.quantity < 1 || +product.selling_price < 0.01) {
            isValid = false;
        }
        
        return isValid;
    }

    const addProductToOrder = () => {
        const selectedProduct = getSelectedProduct();

        if (! selectedProduct) {
            alert("{{ __('Could not add the product to the order.') }}");
            return;
        }

        selectedProduct.selling_price = productSellingPriceInput.value;
        selectedProduct.quantity = productQuantityInput.value;

        if (! productIsValid(selectedProduct)) {
            alert("{{ __('Could not add the product to the order.') }}");
            return;
        }

        pushToProducts(selectedProduct);

        renderProductsTable();
        addProductsToForm();
        clearSelectedProduct();
    }

    const getProducts = () => {
        let products = JSON.parse(sessionStorage.getItem('products'));

        if (! products) products = [];

        return products;
    }

    const setProducts = (products) => {
        sessionStorage.setItem('products', JSON.stringify(products));
    }

    const pushToProducts = (newProduct) => {
        let isNew = true;

        const products = getProducts();

        products.forEach(product => {
            if (product.id === newProduct.id) {
                product.quantity = newProduct.quantity;
                product.selling_price = newProduct.selling_price;

                isNew = false;
            }
        });

        if (isNew) {
            products.push(newProduct);
        }

        setProducts(products);
    }

    const clearProducts = () => {
        sessionStorage.removeItem('products');
        sessionStorage.removeItem('selected_product');
    }

    const renderProductsTable = () => {
        const tbodyEl = productsTable.querySelector('tbody');

        tbodyEl.innerHTML = '';

        const products = getProducts();

        products.forEach(product => {
            if (! productIsValid(product)) {
                return;
            }

            let suppliers = '';

            product.suppliers.forEach(supplier => {
                suppliers = suppliers  + supplier.name + ', '
            });

            const html = `
                <td>${product.id}</td>
                <td>${product.name}</td>
                <td>${product.reference}</td>
                <td>${formatCurrency(product.price)}</td>
                <td>${formatCurrency(product.selling_price)}</td>
                <td>${product.quantity}</td>
                <td>${suppliers}</td>
            `;

            appendToTemplate(tbodyEl, 'tr', html);
        });

        document.getElementById('products-table-total').innerText = formatCurrency(getProductsTotalPrice());
    }

    const addProductsToForm = () => { 
        const container = orderForm.querySelector('#product-container');

        container.innerHTML = '';

        getProducts().forEach((product, index) => {
            if (! productIsValid(product)) {
                return;
            }

            const html = `
                <input type="hidden" name="products[${index}][id]" value="${product.id}">
                <input type="hidden" name="products[${index}][selling_price]" value="${product.selling_price}">
                <input type="hidden" name="products[${index}][quantity]" value="${product.quantity}">
            `;

            appendToTemplate(container, 'div', html);
        });
    }

    const getProductsTotalPrice = () => {
        let total = 0;

        const products = getProducts();

        products.forEach(product => {
            if (! productIsValid(product)) {
                return;
            }

            total += +product.selling_price * +product.quantity;
        });

        return total;
    }

    function formatCurrency(value) {
        return Intl.NumberFormat('pt-br', {
            style: 'currency',
            currency: 'BRL'
        }).format(value);
    }

    productSearchButton.addEventListener('click', searchProduct);

    productSearchInput.addEventListener('keypress', e => {
        if (e.key === 'Enter') {
            searchProduct();
        }
    });

    addProductButton.addEventListener('click', addProductToOrder);

    if (document.referrer !== "{{ route('orders.create') }}") {
        clearProducts();
    }

    orderForm.addEventListener('submit', e => {
        e.preventDefault();

        if (getProducts().length < 1) {
            alert("{{ __('An order needs to have at least one product.') }}");
            return;
        }

        orderForm.submit();
    });

    renderProductsTable();
    addProductsToForm();
</script>
@endsection