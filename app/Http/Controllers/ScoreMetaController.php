<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreScoreMeta;
use App\Http\Requests\UpdateScoreMeta;

use App\Score;
use App\ScoreMeta;

class ScoreMetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScoreMeta $request)
    {
        $score_meta = ScoreMeta::create($request->all());

        if ($score_meta) {
            return response($score_meta, 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Score $score)
    {
        return $score->scoreMeta;
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
    public function update(UpdateScoreMeta $request, Score $score, ScoreMeta $scoreMeta)
    {
        //Can probably use middleware here to confirm score meta belongs to score
        $data = $request->all();
        if ($scoreMeta->update($data)) {
            return response($scoreMeta, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Score $score, ScoreMeta $scoreMeta)
    {
        //Use middleware to confirm score meta belongs to score
        if ($scoreMeta->delete()) {
            return response([
                'msg' => 'Meta deleted'
            ], 200);
        }
    }
}
