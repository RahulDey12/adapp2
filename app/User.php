<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles() {

        return $this->belongsToMany('App\Role');

    }

    public function profile() {
        return $this->hasMany('App\Profile');
    }

    public function ads() {
        return $this->hasMany('App\Ads');
    }

    public function AdsDetails() {
        return $this->hasMany('App\AdsDetails');
    }

    /*
    *
    *Check For multiple roles
    *
    */

    public function hasAnyRole($roles) {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    /*
    *
    *Check For single roles
    *
    */

    public function hasRole($role) {
        return null !== $this->roles()->where('name', $role)->first();
    }
}
