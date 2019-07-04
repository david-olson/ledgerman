<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Game;
use App\User;
use App\Score;

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

    protected $with = ['game', 'user', 'scores'];

    public function game()
    {
    	return $this->belongsTo(Game::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function scores()
    {
    	return $this->hasMany(Score::class);
    }

    public function setWinnerMeta()
    {
        
    }
}
