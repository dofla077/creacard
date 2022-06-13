<?php

namespace App\Contracts;

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
