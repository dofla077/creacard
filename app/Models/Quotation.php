<?php

namespace App\Models;

use App\Enums\QuotationState;
use App\Observers\QuotationObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Quotation extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $fillable = ['label', 'customer_id', 'number', 'state', 'price', 'description'];

    protected $casts = [
        'state' => QuotationState::class
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function invoice(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Invoice::class);
    }

    /**
     * @return bool
     */
    public function isSend(): bool
    {
        return $this->state === QuotationState::Pending;
    }

    /**
     * @return bool
     */
    public function isAccept(): bool
    {
        return $this->state === QuotationState::Accept;
    }


}
