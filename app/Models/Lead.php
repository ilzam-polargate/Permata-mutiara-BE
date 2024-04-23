<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mobile',
        'email',
        'message',
        'leads_status',
        'leads_note',
        'leads_total_move',
        'path_referral',
        'created_date',
        'created_by',
        'updated_date',
        'updated_by',
    ];

    protected $dates = [
        'created_date',
        'updated_date',
    ];

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
