<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface OrderRepositoryInterface
{
    /**
     * Set the relationships to be eager loaded.
     */
    public function with(string|array $relations);

    /**
     * Get all models.
     */
    public function all(): Collection;

    /**
     * Create a model.
     */
    public function create(array $attributes): ?Model;

    /**
     * Find a model by its id.
     */
    public function findById(int $id): ?Model;
}
