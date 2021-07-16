<?php

namespace App\Repositories\Eloquent;

abstract class BaseRepository
{
    protected $model;

    protected $with = [];

    public function with(string|array $relations)
    {
        if (is_string($relations)) {
            $relations = [$relations];
        }

        $this->with = $relations;

        return $this;
    }
}
