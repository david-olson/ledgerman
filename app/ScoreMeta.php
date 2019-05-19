<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScoreMeta extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'score_id', 'meta_type_id', 'contents',
    ];

    public function score()
    {
    	return $this->belongsTo(App\Score::class);
    }

    public function metaType()
    {
    	return $this->hasOne(App\MetaType::class);
    }
}
