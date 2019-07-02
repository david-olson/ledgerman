<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreGameCategory;

use App\GameCategory;

class GameCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(GameCategory::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGameCategory $request)
    {
        $data = $request->all();

        $data['slug'] = str_slug($data['name']);

        $request->merge(['slug' => $data['slug']]);

        $this->validate($request, [
            'slug' => 'unique:game_categories'
        ]);

        if ($gameCategory = GameCategory::create($data)) {
            return response($gameCategory, 200);
        }

        return response([
            'msg' => 'Could not create the game category.'
        ], 409);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(GameCategory $gameCategory)
    {
        return response($gameCategory, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GameCategory $gameCategory)
    {
        $data = $request->all();

        $data['slug'] = str_slug($data['name']);

        $request->merge(['slug' => $data['slug']]);

        $this->validate($request, [
            'slug' => 'required|unique:game_categories'
        ]);


        if ($gameCategory->update($data)) {
            return response($gameCategory, 200);
        }

        return response([
            'msg' => 'Could not update the game category'
        ], 409);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(GameCategory $gameCategory)
    {
        $gameCategory->delete();

        return response([
            'msg' => 'Game category deleted.'
        ], 200);
    }
}
