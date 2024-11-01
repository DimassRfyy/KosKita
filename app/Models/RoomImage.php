<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomImage extends Model
{
    protected $fillable = [
        'room_id',
        'image',
    ];

    public function room ():BelongsTo {
        return $this->belongsTo(Room::class);
    }

    protected static function boot()
{
    parent::boot();

    // Hapus gambar saat data room image dihapus
    static::deleting(function ($roomImage) {
        if ($roomImage->image && Storage::disk('public')->exists($roomImage->image)) {
            Storage::disk('public')->delete($roomImage->image);
        }
    });

    // Hapus gambar lama sebelum diperbarui
    static::updating(function ($roomImage) {
        if ($roomImage->isDirty('image') && $roomImage->getOriginal('image')) {
            Storage::disk('public')->delete($roomImage->getOriginal('image'));
        }
    });
}

}
