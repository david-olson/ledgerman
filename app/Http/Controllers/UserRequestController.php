<?php

namespace App\Http\Controllers;

use App\UserRequest;
use App\User;

use Illuminate\Http\Request;
// use App\Http\Requests\ProcessUserRequest;

use Carbon\Carbon;
use Auth;

class UserRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Auth::user()->sentRequests, 200);
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
    public function store(Request $request, User $user)
    {
        $data = $request->all();
        $data['reciever_id'] = $user->id;

        $data['expires_at'] = Carbon::now()->addDays(60);

        $data['sender_id'] = Auth::user()->id;

        if (Auth::user()->friends()->where('id', $user->id)->first()) {
            return response([
                'msg' => 'This user is already your friend.'
            ], 409);
        }

        if ($data['reciever_id'] == $data['sender_id']) {
            return response([
                'msg' => 'You cannot send requests to yourself.'
            ], 409);
        }

        if ($check = UserRequest::where('sender_id', $data['sender_id'])->where('reciever_id', $data['reciever_id'])->first() || UserRequest::where('reciever_id', $data['sender_id'])->where('sender_id', $data['reciever_id'])->first()) {
            return response([
                'msg' => 'There is already an existing request between these two users.'
            ], 409);
        }

        if ($userRequest = UserRequest::create($data)) {
            return response($userRequest, 200);
        }

        return response([
            'msg' => 'Could not create the friend request.'
        ], 409);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserRequest  $userRequest
     * @return \Illuminate\Http\Response
     */
    public function show(UserRequest $userRequest)
    {
        return response(Auth::user()->recievedRequests, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserRequest  $userRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(UserRequest $userRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserRequest  $userRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserRequest $userRequest)
    {
        $data = $request->all();

        $action = $data['action'];

        if ($action == 'accept') {
            $userRequest->accepted_at = Carbon::now();
            $userRequest->save();
            
            Auth::user()->friends()->attach($userRequest->sender);
            $userRequest->sender->friends()->attach(Auth::user());

        } elseif ($action == 'reject') {
            $userRequest->rejected_at = Carbon::now();
            $userRequest->save();
        }

        return response($userRequest, 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserRequest  $userRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRequest $userRequest)
    {
        $userRequest->delete();

        return response([
            'msg' => 'Request deleted.'
        ], 200);
    }
}
