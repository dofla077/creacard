<?php

namespace App\Observers;

use App\Models\Quotation;
use Faker\Factory;

class QuotationObserver
{
    /**
     * Handle the Quotation "created" event.
     *
     * @param Quotation $quotation
     * @return void
     */
    public function creating(Quotation $quotation)
    {
        $quotation->number = Factory::create()->unique()->numerify('###-###-####');
    }
}
