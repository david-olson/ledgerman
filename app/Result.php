<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'game_id', 'notes', 'played_at', 'user_id',
    ];

    protected $casts = [
    	'played_at' => 'datetime'
    ];

    public function game()
    {
    	return $this->hasOne(App\Game::class);
    }

    public function user()
    {
    	return $this->hasOne(App\User::class);
    }

    public function scores()
    {
    	return $this->hasMany(App\Score::class);
    }
}
