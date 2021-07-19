@include('scripts.utils')

<script>
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

    const clearSelectedProduct = () => {
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

    const productIsValid = (product) => {
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