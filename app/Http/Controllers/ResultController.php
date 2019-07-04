<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreResult;
use App\Http\Requests\UpdateResult;

use App\Result;

use Auth;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Result::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResult $request)
    {
        $data = $request->all();

        $data['user_id'] = Auth::user()->id;

        if ($result = Result::create($data)) {
            return response($result, 201);
        }

        return response([
            'msg' => 'Could not create result.'
        ], 409);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Result $result)
    {
        return response($result, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResult $request, Result $result)
    {
        $data = $request->all();

        if ($result->update($data)) {
            return response($result, 200);
        }

        return response([
            'msg' => 'Could not update the result'
        ], 409);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        $result->delete();

        return response([
            'msg' => 'Result deleted'
        ], 200);
    }

    public function scores(Result $result)
    {
        return response($result->scores, 200);
    }
}
