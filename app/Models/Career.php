<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $table = 'career';
    protected $primaryKey = 'id';
    public $timestamps = false; // Set to false if you don't want to use timestamps

    protected $fillable = [
        'career_title',
        'career_description',
        'career_image',
        'career_last_apply',
        'career_date',
        'created_by',
        'updated_by',
    ];

    // Define the relationship with the User who created this career
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Define the relationship with the User who last updated this career
    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
