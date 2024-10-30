<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bonus extends Model
{
    protected $fillable = [
        'boarding_house_id',
        'name',
        'image',
        'description',
    ];

    public function boardingHouse():BelongsTo {
        return $this->belongsTo(BoardingHouse::class);
    }
}
