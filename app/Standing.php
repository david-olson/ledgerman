<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Standing extends Model
{
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
}
