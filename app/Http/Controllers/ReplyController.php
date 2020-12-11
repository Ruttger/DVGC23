<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Skapa ny tråd
        $reply = new Reply;
        $reply->body = $request->body;
        $reply->thread_id = $request->threadID;
        $reply->user_id = 6;
        $reply->save();

        // uppdatera updated_at
        $thread = Thread::find($request->threadID);
        $thread->touch();
        $thread->save();

        // Hämta användaren (för att öka antalet posts)
        // $user = User::where('id', 4); // Ska komma från inloggade användaren
        // $user->posts = $user->posts +1; 

        //Hämta tråden man svarat på 
        $thread = Thread::find($request->threadID);
        $replies = Reply::where('thread_id', $request->threadID)->get();
        $users = User::all(); // borde bara hämta vissa ??

        return view('forum')->with('from', 'thread')
                            ->with('thread', $thread)
                            ->with('replies', $replies)
                            ->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reply $reply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        //
    }
}
