<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageBanner extends Model
{
    protected $fillable = [
        'image_banner',
        'headline',
        'subheadline',
        'text_button',
        'created_by',
        'updated_by',
    ];

    // Relasi dengan user yang membuat banner
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi dengan user yang terakhir mengupdate banner
    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
