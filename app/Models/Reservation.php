<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reservation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reservation_id',
        'name',
        'phone',
        'reservation_status',
        'user_id',
        'reservation_date',
        'reservation_time',
        'visit_time',
        'finished_time',
        'estimation_time',
        'waiting',
    ];

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $primaryKey = 'reservation_id';

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
     * Get the OnlineOrder.
     */
    public function online_order(): BelongsTo
    {
        return $this->belongsTo(OnlineOrder::class, 'reservation_id', 'reservation_id');
    }

    /**
     * Get the user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Get the reservation items.
     */
    public function reservation_items(): HasMany
    {
        return $this->hasMany(ReservationItem::class, 'reservation_id', 'reservation_id');
    }
}
