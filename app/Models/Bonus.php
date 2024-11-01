<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
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

    protected static function boot()
{
    parent::boot();

    // Hapus gambar saat data bonus dihapus
    static::deleting(function ($bonus) {
        if ($bonus->image && Storage::disk('public')->exists($bonus->image)) {
            Storage::disk('public')->delete($bonus->image);
        }
    });

    // Hapus gambar lama sebelum diperbarui
    static::updating(function ($bonus) {
        if ($bonus->isDirty('image') && $bonus->getOriginal('image')) {
            Storage::disk('public')->delete($bonus->getOriginal('image'));
        }
    });
}

}
