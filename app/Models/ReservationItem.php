<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReservationItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reservation_id',
        'table_id',
    ];

    protected $primaryKey = 'reservation_item_id';

    /**
     * Get the reservation that owns the reservation item.
     */
    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class, 'reservation_id', 'reservation_id');
    }

    /**
     * Get the table that owns the reservation item.
     */
    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }
}
