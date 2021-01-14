<?php

namespace App\Http\Controllers;

use Auth;
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

        if(!Auth::check() || Auth::user()-> banned == 1)
            return view('/forum');
                    
        // Skapa ny tråd
        $reply = new Reply;
        $reply->body = $request->body;
        $reply->thread_id = $request->threadID;
        $reply->user_id = Auth::user()->id;
        
        // tråden
        $thread = Thread::find($request->threadID);
        $thread->num_replies = $thread->num_replies + 1;
        $thread->touch();
        $thread->save();
        $reply->rights = $thread->rights;
        $reply->save();

        $user = Auth::user();
        $user->num_posts = $user->num_posts + 1;
        $user->save();  

        //Hämta tråden man svarat på 
        $thread = Thread::find($request->threadID);
        $replies = Reply::where('thread_id', $request->threadID)->get();
        $users = User::all(); // borde bara hämta vissa ??


        // Använder return redirect istället för return view för att  
        return redirect('/forum/'.$thread->forum_id.'/thread/'.$thread->id.'')
            ->with('from',$thread)
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
    public function destroy(Reply $reply, $replyID)
    {

        if(!Auth::check() || Auth::user()->role != "admin"){

            dd(Auth::user()->role);
            return redirect('/forum');
        }

        $reply = Reply::find($replyID);
        $thread = Thread::find($reply->thread_id);
        $thread->num_replies = $thread->num_replies - 1;
        $thread->save();

        $reply->destroy($replyID);

        $replies = Reply::where('thread_id', $reply->thread_id)->get();
        $repliers_id = [];
        foreach ($replies as $reply){
            array_push($repliers_id, $reply->user_id);
        }

        // hämta användarna som har skrivit i tråden
        $repliers = User::all()->intersect(User::whereIn('id', $repliers_id)->get());

        return view('forum')->with('from', 'thread')
                            ->with('thread', $thread)
                            ->with('replies', $replies)
                            ->with('repliers', $repliers)
                            ->with('orignal_poster', User::find($thread->user_id));            
     
    }
}
