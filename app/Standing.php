<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Standing extends Model
{


	use \Znck\Eloquent\Traits\BelongsToThrough;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
	    'score', 'score_id',
	];


	public function score()
	{
		return $this->belongsTo(Score::class);
	}

    public function user()
    {
    	return $this->belongsToThrough(User::class, Score::class);
    }

    public function game()
    {
    	return $this->belongsToThrough(Game::class, [Result::class, Score::class]);
    }

    public function category()
    {
    	return $this->belongsToThrough(GameCategory::class, [Game::class, Result::class, Score::class]);
    }

    public function type()
    {
    	return $this->belongsToThrough(GameType::class, [Game::class, Result::class, Score::class]);
    }
}
