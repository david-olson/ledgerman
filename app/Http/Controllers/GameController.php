<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreGame;
use App\Http\Requests\UpdateGame;

use App\Game;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Game::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGame $request)
    {
        $data = $request->all();

        if ($game = Game::create($data)) {
            return response($game, 201);
        }

        return response([
            'msg' => 'Could not create game.'
        ], 409);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        return response($game, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGame $request, Game $game)
    {
        $data = $request->all();

        if ($game->update($data)) {
            return response($game, 200);
        }

        return response([
            'msg' => 'Could not update game'
        ], 409);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        $game->delete();

        return response([
            'msg' => 'Game deleted'
        ], 200);
    }

    public function stats(Game $game)
    {
        foreach ($game->gameStats as $stat) {
            $stat->computed = $stat->computeStat($game);
        }

        return response($game->gameStats, 200);
    }
}
