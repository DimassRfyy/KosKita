<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rule extends Model
{
    protected $fillable = [
        'name',
        'boarding_house_id',
    ];

    public function boardingHouse(): BelongsTo {
        return $this->belongsTo(BoardingHouse::class);
    }
}
