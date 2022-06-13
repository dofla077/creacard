<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait SharpNumberTrait
{

    /**
     * Get the number with sharp
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function number(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => '#' . $value,
        );
    }
}
