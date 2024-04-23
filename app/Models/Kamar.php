<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor',
        'harga',
        'fasilitas',
        'lokasi',
        'status',
        'keterangan',
    ];

    public function gambar(): HasMany
    {
        return $this->hasMany(GambarKamar::class, 'id_kamar');
    }

    public function penyewaan(): HasOne
    {
        return $this->hasOne(Penyewaan::class, 'id_kamar');
    }
}
