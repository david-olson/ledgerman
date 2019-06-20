<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

use App\User;
use Illuminate\Support\Facades\Auth; 
use Validator;


class UserController extends Controller
{

	public $successStatus = 200;

	/** 
	* login api 
	* 
	* @return \Illuminate\Http\Response 
	*/ 
    public function login()
    {
    	if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
    		$user = Auth::user();
    		$success['token'] = $user->createToken('Ledgerman');
    		return response()->json(['success' => $success], $this->successStatus);
    	} else {
    		return response()->json(['error' => 'Wrong username or password'], 401);
    	}
    }

    /** 
	 * Register api 
	 * 
	 * @return \Illuminate\Http\Response 
	 */ 
	public function register(Request $request) 
	{ 
	    $validator = Validator::make($request->all(), [ 
	        'first_name' => 'required', 
	        'last_name' => 'required',
	        'email' => 'required|email',
	        'username' => 'required',
	        'password' => 'required', 
	        'c_password' => 'required|same:password', 
	    ]);
		if ($validator->fails()) { 
	        return response()->json(['error'=>$validator->errors()], 401);            
	    }
		$input = $request->all(); 
	    $input['password'] = bcrypt($input['password']); 
	    $user = User::create($input); 
	    $success['token'] =  $user->createToken('MyApp')-> accessToken; 
	    $success['name'] =  $user->name;
		return response()->json(['success'=>$success], $this-> successStatus); 
	}

	/**
	 * Returns the requested user resource
	 * 
	 * @param   $user \App\User
	 * @return  \Illuminate\Http\Response
	 */
	public function show(User $user)
	{
		return $user;
	}

	public function update(UpdateUserRequest $request)
	{
		$user = Auth::user();

		$data = $request->all();

		if (array_key_exists('password', $data)) {
			$data['password'] = bcrypt($data['password']);
		}

		if ($user->update($data)) {
			return response([
				'msg' => 'You have updated your info successfully.',
				'user' => $user
			], 200);
		}

		return response([
			'msg' => 'There was an error updating your user'
		], 409);
	}
	
}
