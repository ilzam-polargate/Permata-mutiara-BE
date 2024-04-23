<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'role',
        'created_date',
        'created_by',
        'updated_date',
        'updated_by',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function username()
    {
        return 'username';
    }

    public function sales()
    {
        return $this->hasOne(Sales::class, 'user_id');
    }

    public function leadsCreated()
    {
        return $this->hasMany(Lead::class, 'created_by');
    }

    public function leadsUpdated()
    {
        return $this->hasMany(Lead::class, 'updated_by');
    }

    public function pageSetupsCreated()
    {
        return $this->hasMany(setting::class, 'created_by');
    }

    public function pageSetupsUpdated()
    {
        return $this->hasMany(setting::class, 'updated_by');
    }

    public function facilitiesCreated()
    {
        return $this->hasMany(Facilities::class, 'created_by');
    }
    public function facilitiesUpdated()
    {
        return $this->hasMany(Facilities::class, 'updated_by');
    }

    public function unitTypesCreated()
    {
        return $this->hasMany(UnitType::class, 'created_by');
    }

    public function unitTypesUpdated()
    {
        return $this->hasMany(UnitType::class, 'updated_by');
    }

    public function developmentsCreated()
    {
        return $this->hasMany(Development::class, 'created_by');
    }

    public function developmentsUpdated()
    {
        return $this->hasMany(Development::class, 'updated_by');
    }

    public function aboutCompanyCreated()
    {
        return $this->hasMany(AboutCompany::class, 'created_by');
    }

    public function aboutCompanyUpdated()
    {
        return $this->hasMany(AboutCompany::class, 'updated_by');
    }

    public function detailCompanyCreated()
    {
        return $this->hasMany(DetailCompany::class, 'created_by');
    }

    public function detailCompanyUpdated()
    {
        return $this->hasMany(DetailCompany::class, 'updated_by');
    }

    public function imageBannersCreated()
    {
        return $this->hasMany(ImageBanner::class, 'created_by');
    }

    public function imageBannersUpdated()
    {
        return $this->hasMany(ImageBanner::class, 'updated_by');
    }
}
