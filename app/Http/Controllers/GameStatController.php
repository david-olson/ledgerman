<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game;
use App\GameStat;

class GameStatController extends Controller
{
    public function index()
    {
    	return response(GameStat::with('games')->get(), 200);
    }

    public function show(GameStat $gameStat)
    {
    	return response($gameStat->games, 200);
    }
}
