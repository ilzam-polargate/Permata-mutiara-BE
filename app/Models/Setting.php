<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'page_title',
        'page_subtitle',
        'page_meta_keyword',
        'page_meta_description',
        'created_by',
        'updated_by',
    ];

    // Relasi untuk user yang membuat setting
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi untuk user yang terakhir mengupdate setting
    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
