<?php

namespace App\Services;

use App\Contracts\QuotationsService;
use App\Enums\QuotationState;
use App\Events\QuotationAcceptEvent;
use App\Events\QuotationProcessedEvent;
use App\Events\QuotationReturnEvent;
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

    const ANSWER_ALREADY = 'you already answered';
    const ANSWER_SUCCESS = 'Thanks you for your response !!';

    /**
     * Index data
     *
     * @return array
     */
    public function getIndexData(): array
    {
        return [
            $this->getQuotations(),
            $this->getColumns(),
            QuotationState::cases(),
            $this::NA
        ];
    }

    /**
     * Get customers
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
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
     * Delete
     *
     * @throws \Throwable
     */
    public function delete(Quotation $quotation): ?bool
    {
        return $quotation->deleteOrFail();
    }

    /**
     * Send notification
     *
     * @param Quotation $quotation
     * @return void
     */
    public function sendNotification(Quotation $quotation): void
    {
        QuotationProcessedEvent::dispatch($quotation);
    }

    /**
     * Customer choice
     *
     * @param Quotation $quotation
     * @param QuotationState $state
     * @return string
     */
    public function customerChoice(Quotation $quotation, QuotationState $state): string
    {
        $quotation->state = $state->value;
        $quotation->save();

        QuotationReturnEvent::dispatch($quotation, $state);

        if ($quotation->isAccept()) {
            (new InvoiceService)->create($quotation->id);
            QuotationAcceptEvent::dispatch($quotation->load('invoice'));
        }

        return static::ANSWER_SUCCESS;
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
     * Create
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed
    {
        return Quotation::create($data);
    }
}
