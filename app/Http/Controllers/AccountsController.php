<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccountsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (auth()->user()->role > 'agent') {
            return redirect('/home')->with('error', 'Unauthorized Page');
        }

        $users = user::all();
        return view('adminpanel.accounts.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return redirect('/home')->with('error', 'Unauthorized Page');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        return redirect('/home')->with('error', 'Unauthorized Page');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return redirect('/home')->with('error', 'Unauthorized Page');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        if (auth()->user()->role !== 'admin') {
            return redirect('/home')->with('error', 'Unauthorized Page');
        }

        return view('adminpanel.accounts.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'role' => 'required'
        ]);

        if (auth()->user()->role !== 'admin') {
            return redirect('/home')->with('error', 'Unauthorized Page');
        }
        //Create user and update the new values, then save to the DB.
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->save();

        //redirect to accounts-management
        return redirect('/adminpanel/accounts')->with('success', 'User edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (auth()->user()->role != 'admin') {
            return redirect('/home')->with('error', 'Unauthorized Page');
        } else {
            $user->delete();
            return redirect('/adminpanel/accounts')->with('success', 'User deleted');
        }
    }
}
