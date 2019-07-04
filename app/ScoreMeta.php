<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\MetaType;
use App\Score;

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

    protected $with = ['metaType'];

    public function score()
    {
    	return $this->belongsTo(Score::class);
    }

    public function metaType()
    {
    	return $this->belongsTo(MetaType::class);
    }
}
