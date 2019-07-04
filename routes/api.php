<?php

use Illuminate\Http\Request;

use App\Http\Middleware\IsAdmin;

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
	Route::patch('/user', 'UserController@update');
	Route::post('/user/meta', 'UserMetaController@store');
	Route::get('/user/friends', 'FriendController@index');
	Route::get('/user/requests/recieved', 'UserRequestController@show');
	Route::get('/user/requests/sent', 'UserRequestController@index');
	Route::post('/user/{user}/requests', 'UserRequestController@store');
	Route::patch('/user/requests/{userRequest}', 'UserRequestController@update');
	Route::delete('/user/requests/{userRequest}', 'UserRequestController@destroy');
	Route::get('/user/{user}/friends', 'FriendController@show');
	Route::get('/user/{user}', 'UserController@show');
	Route::get('/user/{user}/meta', 'UserMetaController@index');

	Route::get('/user/{user}/stats', 'UserController@stats');
	Route::get('/user/{user}/badges', 'UserController@badges');
	Route::post('/user/{user}/badges', 'UserBadgeController@store');

	
	Route::middleware(IsAdmin::class)->group(function() {
		/**
		 * Admin User Control
		 */
		Route::post('/user', 'AdminUserController@store');
		Route::patch('/user/{user}', 'AdminUserController@update');
		Route::get('/user/{user}/requests/sent', 'AdminUserRequestController@sent');
		Route::get('/user/{user}/requests/recieved', 'AdminUserRequestController@recieved');
		Route::patch('/user/{user}/meta/{userMeta}', 'UserMetaController@update');

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
		Route::post('/games', 'GameController@store');
		Route::patch('/games/{game}', 'GameController@update');
		Route::delete('/games/{game}', 'GameController@destroy');

		/**
		 * Game Categories
		 */
		Route::post('/categories', 'GameCategoryController@store');
		Route::patch('/categories/{gameCategory}', 'GameCategoryController@update');
		Route::delete('/categories/{gameCategory}', 'GameCategoryController@destroy');

		/**
		 * Game Types
		 */
		Route::post('/types', 'GameTypeController@store');
		Route::patch('/types/{gameType}', 'GameTypeController@update');
		Route::delete('/types/{gameType}', 'GameTypeController@destroy');
	});

	/**
	 * Games
	 */
	Route::get('/games', 'GameController@index');
	Route::get('/games/{game}', 'GameController@show');
	Route::get('/games/{game}/stats', 'GameController@stats');

	/**
	 * Game Categories
	 */
	Route::get('/categories', 'GameCategoryController@index');
	Route::get('/categories/{gameCategory}', 'GameCategoryController@show');
	Route::get('/categories/{gameCategory}/games', 'GameCategoryFilterController@index');

	/**
	 * Game Types
	 */
	Route::get('/types', 'GameTypeController@index');
	Route::get('/types/{gameType}', 'GameTypeController@show');
	Route::get('/types/{gameType}/games', 'GameTypeFilterController@index');	

	/**
	 * Results
	 */
	Route::get('/results', 'ResultController@index');
	Route::post('/results', 'ResultController@store');
	Route::get('/results/{result}', 'ResultController@show');
	Route::patch('/results/{result}', 'ResultController@update');
	Route::delete('/results/{result}', 'ResultController@destroy');
	Route::get('/results/{result}/scores', 'ResultController@scores');

	/**
	 * Scores
	 */
	Route::get('/scores', 'ScoreController@index');
	Route::post('/scores', 'ScoreController@store');
	Route::get('/scores/{score}', 'ScoreController@show');
	Route::patch('/scores/{score}', 'ScoreController@update');
	Route::delete('/scores/{score}', 'ScoreController@destroy');
	Route::get('/scores/{score}/meta', 'ScoreMetaController@show');
	Route::post('/scores/{score}/meta', 'ScoreMetaController@store');
	Route::patch('/scores/{score}/meta/{metaId}', 'ScoreMetaController@update');
	Route::delete('/scores/{score}/meta/{metaId}', 'ScoreMetaController@destroy');

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