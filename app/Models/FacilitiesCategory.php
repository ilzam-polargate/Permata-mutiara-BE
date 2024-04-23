<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilitiesCategory extends Model
{
    protected $fillable = [
        'cat_image',
        'cat_title',
        'cat_subtitle',
        'created_by',
        'updated_by',
    ];

    // Relasi dengan user yang membuat kategori fasilitas
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi dengan user yang terakhir mengupdate kategori fasilitas
    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Relasi dengan fasilitas yang dimiliki oleh kategori ini
    public function facilities()
    {
        return $this->hasMany(Facilities::class, 'facilities_category_id');
    }
}
