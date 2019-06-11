<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'UserController@login');
Route::post('/register', 'UserController@register');

Route::middleware('auth:api')->group(function() {
	/**
	 * Users
	 */
	Route::post('/user/meta', 'UserMetaController@store');
	Route::get('/user/{user}', 'UserController@show');
	Route::get('/user/{user}/meta', 'UserMetaController@index');
	Route::patch('/user/{user}/meta/{metaId}', 'UserMetaController@update');
	Route::get('/user/{user}/friends', 'FriendController@show');
	Route::get('/user/{user}/requests', 'UserRequestController@show');
	Route::post('/user/{user}/requests', 'UserRequestController@store');
	Route::patch('/user/{user}/requests/{requestId}', 'UserRequestController@update');
	Route::delete('/user/{user}/requests/{requestId}', 'UserRequestController@destroy');
	Route::get('/user/{user}/stats', 'UserController@stats');
	Route::get('/user/{user}/badges', 'UserController@badges');
	Route::post('/user/{user}/badges', 'UserBadgeController@store');

	/**
	 * Meta Types
	 */
	Route::get('/meta', 'MetaTypeController@index');
	Route::get('/meta/{metaType}', 'MetaTypeController@show');
	Route::post('/meta', 'MetaTypeController@store');
	Route::patch('/meta/{metaType}', 'MetaTypeController@update');
	Route::delete('/meta/{metaType}', 'MetaTypeController@destroy');

	/**
	 * Games
	 */
	Route::get('/games', 'GameController@index');
	Route::post('/games', 'GameController@store');
	Route::get('/games/{id}', 'GameController@show');
	Route::patch('/games/{id}', 'GameController@update');
	Route::delete('/games/{id}', 'GameController@destroy');
	Route::get('/games/{id}/stats', 'GameController@stats');

	/**
	 * Game Categories
	 */
	Route::get('/categories', 'GameCategoryController@index');
	Route::post('/categories', 'GameCategoryController@store');
	Route::get('/categories/{id}', 'GameCategoryController@show');
	Route::patch('/categories/{id}', 'GameCategoryController@update');
	Route::delete('/categories/{id}', 'GameCategoryController@destroy');
	Route::get('/categories/{id}/games', 'GameCategoryFilterController@index');

	/**
	 * Game Types
	 */
	Route::get('/types', 'GameTypeController@index');
	Route::post('/types', 'GameTypeController@store');
	Route::get('/types/{id}', 'GameTypeController@show');
	Route::patch('/types/{id}', 'GameTypeController@update');
	Route::delete('/types/{id}', 'GameTypeController@destroy');
	Route::get('/types/{id}/games', 'GameTypeFilterController@index');	

	/**
	 * Results
	 */
	Route::get('/results', 'ResultController@index');
	Route::post('/results', 'ResultController@store');
	Route::get('/results/{id}', 'ResultController@show');
	Route::patch('/results/{id}', 'ResultController@update');
	Route::delete('/results/{id}', 'ResultController@destroy');
	Route::get('/results/{id}/scores', 'ResultController@scores');

	/**
	 * Scores
	 */
	Route::get('/scores', 'ScoreController@index');
	Route::post('/scores', 'ScoreController@store');
	Route::get('/scores/{id}', 'ScoreController@show');
	Route::patch('/scores/{id}', 'ScoreController@update');
	Route::delete('/scores/{id}', 'ScoreController@destroy');
	Route::get('/scores/{id}/meta', 'ScoreMetaController@show');
	Route::post('/scores/{id}/meta', 'ScoreMetaController@store');
	Route::patch('/scores/{id}/meta/{metaId}', 'ScoreMetaController@update');
	Route::delete('/scores/{id}/meta/{metaId}', 'ScoreMetaController@destroy');

	/**
	 * Stats
	 */
	Route::get('/stats/games', 'GameStatController@index');
	Route::get('/stats/games/{id}', 'GameStatController@show');
	Route::get('/stats/users', 'UserStatController@index');
	Route::get('/stats/users/{id}', 'UserStatController@show');

	/**
	 * Badges
	 */
	Route::get('/badges', 'BadgeController@index');
	Route::post('/badges', 'BadgeController@store');
	Route::get('/badges/{id}', 'BadgeController@show');
	Route::patch('/badges/{id}', 'BadgeController@update');
	Route::delete('/badges/{id}', 'BadgeController@destroy');
	Route::get('/badges/{id}/user', 'UserBadgeController@show');

	/**
	 * User Stats
	 */
	Route::get('/user-stats', 'AdminUserStatController@index');
	Route::post('/user-stats', 'AdminUserStatController@store');
	Route::get('/user-stats/{id}', 'AdminUserStatController@show');
	Route::patch('/user-stats/{id}', 'AdminUserStatController@update');
	Route::delete('/user-stats/{id}', 'AdminUserStatController@destroy');

	/**
	 * Game Stats
	 */
	Route::get('/game-stats', 'AdminGameStatController@index');
	Route::post('/game-stats', 'AdminGameStatController@store');
	Route::get('/game-stats/{id}', 'AdminGameStatController@show');
	Route::patch('/game-stats/{id}', 'AdminGameStatController@update');
	Route::delete('/game-stats/{id}', 'AdminGameStatController@destroy');	

});