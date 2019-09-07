<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreGameStat;
use App\Http\Requests\UpdateGameStat;

use App\GameStat;

class AdminGameStatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(GameStat::all(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGameStat $request)
    {
        $data = $request->all();

        $serialized = serialize($data['formula']);

        $data['formula'] = $serialized;

        if ($game_stat = GameStat::create($data)) {
            return response($game_stat, 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(GameStat $gameStat)
    {
        return response($gameStat, 200);
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
    public function update(Request $request, GameStat $gameStat)
    {
        $data = $request->all();

        if (array_key_exists('formula', $data)) {
            $serialized = serialize($data['formula']);
            $data['formula'] = $serialized;    
        }

        $gameStat->update($data);
        $gameStat->save();

        return response($gameStat, 200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(GameStat $gameStat)
    {
        if ($gameStat->delete()) {
            return response([
                'msg' => 'Game Stat deleted'
            ], 200);
        }
    }
}
