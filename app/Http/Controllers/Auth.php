<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Auth extends Controller
{
    //
    function Login(Request $req){
    	$username = $req->input('username');
    	$password = $req->input('password');

		$query = DB::table('users')->select('id')->where('username', $username)->get();
    	// $id = DB::select('id')->where('username', $username)->first();
    	if(!$query->isEmpty()){
	    	return "welcome"; 
    	}
    	else{
    		return redirect()->back()->with('error', 'Fel lösenord och <br>eller användarnamn!');
    	}
    	// print_r($query[0]->id);
 	  	// return $req->input();
        

        
    }
}
