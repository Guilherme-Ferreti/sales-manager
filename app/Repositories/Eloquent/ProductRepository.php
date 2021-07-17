<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function findById(int $id): ?Product
    {
        return $this->model->find($id);
    }
}
