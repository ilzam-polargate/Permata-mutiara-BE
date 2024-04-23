<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Sales extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $guard = 'sales';

    protected $fillable = [
        'user_id',
        'sales_name',
        'sales_mobile',
        'sales_email',
        'sales_password',
        'sales_sort',
        'created_date',
        'created_by',
        'updated_date',
        'updated_by',
        'remember_token',
    ];

    protected $hidden = [
        'sales_password',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getAuthPassword()
    {
        return $this->sales_password;
    }
}
