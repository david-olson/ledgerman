<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\UserRequest;

class AdminUserRequestController extends Controller
{
    public function sent(User $user)
    {
    	return response($user->sentRequests, 200);
    }

    public function recieved(User $user)
    {
    	return response($user->recievedRequests, 200);
    }
}
