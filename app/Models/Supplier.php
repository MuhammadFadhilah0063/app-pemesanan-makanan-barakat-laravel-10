<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'address',
        'description',
    ];

    /**
     * Get the purchases.
     */
    public function purchases(): HasMany
    {
        return $this->hasMany(PurchaseOfRawMaterial::class, 'supplier_id', 'id');
    }
}
