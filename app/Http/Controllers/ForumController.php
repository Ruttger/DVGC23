<?php

namespace App\Http\Controllers;

use App\Forum;
use App\Thread;
use App\User;
use App\Category;
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
        // Skapa nytt forum
        $forum = new Forum;
        $forum->title = $request->title;
        $forum->subtitle = $request->subtitle;
        $forum->category_id = $request->categoryID;
        $forum->save();


        // Hämta categories och forum
        $categories = Category::all();
        $forums = Forum::all();
        $threads = Thread::all();


        // returnerar till (forum/tråd vy)
        return redirect('/forum/'.$forum->id.'')
            ->with('from', 'forum')
            ->with('forum', $forum)
            ->with('threads', $threads); 

        // Om man istället vill redirecta till rooten av forumet (kategori/forum vy)  
        // return redirect('/forum/')
        //     ->with('from', 'category')
        //     ->with('categories', $categories)
        //     ->with('forums', $forums)
        //     ->with('threads', $threads);

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
    public function show(Forum $forum, $id)
    {
        //
        
        $forum   = Forum::find($id);
        // Uppdatera antal views
        $forum->num_views = $forum->num_views + 1;
        $forum->save();

        $threads = Thread::where('forum_id', $id)->get();
        $user = User::all(); 
        return view('forum')->with('from', 'forum')
                            ->with('forum', $forum)
                            ->with('threads', $threads);
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
    public function destroy(Forum $forum)
    {
        //
    }
}
