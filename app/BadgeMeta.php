<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BadgeMeta extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'badge_id', 'meta_type_id', 'contents',
    ];

    public function badge()
    {
    	return $this->belongsTo(App\Badge::class);
    }

    public function type()
    {
    	return $this->hasOne(App\MetaType::class);
    }
}
