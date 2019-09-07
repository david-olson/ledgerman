<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Game;

class GameStat extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name', 'formula', 'before_text', 'after_text', 'decimal_places',
    ];

    public function games()
    {
    	return $this->belongsToMany(Game::class);
    }

    public function computeStat(Game $game)
    {
    	$formula = unserialize($this->formula);

    	// dd($formula);

    	$model = $formula['model'];

    	$class = 'App\\' . $model;

    	$query = new $class;

    	dd($query->{$formula['retreve']}());
    	
    }

}
