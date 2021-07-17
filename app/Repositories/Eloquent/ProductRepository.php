<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Collection;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function all(): Collection
    {
        return $this->model->with($this->with)->get();
    }

    public function findById(int $id): ?Product
    {
        return $this->model->find($id);
    }

    public function searchByNameOrReference(string $search): Collection
    {
        return $this->model
                ->with($this->with)
                ->where('name', 'like', "%$search%")
                ->orWhere('reference', 'like', "%$search%")
                ->get();
    }
}
