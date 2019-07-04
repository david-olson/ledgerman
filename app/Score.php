<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Result;
use App\User;
use App\ScoreMeta;

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

    protected $with = ['user', 'scoreMeta'];

    public function result()
    {
    	return $this->belongsTo(Result::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function scoreMeta()
    {
    	return $this->hasMany(ScoreMeta::class);
    }

    public function createMeta()
    {
        $types_to_create = [2];

        foreach ($types_to_create as $type) {
            ScoreMeta::create([
                'score_id' => $this->id,
                'meta_type_id' => $type,
                'contents' => 0
            ]);
        }
    }
}
