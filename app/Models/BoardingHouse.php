<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BoardingHouse extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'city_id',
        'category_id',
        'description',
        'price',
        'address'
    ];

    public function city(): BelongsTo {
        return $this->belongsTo(City::class);
    }
    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function rooms ():HasMany {
        return $this->hasMany(Room::class);
    }

    public function bonuses():HasMany {
        return $this->hasMany(Bonus::class);
    }
    
    public function testimonials ():HasMany {
        return $this->hasMany(Testimonial::class);
    }

    public function transactions():HasMany {
        return $this->hasMany(Transaction::class);
    }
}
