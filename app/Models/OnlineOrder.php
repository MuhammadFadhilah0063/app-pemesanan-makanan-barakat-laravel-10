<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OnlineOrder extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'online_order_id',
        'user_id',
        'name',
        'phone',
        'address',
        'pick_up_date',
        'pick_up_time',
        'estimation_time',
        'status',
        'total',
        'message',
        'payment_method',
        'snap_token',
        'reservation_id',
    ];

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $primaryKey = 'online_order_id';

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
     * Get the user that owns the order.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the reservation that owns the order.
     */
    public function reservation(): HasOne
    {
        return $this->hasOne(Reservation::class, 'reservation_id', 'reservation_id');
    }

    /**
     * Get the order items.
     */
    public function order_items(): HasMany
    {
        return $this->hasMany(OnlineOrderItem::class, 'online_order_id', 'online_order_id');
    }

    /**
     * Get the payment.
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'online_order_id', 'online_order_id');
    }
}
