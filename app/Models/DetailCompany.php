<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailCompany extends Model
{
    protected $table = 'detail_company';

    protected $fillable = [
        'logo_header',
        'logo_footer',
        'co_address',
        'co_email',
        'co_telp',
        'co_whatsapp',
        'co_website',
        'co_google_map',
        'co_linkyoutube',
        'created_by',
        'updated_by',
    ];

    // Relasi untuk user yang membuat detail perusahaan
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi untuk user yang terakhir mengupdate detail perusahaan
    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}

