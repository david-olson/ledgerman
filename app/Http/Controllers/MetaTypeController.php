<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreMetaType;
use App\Http\Requests\UpdateMetaType;

use App\MetaType;

class MetaTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(MetaType::all(), 200);
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
    public function store(StoreMetaType $request)
    {
        $data = $request->all();

        // dd($data);
        if ($metaType = MetaType::create($data)) {
            return response($metaType, 200);
        }
        return response([
            'msg' => 'There was an error.'
        ], 409);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MetaType
     * @return \Illuminate\Http\Response
     */
    public function show(MetaType $metaType)
    {
        return response($metaType, 200);
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
    public function update(UpdateMetaType $request, MetaType $metaType)
    {
        $data = $request->all();
        if ($metaType->update($data)) {
            return response([
                'msg' => 'Meta Type updated successfully',
                'metaType' => $metaType
            ], 200);
        }

        return response([
            'msg' => 'There was an error.'
        ], 409);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MetaType $metaType)
    {
        $metaType->delete();

        return response([
            'msg' => 'Meta Type deleted.'
        ], 200);
    }
}
