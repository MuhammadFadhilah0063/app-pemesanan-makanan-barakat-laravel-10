<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Food extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'image',
        'description',
        'price',
        'ready',
    ];

    protected $primaryKey = 'food_id';

    /**
     * image
     *
     * @return Attribute
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('/storage/image/food/' . $value),
        );
    }

    /**
     * Get the cart items.
     */
    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class, 'food_id', 'food_id');
    }

    /**
     * Get the order items.
     */
    public function online_orders(): HasMany
    {
        return $this->hasMany(OnlineOrder::class, 'food_id', 'food_id');
    }

    /**
     * Get the order items.
     */
    public function offline_orders(): HasMany
    {
        return $this->hasMany(OfflineOrder::class, 'food_id', 'food_id');
    }

    /**
     * Get the category that owns the food.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
