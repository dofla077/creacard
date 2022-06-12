<?php

namespace App\Contracts;

interface QuotationsService
{
    /**
     * Get quotation
     *
     */
    public function getQuotations();

    /**
     * Create quotation
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed;

}
