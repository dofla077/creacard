<?php

namespace App\Listeners;

use App\Events\QuotationAcceptEvent;
use App\Events\QuotationProcessedEvent;
use App\Events\QuotationReturnEvent;


class QuotationEventSubscriber
{

    /**
     * Handle the event.
     *
     * @param QuotationProcessedEvent $event
     * @return void
     */
    public function handleQuotationProcessed(QuotationProcessedEvent $event): void
    {
        $event->processed();
    }

    /**
     * Handle the event.
     *
     * @param QuotationReturnEvent $event
     * @return void
     */
    public function handleNotifyUserReturn(QuotationReturnEvent $event): void
    {
        $event->notify();
    }

    /**
     * Handle the event.
     *
     * @param QuotationAcceptEvent $event
     * @return void
     */
    public function handleSendInvoice(QuotationAcceptEvent $event): void
    {
        $event->sendInvoice();
    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        return [
            QuotationProcessedEvent::class => 'handleQuotationProcessed',
            QuotationReturnEvent::class => 'handleNotifyUserReturn',
            QuotationAcceptEvent::class => 'handleSendInvoice',
        ];
    }
}
