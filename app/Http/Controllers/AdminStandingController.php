<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Standing;

use Auth;

class AdminStandingController extends Controller
{
	/**
	 * Returns all stanings
	 * @return \Illuminate\Http\Response
	 */
    public function index()
    {
    	$standings = Standing::all();

    	return response($standings, 200);
    }

    /**
     * Updates a standing with admin actions
     * @param $request Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Standing $standing)
    {
    	if ($request->get('approve')) {
    		$action = $request->get('approve');
    		if ($action == 'approve') {
				$standing->approve();
    		} elseif ($action == 'reject') {
				$standing->reject();
    		}
    		return response([
    			'msg' => 'Standing updated',
    			'staning' => $standing
    		], 200);
    	}

    	return response([
    		'msg' => 'Required flags were not included with this request.'
    	], 400);
    }
}
