<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Support\Collection;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    public function all(): Collection
    {
        return $this->model->with($this->with)->get();
    }

    public function create(array $attributes): ?Order
    {
        return $this->model->create($attributes);
    }

    public function findById(int $id): ?Order
    {
        return $this->model->find($id);
    }
}
