<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Reply;
use App\User;
use App\Forum;
use Illuminate\Http\Request;

class ThreadController extends Controller
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
        $thread = new Thread;
        $thread->title = $request->title;
        $thread->body = $request->body;
        $thread->forum_id = $request->forumID;
        $thread->user_id = 4;       // SKA komma från den inloggade användaren
        $thread->save();

        // Hämta användaren (för att öka antalet posts)
        // $user = User::where('id', 4); // Ska komma från inloggade användaren
        // $user->posts = $user->posts +1; 

        // Hämta forumet som tråden tillhör för att öka antalet posts 
        $forum = Forum::find($request->forumID);
        $forum->num_threads = $forum->num_threads + 1;
        $forum->latest_thread = $thread->id;
        $forum->save();

        // Hämta senaste tråden i forumet man är i (den som precis skapades)
        // Så att man kan returnera datan från den för att visa datan (har inte tillgång till id)
        // annars
        $thread = Thread::where('forum_id', $request->forumID)->latest()->first();

        // dd($thread);
        // Hämta replies
        $replies = Reply::where('thread_id', $thread->id)->get();
        $users = User::all(); // borde bara hämta vissa ??


        // Använder return redirect istället för return view för att 
        return redirect('/forum/'.$thread->forum_id.'/thread/'.$thread->id.'')
            ->with('from', 'thread')
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
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Thread $thread, $forumID, $threadID)
    {
        //
        $thread = Thread::find($threadID);
        $thread->num_views = $thread->num_views + 1;
        $thread->save();



        $replies = Reply::where('thread_id', $threadID)->get();
        $users = User::all(); // borde bara hämta vissa ??

        return view('forum')->with('from', 'thread')
                            ->with('thread', $thread)
                            ->with('replies', $replies)
                            ->with('users', $users);        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        //
    }
}
