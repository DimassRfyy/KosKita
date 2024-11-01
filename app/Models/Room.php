<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends Model
{
    protected $fillable = [
        'boarding_house_id',
        'name',
        'room_type',
        'capacity',
        'square_feet',
        'price_per_month',
        'is_available',
    ];

    public function boardingHouse():BelongsTo {
        return $this->belongsTo(BoardingHouse::class);
    }

    public function images():HasMany {
        return $this->hasMany(RoomImage::class);
    }
    public function transactions():HasMany {
        return $this->hasMany(Transaction::class);
    }

    protected static function boot()
{
    parent::boot();

    static::deleting(function ($room) {
        // Hapus semua RoomImage terkait
        foreach ($room->images as $roomImage) {
            if ($roomImage->image && Storage::disk('public')->exists($roomImage->image)) {
                Storage::disk('public')->delete($roomImage->image);
            }
            $roomImage->delete(); // Hapus record RoomImage
        }
    });
}

}
