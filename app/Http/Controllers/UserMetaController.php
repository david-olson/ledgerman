<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserMeta;

use App\User;
use App\UserMeta;
use App\MetaType;

class UserMetaController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return response($user->userMeta, 200);
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
     * @param  \App\Http\Requests\StoreUserMeta  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserMeta $request)
    {
        $data = $request->all();
        if ($userMeta = UserMeta::create($data)) {
            return response($userMeta, 200);
        }
        return response([
            'msg' => 'There was an error creating the meta'
        ], 409);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @param  App\User $user
     * @param  App\UserMeta $userMeta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, UserMeta $userMeta)
    {
        if ($meta = $user->userMeta()->find($userMeta->id)) {
            $data = $request->all();
            $userMeta->contents = $data['contents'];
            if ($userMeta->save()) {
                return response($userMeta, 200);
            }
        }
        return response([
            'msg' => 'This meta does not belong to this user.'
        ], 401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
