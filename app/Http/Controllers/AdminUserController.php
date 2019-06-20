<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

use App\User;

class AdminUserController extends Controller
{
    /**
     * Creates a new resource
     * 
     * @param   \App\Http\Requests\AdminCreateUserRequest
     * @return   \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
    	$data = $request->all();

    	$data['password'] = bcrypt($data['password']);

    	if ($user = User::create($data)) {
    		return response()->json(['msg' => 'User created successfully', 'user' => $user], 201);	
    	} 
    	return response([
    		'msg' => 'There was an error creating the user'
    	], 409);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
    	$data = $request->all();

    	if (array_key_exists('password', $data)) {
    		$data['password'] = bcrypt($data['password']);
    	}

    	if ($user->update($data)) {
    		return response([
    			'msg' => 'User updated successfully',
    			'user' => $user
    		], 200);
    	}

    	return response([
    		'msg' => 'Could not update user.'
    	], 409);
    }
}
