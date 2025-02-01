<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Facility extends Model
{
    protected $fillable = [
        'name',
        'icon',
    ];

    public function boardingHouses(): BelongsToMany {
        return $this->belongsToMany(BoardingHouse::class, 'boarding_house_facility');
    }
}
