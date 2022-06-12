<?php

namespace App\Services;

use App\Contracts\CustomersService;
use App\Models\Customer;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class CustomerService extends BaseService implements CustomersService
{
    // customer columns
    const COLUMNS = [
        ['label' => 'Firstname', 'field' => 'firstname'],
        ['label' => 'Lastname', 'field' => 'lastname'],
        ['label' => 'Email', 'field' => 'email'],
        ['label' => 'Phone number', 'field' => 'phone'],
        ['label' => 'Address', 'field' => 'address'],
        ['label' => 'Quotations number (devis)', 'field' => 'quotations'],
        ['label' => 'Updated_at', 'field' => 'updated_at'],
    ];


    /**
     * Get customers
     *
     * @param bool $paginate
     * @return mixed
     */
    public function getCustomers(bool $paginate = true): mixed
    {
        $customer = Customer::withCount('quotations')->orderByDesc(static::UPDATED_AT);

        return $paginate ? $customer->paginate() : $customer->get();
    }

    /**
     * Get columns
     *
     * @return \Illuminate\Support\Collection
     */
    public function getColumns(): \Illuminate\Support\Collection
    {
        return collect(static::COLUMNS);
    }

    /**
     * Create
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed
    {
        return Customer::create(Arr::add($data, 'user_id', Auth::id()));
    }
}
