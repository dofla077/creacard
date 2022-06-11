<?php

namespace App\Events;

use App\Enums\QuotationState;
use App\Models\Quotation;
use App\Notifications\QuotationCustomerNotification;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QuotationProcessedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The quotation instance.
     *
     * @var Quotation
     */
    public Quotation $quotation;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Quotation $quotation)
    {
        $this->quotation = $quotation;
    }

    /**
     * @return void
     */
    public function processed(): void
    {
        $this->quotation->state = QuotationState::Pending->value;
        $this->quotation->save();

        $this->quotation->customer->notify(new QuotationCustomerNotification($this->quotation));
    }
}
