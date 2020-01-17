<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
    public function index(Request $request){
    	$search_term = $request->input('q');
        $form = collect($request->input('form'))->pluck('value', 'name');

        $options = User::query();

        // if no user has been selected, show no options
        if (! $form['user']) {
            return [];
        }

        // if a user has been selected, only show articles in that user
        if ($form['user']) {
            $options = $options->where('id', $form['user'])->department;
        }

        if ($search_term) {
            $results = $options->paginate(10);
        } else {
            $results = $options->paginate(10);
        }

        return $options->paginate(10);
    }

    public function show($id){
    	return User::find($id)->department;
    }

}
