<?php

namespace App\Http\Requests;

use App\Rules\Cep;
use App\Rules\BrazilianState;
use App\Rules\ExistsInRepository;
use Illuminate\Foundation\Http\FormRequest;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class OrderRequest extends FormRequest
{
    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;

        Parent::__construct();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ($this->isMethod('post') ? $this->store() : $this->update());
    }

    protected function store(): array
    {
        return [
            'sold_at'                   => ['required', 'date_format:Y-m-d'],
            'address.cep'               => ['required', 'min:9', 'max:9', new Cep()],
            'address.street'            => ['required', 'string', 'max:255'],
            'address.number'            => ['required', 'digits_between:1,6'],
            'address.neighborhood'      => ['required', 'string', 'max:255'],
            'address.city'              => ['required', 'string', 'max:255'],
            'address.state'             => ['required', 'string', 'max:255', new BrazilianState()],
            'products'                  => ['required', 'array'],
            'products.*.product_id'     => ['required', 'integer', new ExistsInRepository($this->repository, 'id')],
            'products.*.quantity'       => ['required', 'integer', 'min:1'],
            'products.*.selling_price'  => ['required', 'numeric', 'min:0'],
        ];
    }

    public function attributes(): array
    {
        return [
            'address.cep'           => 'cep',
            'address.street'        => 'street', 
            'address.number'        => 'number', 
            'address.neighborhood'  => 'neighborhood', 
            'address.city'          => 'city', 
            'address.state'         => 'state', 
        ];
    }
}
