<?php

namespace App\Services;

use App\Models\Invoice;

class InvoiceService
{

    public function create($quotation_id)
    {
        return Invoice::create(['quotation_id' => $quotation_id]);
    }
}
