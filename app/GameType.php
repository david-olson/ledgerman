<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Game;

class GameType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'slug',
    ];

    public function games()
    {
    	return $this->hasMany(Game::class);
    }
}
