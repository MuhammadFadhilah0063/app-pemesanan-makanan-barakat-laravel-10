<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'payment_id',
        'online_order_id',
        'offline_order_id',
        'payment_method',
        'payment_status',
    ];

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $primaryKey = 'payment_id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * image
     *
     * @return Attribute
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('/storage/image/payments/' . $value),
        );
    }

    /**
     * Get the order that owns the payment.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(OnlineOrder::class, 'online_order_id', 'online_order_id');
    }

    /**
     * Get the offline_order that owns the payment.
     */
    public function offline_order(): BelongsTo
    {
        return $this->belongsTo(OfflineOrder::class, 'offline_order_id', 'offline_order_id');
    }
}
