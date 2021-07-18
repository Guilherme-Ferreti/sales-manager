<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    public function all(): Collection
    {
        return $this->model->with($this->with)->orderBy('created_at', 'desc')->get();
    }

    public function allPaginated(int $page = 1, int $perPage = 15)
    {
        return $this->model->with($this->with)->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function create(array $attributes): ?Order
    {
        return $this->model->create($attributes);
    }

    public function findById(int $id): ?Order
    {
        return $this->model->with($this->with)->find($id);
    }

    public function attachProduct(int $order_id, array $attributes): bool
    {
        return DB::table('order_product')->insert([
            'order_id' => $order_id,
            'product_id' => $attributes['id'],
            'quantity' => $attributes['quantity'],
            'selling_price' => $attributes['selling_price'],
        ]);
    }
}
