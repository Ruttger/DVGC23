<?php

namespace App\Http\Controllers;

use Auth;
use App\Forum;
use App\Thread;
use App\User;
use App\Category;
use App\Reply;
use Illuminate\Http\Request;

class ForumController extends Controller
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
        if(!Auth::check() || Auth::user()->role != "admin" || Auth::user()->banned == 1)
            return redirect('/forum/');

        // Skapa nytt forum
        $category = Category::find($request->categoryID);
        $forum = new Forum;
        $forum->title = $request->title;
        $forum->subtitle = $request->subtitle;
        $forum->category_id = $category->id;
        $forum->rights = $category->rights;
        $forum->save();

        // returnerar till (forum/tråd vy)
        return redirect('/forum/'.$forum->id.'')
            ->with('from', 'forum')
            ->with('forum', $forum); 

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
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function show($forumID)
    {
        $forum   = Forum::find($forumID);



        $forum->num_views = $forum->num_views + 1;
        $forum->save();

        $threads = Thread::where('forum_id', $forumID)->get();

        // Skapar en tom collection och lägger in senaste svaret för varje tråd (om inget svar - null)
        $latest_replies = collect();    
        foreach($threads as $thread){
            $reply = Reply::where('thread_id', $thread->id)->orderBy('updated_at','DESC')->get()->first();
            if($reply != null)
                $latest_replies->push($reply);        
        }

        if(Auth::user() == null && $forum->rights == 'user' || Auth::user()->role <= $forum->rights){
            return view('forum')->with('from', 'forum')
                                ->with('forum', $forum)
                                ->with('threads', $threads)
                                ->with('latest_replies', $latest_replies);            
        }else{
            return redirect('/forum');
        }
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function edit(Forum $forum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Forum $forum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Forum $forum, $forumID)
    {

        if(!Auth::check() || Auth::user()->role == "1")
            return redirect('/forum');
        
        $forum->destroy($forumID);

        $categories = Category::all();
        $forums = Forum::all();
        $threads = Thread::all();
        // dd($categories); // print och döda
        return redirect('/forum');

    }
}
