<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Game;

class GameType extends Model
{
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'slug',
    ];

    public function games()
    {
    	return $this->hasMany(Game::class);
    }

    public function standings()
    {
        return $this->hasManyDeep(Standing::class, [Game::class, Result::class, Score::class]);
    }
}
