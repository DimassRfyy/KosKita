<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'avatar',
        'email',
        'phone',
        'boarding_house_id',
    ];

    public function boardingHouse(): BelongsTo {
        return $this->belongsTo(BoardingHouse::class);
    }

    protected static function boot()
    {
        parent::boot();

        // Hapus gambar saat avatar dihapus
        static::deleting(function ($contact) {
            if ($contact->image && Storage::disk('public')->exists($contact->avatar)) {
                Storage::disk('public')->delete($contact->avatar);
            }
        });

        // Hapus gambar lama sebelum diperbarui
        static::updating(function ($contact) {
            if ($contact->isDirty('avatar') && $contact->getOriginal('avatar')) {
                Storage::disk('public')->delete($contact->getOriginal('avatar'));
            }
        });
    }
}
