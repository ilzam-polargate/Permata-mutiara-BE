<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'header',
        'sub_header',
        'img_header',
        'about',
        'sub_about',
        'layanan_1',
        'layanan_2',
        'layanan_3',
        'kamar',
        'sub_kamar',
        'kontak',
        'sub_kontak',
        'twitter',
        'facebook',
        'instagram',
    ];
}
