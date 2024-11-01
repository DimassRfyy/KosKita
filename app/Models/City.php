<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image',
    ];

    public function boardingHouses () :HasMany {
        return $this->hasMany(BoardingHouse::class);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    protected static function boot()
    {
        parent::boot();

        // Hapus gambar saat data city dihapus
        static::deleting(function ($city) {
            if ($city->image && Storage::disk('public')->exists($city->image)) {
                Storage::disk('public')->delete($city->image);
            }
        });

        // Hapus gambar lama sebelum diperbarui
        static::updating(function ($city) {
            if ($city->isDirty('image') && $city->getOriginal('image')) {
                Storage::disk('public')->delete($city->getOriginal('image'));
            }
        });
    }
}
