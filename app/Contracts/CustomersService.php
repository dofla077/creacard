<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface CustomersService
{
    /**
     * Get customers
     *
     */
    public function getCustomers();

    /**
     * Create customer
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed;

}
