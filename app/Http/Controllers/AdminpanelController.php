<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

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
     * @return Renderable
     */
    public function index()
    {

        if (auth()->user()->role > 'agent') {
            return redirect('/home')->with('error', 'Unauthorized Page');
        }
        return view('adminpanel.index');
    }

}
