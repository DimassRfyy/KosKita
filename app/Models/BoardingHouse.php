<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function rooms():HasMany {
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

    public function contacts():HasMany {
        return $this->hasMany(Contact::class);
    }

    public function facilities(): BelongsToMany {
        return $this->belongsToMany(Facility::class, 'boarding_house_facility');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    protected static function boot()
{
    parent::boot();

    // Hapus thumbnail saat data boarding house dihapus
    static::deleting(function ($boardingHouse) {
        if ($boardingHouse->thumbnail && Storage::disk('public')->exists($boardingHouse->thumbnail)) {
            Storage::disk('public')->delete($boardingHouse->thumbnail);
        }

        foreach ($boardingHouse->bonuses as $bonus) {
            if ($bonus->image && Storage::disk('public')->exists($bonus->image)) {
                Storage::disk('public')->delete($bonus->image);
            }
            $bonus->delete(); // Hapus record bonus
        }

        foreach ($boardingHouse->rooms as $room) {
            // Hapus gambar dari room
            foreach ($room->images as $image) {
                if ($image->image && Storage::disk('public')->exists($image->image)) {
                    Storage::disk('public')->delete($image->image);
                }
                $image->delete(); // Hapus record image
            }
            $room->delete(); // Hapus record room
        }
    });

    // Hapus thumbnail lama sebelum diperbarui
    static::updating(function ($boardingHouse) {
        if ($boardingHouse->isDirty('thumbnail') && $boardingHouse->getOriginal('thumbnail')) {
            Storage::disk('public')->delete($boardingHouse->getOriginal('thumbnail'));
        }
    });
}

}
