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

    function formatCurrency(value) {
        return Intl.NumberFormat('pt-br', {
            style: 'currency',
            currency: 'BRL'
        }).format(value);
    }
</script>