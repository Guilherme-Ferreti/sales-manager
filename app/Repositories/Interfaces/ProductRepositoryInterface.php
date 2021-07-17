<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface ProductRepositoryInterface
{
    /**
     * Set the relationships to be eager loaded.
     */
    public function with(string|array $relations);

    /**
     * Get all products.
     */
    public function all(): Collection;

    /**
     * Find an product by its id.
     */
    public function findById(int $id): ?Model;

    /**
     * Search for products based on name or reference.
     */
    public function searchByNameOrReference(string $search): ?Collection;
}
