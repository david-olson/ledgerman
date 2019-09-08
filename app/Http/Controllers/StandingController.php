<?php

namespace App\Http\Controllers;

use App\Standing;
use Illuminate\Http\Request;

use App\Game;
use App\GameCategory;
use App\GameType;

class StandingController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Standing  $standing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Standing $standing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Standing  $standing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Standing $standing)
    {
        //
    }

    public function games(Game $game)
    {
        return response($game->standings, 200);
    }

    public function gameCategories(GameCategory $gameCategory)
    {
        return response($gameCategory->standings, 200);
    }

    public function gameTypes(GameType $gameType)
    {
        return response($gameType->standings, 200);
    }
}
