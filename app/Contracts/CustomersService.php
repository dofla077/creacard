<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface CustomersService
{
    /**
     * Get customers
     *
     * @return Collection|array
     */
    public function getCustomers(): Collection|array;

    /**
     * Create customer
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed;

}
