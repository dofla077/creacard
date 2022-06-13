<?php

namespace App\Observers;

use App\Models\Invoice;
use Faker\Factory;

class InvoiceObserver
{
    /**
     * Handle the Invoice "creating" event.
     *
     * @param Invoice $invoice
     * @return void
     */
    public function creating(Invoice $invoice)
    {
        $invoice->number = $invoice->quotation_id . '-' . Factory::create()->unique()->numerify('###-###-####');
    }
}
