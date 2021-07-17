<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ExistsInRepository implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($repository, string $column)
    {
        $this->repository = $repository;
        $this->method_name = 'findBy' . ucfirst($column);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $model = $this->repository->{$this->method_name}($value);

        return ($model ? true : false);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be an existing record.';
    }
}
