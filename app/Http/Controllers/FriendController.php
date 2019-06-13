<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Auth;

class FriendController extends Controller
{
    public function index()
    {
    	return response(Auth::user()->friends, 200);
    }

    public function show(User $user)
    {
    	return response($user->friends, 200);
    }
}
