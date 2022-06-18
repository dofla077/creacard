<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    public $fillable = ['user_id', 'firstname', 'lastname', 'email', 'phone', 'address'];

    /**
     * User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Quotations
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quotations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Quotation::class);
    }

    /**
     * Get the user's first name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => ucfirst($attributes['firstname']) . ' ' . ucfirst($attributes['lastname']),
        );
    }
}
