<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function beeritems()
    {
        return $this->hasMany('App\Beeritem');
    }

    public function breweries()
    {
        return $this->hasMany('App\Brewery');
    }

    public function categories()
    {
        return $this->hasMany('App\Category');
    }

    public function tags()
    {
        return $this->hasMany('App\Tag');
    }

    public function collections()
    {
        return $this->hasMany('App\Collection');
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
