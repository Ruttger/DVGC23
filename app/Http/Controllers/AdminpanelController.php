<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminpanelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){

        if (auth()->user()->role > 'agent') {
            return redirect('/home')->with('error', 'Unauthorized Page');
        }
        return view('adminpanel.index');
    }
}
