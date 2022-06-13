<?php

namespace App\Services;

use App\Contracts\QuotationsService;
use App\Models\Customer;
use App\Models\Quotation;

class QuotationService implements QuotationsService
{
    // quotation columns
    const COLUMNS = [
        ['label' => 'Number quotation', 'field' => 'number'],
        // ['label' => 'Label', 'field' => 'label'],
        ['label' => 'Price', 'field' => 'price'],
        ['label' => 'Customer', 'field' => 'customer'],
        ['label' => 'State', 'field' => 'state'],
        ['label' => 'Description', 'field' => 'description'],
        ['label' => 'Updated_at', 'field' => 'updated_at'],
        ['label' => 'Actions', 'field' => 'actions'],
    ];


    /**
     *  Get customers
     *
     */
    public function getQuotations(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Quotation::with('customer')->orderByDesc('id')->paginate();
    }

    /**
     * Get columns
     *
     * @return \Illuminate\Support\Collection
     */
    public function getColumns()
    {
        return collect(static::COLUMNS);
    }

    /**
     * @return mixed
     */
    public function getComponents(): mixed
    {
        return Customer::get(['id', 'firstname', 'lastname']);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed
    {
        return Quotation::create($data);
    }

    /**
     * Update quotation
     *
     * @param Quotation $quotation
     * @param array $data
     * @return bool
     */
    public function save(Quotation $quotation, array $data): bool
    {
        return $quotation->update($data);
    }

    /**
     * @throws \Throwable
     */
    public function delete(Quotation $quotation): ?bool
    {
        return $quotation->deleteOrFail();
    }


}
