<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sender_id', 'reciever_id', 'expires_at', 'accepted_at', 'rejected_at',
    ];

    protected $casts = [
    	'expires_at' => 'datetime',
    	'accepted_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    public function sender()
    {
    	return $this->hasOne(User::class, 'id', 'sender_id');
    }

    public function reciever()
    {
    	return $this->hasOne(User::class, 'id', 'reciever_id');
    }

}
