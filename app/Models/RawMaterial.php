<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RawMaterial extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'unit',
        'stock',
    ];

    public function reduceStock($quantity)
    {
        if ($quantity <= $this->stock) {
            $this->stock -= $quantity;
            $this->save();
            return true;
        } else {
            return false;
        }
    }

    public function addStock($quantity)
    {
        $this->stock += $quantity;
        $this->save();
    }

    /**
     * Get the purchases.
     */
    public function purchases(): HasMany
    {
        return $this->hasMany(PurchaseOfRawMaterial::class, 'raw_material_id', 'id');
    }
}
