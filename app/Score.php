<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'result_id', 'user_id', 'score', 'notes',
    ];

    public function result()
    {
    	return $this->belongsTo(App\Result::class);
    }

    public function user()
    {
    	return $this->belongsTo(App\User::class);
    }

    public function scoreMeta()
    {
    	return $this->hasMany(App\ScoreMeta::class);
    }
}
