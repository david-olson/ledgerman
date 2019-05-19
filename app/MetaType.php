<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetaType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'public',
    ];

    public function gameMeta()
    {
    	return $this->hasMany(App\GameMeta::class);
    }

    public function badgeMeta()
    {
    	return $this->hasMany(App\BadgeMeta::class);
    }

    public function scoreMeta()
    {
    	return $this->hasMany(App\ScoreMeta::class);
    }

    public function userMeta()
    {
    	return $this->hasMany(App\UserMeta::class);
    }
}
