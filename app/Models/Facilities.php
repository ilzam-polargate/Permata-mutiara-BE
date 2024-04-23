<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facilities extends Model
{
    protected $fillable = [
        'facilities_category_id',
        'facilities_image',
        'facilities_name',
        'created_by',
        'updated_by',
    ];

    // Relasi dengan kategori fasilitas
    public function category()
    {
        return $this->belongsTo(FacilitiesCategory::class, 'facilities_category_id');
    }

    // Relasi dengan user yang membuat fasilitas
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi dengan user yang terakhir mengupdate fasilitas
    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
