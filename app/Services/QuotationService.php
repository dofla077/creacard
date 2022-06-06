<?php

namespace App\Services;

use App\Contracts\QuotationsService;
use App\Models\Quotation;
use Illuminate\Database\Eloquent\Collection;

class QuotationService implements QuotationsService
{
    // quotation columns
    const COLUMNS = [
        ['label' => 'Number quotation', 'field' => 'number'],
        ['label' => 'Label', 'field' => 'label'],
        ['label' => 'State', 'field' => 'state'],
        ['label' => 'Price', 'field' => 'price'],
        ['label' => 'Description', 'field' => 'description'],
        ['label' => 'Customer', 'field' => 'customer'],
        ['label' => 'Updated_at', 'field' => 'updated_at'],
    ];


    /**
     *  Get customers
     *
     * @return Collection|array
     */
    public function getQuotations(): Collection|array
    {
        $customers = Quotation::with('customer')->get(['id', 'number', 'label', 'state', 'price', 'description', 'updated_at']);

        return [$customers->map(fn($item) => [
            'id' => $item->id,
            'number' => $item->number,
            'label' => $item->label,
            'state' => $item->state,
            'price' => $item->price . '€',
            'description' => $item->description,
            'customer' => $item->customer ? $item->customer->firsname . ' ' . $item->customer->lastname : 'n/a',
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
        return Quotation::create($data);
    }
}
