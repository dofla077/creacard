<?php

namespace App\Events;

use App\Enums\QuotationState;
use App\Models\Quotation;
use App\Notifications\UserNotifyNotification;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QuotationReturnEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The quotation instance.
     *
     * @var Quotation
     */
    public Quotation $quotation;

    /**
     * Quotation state
     *
     * @var QuotationState
     */
    public QuotationState $state;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Quotation $quotation, QuotationState $state)
    {
        $this->quotation = $quotation;
        $this->state = $state;
    }

    /**
     * Notify
     *
     * @return void
     */
    public function notify()
    {
        $this->quotation->customer->user->notify(new UserNotifyNotification($this->quotation, $this->state));
    }
}
