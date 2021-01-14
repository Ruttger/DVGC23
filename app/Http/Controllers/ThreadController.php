<?php

namespace App\Http\Controllers;

use Auth;
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
        // Om inte inloggad eller bannad
        if(!Auth::check() || Auth::user()-> banned == 1)
            return view('/forum');

        $thread = new Thread;
        $thread->title = $request->title;
        $thread->body = $request->body;
        $thread->forum_id = $request->forumID;
        $thread->user_id = Auth::user()->id;   
        
        $forum = Forum::find($request->forumID); 
        $thread->rights = $forum->rights;
        $thread->save();
        
        $forum->num_threads = $forum->num_threads + 1;
        $forum->latest_thread = $thread->id;
        $forum->save();        

        $user = Auth::user();
        $user->num_posts = $user->num_posts + 1;
        $user->save(); 

        
        $thread = Thread::where('forum_id', $request->forumID)->latest()->first();
        $replies = Reply::where('thread_id', $thread->id)->get();
        

        // Använder return redirect istället för return view för att 
        return redirect('/forum/'.$thread->forum_id.'/thread/'.$thread->id.'')
            ->with('from', 'thread')
            ->with('thread', $thread)
            ->with('replies', $replies);                          
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
        // Uppdatera antalet visningar
        $thread = Thread::find($threadID);
        $thread->num_views = $thread->num_views + 1;
        $thread->save();

        $replies = Reply::where('thread_id', $threadID)->get();

        // Skapa array av användar id:n
        $repliers_id = [];
        foreach ($replies as $reply){
            array_push($repliers_id, $reply->user_id);
        }

        // hämta användarna som har skrivit i tråden
        $repliers = User::all()->intersect(User::whereIn('id', $repliers_id)->get());

        // Hämta forumet, så man kan verifera om användaren har rätt till forumet
        $forum = Forum::find($forumID);

        if(Auth::user() == null && $forum->rights == 'user' || Auth::user()->role <= $forum->rights){
            return view('forum')->with('from', 'thread')
                                ->with('thread', $thread)
                                ->with('replies', $replies)
                                ->with('repliers', $repliers)
                                ->with('orignal_poster', User::find($thread->user_id));            
        }else{
            return redirect('/forum');
        }


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
    public function destroy(Thread $thread, $forumID, $threadID)
    {
        //
        if(!Auth::check() || Auth::user()->role != 'admin'){
            return redirect('/forum');
        }
        
        $forum = Forum::find($forumID);
        $forum->num_threads = $forum->num_threads - 1;
        $forum->save();
        $thread->destroy($threadID);
        $threads = Thread::where('forum_id', $forum->id)->get();


        $latest_replies = collect();    
        foreach($threads as $thread){
            $reply = Reply::where('thread_id', $thread->id)->orderBy('updated_at','DESC')->get()->first();
            if($reply != null)
                $latest_replies->push($reply);        
        }

        return view('forum')->with('from', 'forum')
                            ->with('forum', $forum)
                            ->with('threads', $threads)
                            ->with('latest_replies', $latest_replies);
    }
}
