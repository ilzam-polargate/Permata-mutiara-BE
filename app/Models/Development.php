<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Development extends Model
{
    protected $table = 'developments';

    protected $fillable = [
        'dev_image',
        'dev_name',
        'dev_description',
        'dev_category',
        'is_active',
        'is_subsidi',
        'is_sold',
        'created_by',
        'updated_by',
    ];

    public $timestamps = true; // Aktifkan timestamps

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}


