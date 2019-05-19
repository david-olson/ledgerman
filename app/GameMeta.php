<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameMeta extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'game_id', 'meta_type_id', 'contents',
    ];

    public function game()
    {
    	return $this->belongsTo(App\Game::class);
    }
}
