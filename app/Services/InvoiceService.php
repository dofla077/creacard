<?php

namespace App\Services;

use App\Models\Invoice;

class InvoiceService
{

    /**
     * Create
     *
     * @param $quotation_id
     * @return mixed
     */
    public function create($quotation_id): mixed
    {
        return Invoice::create(['quotation_id' => $quotation_id]);
    }
}
