<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface ProductRepositoryInterface
{
    /**
     * Set the relationships to be eager loaded.
     */
    public function with(string|array $relations);

    /**
     * Find an product by its id.
     */
    public function findById(int $id): ?Model;
}
