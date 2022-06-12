<?php

namespace App\Models;

use App\Enums\QuotationState;
use App\Models\Traits\SharpNumberTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Response;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Route;

class Quotation extends Model
{
    use HasFactory, SoftDeletes, Notifiable, SharpNumberTrait;

    protected $fillable = ['label', 'customer_id', 'number', 'state', 'price', 'description'];

    protected $casts = [
        'state' => QuotationState::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();

        Route::bind('state', function ($value) {
            abort_unless(
                $value === QuotationState::Reject->value || $value === QuotationState::Accept->value,
                Response::HTTP_NOT_FOUND,
            );

            return $value;
        });
    }

    /**
     * Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Invoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function invoice(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Invoice::class);
    }

    /**
     * Is reject
     *
     * @return bool
     */
    public function isReject(): bool
    {
        return $this->state === QuotationState::Reject;
    }

    /**
     * Is pending
     *
     * @return bool
     */
    public function isPending(): bool
    {
        return $this->state === QuotationState::Pending;
    }

    /**
     * Is accept
     *
     * @return bool
     */
    public function isAccept(): bool
    {
        return $this->state === QuotationState::Accept;
    }

    /**
     * Is not defined
     *
     * @return bool
     */
    public function isNotDefined(): bool
    {
        return $this->state === QuotationState::NotDefined;
    }
}
