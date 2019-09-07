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
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id');
    }

    public function recievedRequests()
    {
        return $this->hasMany(UserRequest::class, 'reciever_id', 'id')->with(['sender', 'reciever']);
    }

    public function sentRequests()
    {
        return $this->hasMany(UserRequest::class, 'sender_id', 'id')->with(['sender', 'reciever']);
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class);
    }

    public function userMeta()
    {
        return $this->hasMany(UserMeta::class)->with('metaType');
    }

    public function standings()
    {
        return $this->hasManyThrough(Standing::class, Score::class);
    }
}
