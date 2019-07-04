<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\GameType;

class GameTypeFilterController extends Controller
{
    public function index(GameType $gameType)
    {
    	return response($gameType->games, 200);
    }
}
