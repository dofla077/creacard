<?php

namespace App\Services;

use App\Contracts\CustomersService;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class CustomerService implements CustomersService
{
    // customer columns
    const COLUMNS = [
        ['field' => 'id', 'label' => 'ID', 'width' => 40, 'numeric' => true],
        ['label' => 'Firstname', 'field' => 'firstname'],
        ['label' => 'Lastname', 'field' => 'lastname'],
        ['label' => 'Email', 'field' => 'email'],
        ['label' => 'Phone number', 'field' => 'phone'],
        ['label' => 'Address', 'field' => 'address'],
        ['label' => 'Quotations number (devis)', 'field' => 'quotations'],
        ['label' => 'Updated_at', 'field' => 'updated_at'],
    ];


    /**
     *  Get customers
     *
     * @return Collection|array
     */
    public function getCustomers(): Collection|array
    {
        $customers = Customer::withCount('quotations')->get(['id', 'firstname', 'lastname', 'email', 'phone', 'address', 'updated_at']);

        return [$customers->map(fn($item) => [
            'id' => $item->id,
            'firstname' => $item->firstname,
            'lastname' => $item->lastname,
            'email' => $item->email,
            'phone' => $item->phone,
            'address' => $item->address,
            'quotations' => $item->quotations_count,
            'updated_at' => $item->updated_at->format('Y-m-d'),
        ]),
            collect(static::COLUMNS),
        ];
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed
    {
        return Customer::create(Arr::add($data, 'user_id', Auth::id()));
    }
}
