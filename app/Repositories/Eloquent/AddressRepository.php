<?php

namespace App\Repositories\Eloquent;

use App\Models\Address;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use Illuminate\Support\Collection;

class AddressRepository extends BaseRepository implements AddressRepositoryInterface
{
    public function __construct(Address $address)
    {
        $this->model = $address;
    }

    public function create(array $attributes): ?Address
    {
        return $this->model->create($attributes);
    }
}
