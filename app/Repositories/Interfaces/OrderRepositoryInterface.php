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
     * Get all orders.
     */
    public function all(): Collection;

    /**
     * Create an order.
     */
    public function create(array $attributes): ?Model;

    /**
     * Find an order by its id.
     */
    public function findById(int $id): ?Model;

    /**
     * Attach a product to the given order.
     */
    public function attachProduct(int $order_id, array $attributes): bool;
}
