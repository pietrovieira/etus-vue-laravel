<?php

namespace App;

use Hash;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements JWTSubject
{
use Notifiable;
// use SoftDeletes;

/**
 * The attributes that are mass assignable.
 *
 * @var array
 */
protected $fillable = [
    'name', 'email','password'
];

/**
 * The attributes that should be hidden for arrays.
 *
 * @var array
 */
protected $hidden = [
    'password', 'remember_token',
    'updated_at',
    'created_at',
    'email_verified_at'
];

/**
 * The attributes that should be cast to native types.
 *
 * @var array
 */
protected $casts = [
    'email_verified_at' => 'datetime',
];

public function getJWTIdentifier()
{
    return $this->getKey();
}

public function getJWTCustomClaims()
{
    return [];
}
public function setPasswordAttribute($password)
{
    if ( !empty($password) ) {
        $this->attributes['password'] = Hash::make($password);
    }
}

public function roles()
{
    return $this->belongsToMany('App\Role');
} 
}