<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimonial extends Model
{
    protected $fillable = [
        'boarding_house_id',
        'name',
        'photo',
        'content',
        'rating'
    ];

    public function boardingHouse():BelongsTo {
        return $this->belongsTo(BoardingHouse::class);
    }

    protected static function boot()
    {
        parent::boot();

        // Hapus gambar saat data testimonial dihapus
        static::deleting(function ($testimonial) {
            if ($testimonial->photo && Storage::disk('public')->exists($testimonial->photo)) {
                Storage::disk('public')->delete($testimonial->photo);
            }
        });

        // Hapus gambar lama sebelum diperbarui
        static::updating(function ($testimonial) {
            if ($testimonial->isDirty('photo') && $testimonial->getOriginal('photo')) {
                Storage::disk('public')->delete($testimonial->getOriginal('photo'));
            }
        });
    }
}
