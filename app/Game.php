<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function gameCategory()
    {
    	return $this->belongsTo(App\GameCategory::class);
    }

    public function gameType()
    {
    	return $this->belongsTo(App\GameType::class);
    }

    public function results()
    {
    	return $this->hasMany(App\Result::class);
    }

    public function gameMeta()
    {
    	return $this->hasMany(App\GameMeta::class);
    }
}
