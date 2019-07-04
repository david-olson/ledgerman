<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreGameType;

use App\GameType;

class GameTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(GameType::all(), 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGameType $request)
    {
        $data = $request->all();

        $data['slug'] = str_slug($data['name']);

        $request->merge(['slug' => $data['slug']]);

        $this->validate($request, [
            'slug' => 'unique:game_types'
        ]);

        if ($gameType = GameType::create($data)) {
            return response($gameType, 201);
        }

        return response([
            'msg' => 'Could not create game type.'
        ], 409);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(GameType $gameType)
    {
        return response($gameType, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GameType $gameType)
    {
        $data = $request->all();

        if (isset($data['name'])) {
            $data['slug'] = str_slug($data['name']);

            $request->merge(['slug' => $data['slug']]);

            $this->validate($request, [
                'slug' => 'required|unique:game_types'
            ]);
        }


        if ($gameType->update($data)) {
            return response($gameType, 200);
        }

        return response([
            'msg' => 'Could not update the game type'
        ], 409);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(GameType $gameType)
    {
        $gameType->delete();

        return response([
            'msg' => 'Game type deleted'
        ], 200);
    }
}
