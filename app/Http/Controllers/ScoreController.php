<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Score;

use App\Http\Requests\StoreScore;
use App\Http\Requests\UpdateScore;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Score::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScore $request)
    {
        $data = $request->all();

        if ($score = Score::create($data)) {
            $score->createMeta();
            $score->result->setWinnerMeta();
            return response($score, 201);
        }

        return response([
            'msg' => 'Could not create score.'
        ], 409);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Score $score)
    {
        return response($score, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateScore $request, Score $score)
    {
        $data = $request->all();

        if ($score->update($data)) {
            return response($score, 200);
        }

        return response([
            'msg' => 'Could not update score.'
        ], 409);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Score $score)
    {
        $score->delete();

        return response([
            'msg' => 'Score deleted'
        ], 200);
    }
}
