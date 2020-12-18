<?php

namespace App\Http\Controllers;

use App\TimeFrame;
use Illuminate\Http\Request;

class TimeFramesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role > 'agent') {
            return redirect('/home')->with('error', 'Unauthorized Page');
        }

        $timeFrames = TimeFrame::all();
        return view('adminpanel.timeframes.index')->with('timeFrames', $timeFrames);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('/home')->with('error', 'Unauthorized Page');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->role > 'agent') {
            return redirect('/home')->with('error', 'Unauthorized Page');
        }

        $this->validate($request, [
            'starts_at_date' => 'required',
            'starts_at_time' => 'required',
            'expires_at_date' => 'required',
            'expires_at_time' => 'required'

        ]);

        //Create Post
        $timeFrame = new TimeFrame();
        $timeFrame->starts_at = $request->input('starts_at_date') . ' ' . $request->input('starts_at_time');;
        $timeFrame->expires_at = $request->input('expires_at_date') . ' ' . $request->input('expires_at_time');
        $timeFrame->save();
        return redirect('/adminpanel/timeframes');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('/home')->with('error', 'Unauthorized Page');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect('/home')->with('error', 'Unauthorized Page');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return redirect('/home')->with('error', 'Unauthorized Page');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $timeFrame = TimeFrame::find($id);

        if (auth()->user()->role > 'agent'){
            return redirect('/home')->with('error', 'Unauthorized Page');
        }
        else{
            $timeFrame->delete();
            return redirect('/adminpanel/timeframes')->with('success', 'TimeFrame removed');
        }
    }
}
