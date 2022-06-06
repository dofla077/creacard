<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface QuotationsService
{
    /**
     * Get quotation
     *
     * @return Collection|array
     */
    public function getQuotations(): Collection|array;

    /**
     * Create quotation
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed;

}
