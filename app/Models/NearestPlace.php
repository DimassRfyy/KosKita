<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NearestPlace extends Model
{
    protected $fillable = [
        'boarding_house_id',
        'name',
        'distance',
        'icon',
    ];

    public function boardingHouse():BelongsTo {
        return $this->belongsTo(BoardingHouse::class);
    }
}
