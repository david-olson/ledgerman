<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function friends()
    {
        //TODO Figure out how to add pivot info
        return $this->belongsToMany(App\User::class, 'user_id', 'id');
    }

    public function recievedRequests()
    {
        return $this->hasMany(App\UserRequest::class, 'reciever_id', 'id');
    }

    public function sentRequests()
    {
        return $this->hasMany(App\UserRequests::class, 'sender_id', 'id');
    }

    public function scores()
    {
        return $this->hasMany(App\Score::class);
    }

    public function results()
    {
        return $this->hasMany(App\Result::class);
    }

    public function badges()
    {
        return $this->belongsToMany(App\Badge::class);
    }

    public function userMeta()
    {
        return $this->hasMany(App\UserMeta::class);
    }
}
