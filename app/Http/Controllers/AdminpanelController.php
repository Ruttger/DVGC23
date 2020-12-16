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
        $users = user::all();
        return view('adminpanel.index')->with('users', $users);

    }

    public function update($id){
        $user = User::find($id);

        $user->role == 'agent';
        $user->save();

        return redirect('/adminpanel')->with('success', 'User role updated');
    }

    public function destroy($id){
        $user = User::find($id);

        if (auth()->user()->role == 'admin'){
            $user->delete();
            return redirect('/adminpanel')->with('success', 'Admin command');

        }else{
            return redirect('/adminpanel')->with('error', 'Unauthorized Page');

        }
    }
}
