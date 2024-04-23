<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitGallery extends Model
{
    protected $table = 'unit_galleries';

    protected $fillable = [
        'unit_type_id',
        'gallery_image',
        'caption_image',
        'sort',
        'created_by',
        'updated_by',
    ];

    public function unitType()
    {
        return $this->belongsTo(UnitType::class, 'unit_type_id');
    }

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}

