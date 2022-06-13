<?php

namespace App\Events;

use App\Models\Quotation;
use App\Notifications\InvoiceSendNotification;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QuotationAcceptEvent
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
     * Send invoice
     *
     * @return void
     */
    public function sendInvoice(): void
    {
        $this->quotation->customer->notify(new InvoiceSendNotification($this->quotation->invoice));
    }

}
