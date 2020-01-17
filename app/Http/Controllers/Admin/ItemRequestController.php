<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;

class ItemRequestController extends Controller
{
    //
    public function index(){

    	$users = User::all();

    	return view('item_request.create', compact('users'));

    }

    public function dept(Request $request){

    	if ($request->ajax()) {
    		return response()->json([
    			'user' => User::find($request->id)
    		]);
    	}


    }

}
