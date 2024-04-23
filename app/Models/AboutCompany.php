<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutCompany extends Model
{
    protected $fillable = [
        'image_primary',
        'caption_image',
        'headline',
        'description',
        'masterplan',
        'total_hectare',
        'total_housebuild',
        'created_by',
        'updated_by',
    ];

    // Relasi dengan user yang membuat data perusahaan
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi dengan user yang terakhir mengupdate data perusahaan
    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
