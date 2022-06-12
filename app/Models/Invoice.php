<?php

namespace App\Models;

use App\Models\Traits\SharpNumberTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes, SharpNumberTrait;

    protected $fillable = ['quotation_id'];

    protected $casts = [
        'sended_at' => 'datetime:Y-m-d',
    ];

    /**
     * Quotation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quotation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Quotation::class);
    }
}
