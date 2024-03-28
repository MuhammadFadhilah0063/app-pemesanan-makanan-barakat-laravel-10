<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cash extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cash',
        'total',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cash';

    public function reduceCash($total)
    {
        if ($this->total >= $total) {
            $this->total -= $total;
            $this->save();
            return true;
        } else {
            return false;
        }
    }

    public function addCash($total)
    {
        $this->total += $total;
        $this->save();
    }
}
