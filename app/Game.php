<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\GameCategory;
use App\GameType;
use App\Result;
use App\GameMeta;
use App\GameStat;
use App\Game;

class Game extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'game_category_id', 'game_type_id', 'description',
    ];

    protected $with = ['gameCategory', 'gameType', 'gameMeta'];

    public function gameCategory()
    {
    	return $this->belongsTo(GameCategory::class);
    }

    public function gameType()
    {
    	return $this->belongsTo(GameType::class);
    }

    public function results()
    {
    	return $this->hasMany(Result::class);
    }

    public function scores()
    {
        return $this->hasManyThrough(Game::class, Result::class);
    }

    public function gameMeta()
    {
    	return $this->hasMany(GameMeta::class);
    }

    public function gameStats()
    {
        return $this->belongsToMany(GameStat::class);
    }
}
