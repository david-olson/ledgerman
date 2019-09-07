<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Game;
use App\User;
use App\Score;
use App\Standing;

class Result extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'game_id', 'notes', 'played_at', 'user_id',
    ];

    protected $casts = [
    	'played_at' => 'datetime'
    ];

    protected $with = ['game', 'user', 'scores'];

    public function game()
    {
    	return $this->belongsTo(Game::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function scores()
    {
    	return $this->hasMany(Score::class);
    }

    public function setWinnerMeta()
    {
        if ($this->scores->count() > 0) {
            foreach ($this->scores as $score) {
                $winner_meta = $score->scoreMeta()->whereHas('metaType', function ($metaType) {
                    $metaType->where('name', 'game_winner');
                })->first();
                if ($winner_meta) {
                    $winner_meta->contents = 0;
                    $winner_meta->save();    
                }
                
            }

            $scoresByHighest = $this->scores()->orderBy('score', 'DESC')->get()->groupBy('score');

            foreach ($scoresByHighest->first() as $score) {
                $winner_meta = $score->scoreMeta()->whereHas('metaType', function($metaType){
                    $metaType->where('name', 'game_winner');
                })->first();
                
                $winner_meta->contents = 1;
                $winner_meta->save();
            }
            $this->setResultStandings();
        }
        
    }

    public function setResultStandings()
    {
        if ($this->scores->count() > 0) {
            foreach ($this->scores as $score) {
                if ($score->standing)
                    $score->standing->delete();
            }

            $player_count = $this->scores->count();

            $winners = $this->winner();

            $defeated_count = $player_count - $winners->count();

            $standing_value = ceil($defeated_count * 0.5);

            if ($standing_value == 0) {
                $standing_value = 1;
            }

            foreach ($winners as $winner) {
                $standing_temp = Standing::create([
                    'score' => $standing_value,
                    'score_id' => $winner->id
                ]);
            }

        }
    }

    public function winner()
    {
        $winner = $this->scores()->whereHas('scoreMeta', function($scoreMeta) {
            $scoreMeta->where('contents', 1);
            $scoreMeta->whereHas('metaType', function($metaType) {
                $metaType->where('name', 'game_winner');
            });
        })->get();
        return $winner;
    }
}
