<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $fillable = [
        'name_sosmed',
        'is_active',
        'link_sosmed',
        'sort_sosmed',
    ];

    // Mengubah tipe kolom 'is_active' menjadi boolean
    protected $casts = [
        'is_active' => 'boolean',
    ];
}
