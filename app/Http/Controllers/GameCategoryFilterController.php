<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game;
use App\GameCategory;

class GameCategoryFilterController extends Controller
{
    public function index(GameCategory $gameCategory)
    {
    	return response($gameCategory->games, 200);
    }
}
