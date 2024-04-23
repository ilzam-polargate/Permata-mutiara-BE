<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitType extends Model
{
    protected $table = 'unit_types';

    protected $fillable = [
        'unit_title',
        'unit_subtitle',
        'unit_floorplan',
        'unit_spec',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function galleries()
    {
        return $this->hasMany(UnitGallery::class, 'unit_type_id');
    }
}

