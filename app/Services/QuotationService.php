<?php

namespace App\Services;

use App\Contracts\QuotationsService;
use App\Enums\QuotationState;
use App\Events\QuotationAcceptEvent;
use App\Events\QuotationProcessedEvent;
use App\Events\QuotationReturnEvent;
use App\Models\Customer;
use App\Models\Quotation;

class QuotationService extends BaseService implements QuotationsService
{
    // quotation columns
    const COLUMNS = [
        ['label' => 'Number quotation', 'field' => 'number'],
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
        return Quotation::with('customer')->orderByDesc(static::UPDATED_AT)->paginate();
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

    public function sendNotification(Quotation $quotation)
    {
        QuotationProcessedEvent::dispatch($quotation);
    }

    public function returnState(Quotation $quotation, QuotationState $state)
    {
        $quotation->state = $state->value;
        $quotation->save();

        QuotationReturnEvent::dispatch($quotation, $state);

        if ($quotation->isAccept()) {
            (new InvoiceService)->create($quotation->id);
            QuotationAcceptEvent::dispatch($quotation->load('invoice'));
        }
    }


}
