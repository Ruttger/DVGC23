<?php

namespace App\Http\Controllers;

use Auth;
use App\Event;
use Illuminate\Http\Request;
use Redirect,Response;

class FullCalendarController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');

            $data = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get([
                'id',
                'title',
                'start', 
                'end', 
                'url',
                'description'
                
            ]);
            return Response::json($data);
        }

        if(Auth::check())
            $role = Auth::user()->role;
        else
            $role = "none";

        return view('fullcalendar')->with('role', $role);
    }

    public function create(Request $request)
    {
        $event = new Event();
        $event->title=$request->get('event_title');
        $event->start=$request->get('start_time');
        $event->end=$request->get('end_time');
        $event->url=$request->get('event_url');
        $event->description=$request->get('description');
        $event->save();

        return Redirect::to('/calendar');
    }


    public function updateDrop(Request $request)
    {
        $where = array('id' => $request->id);
        $updateArr = ['start' => $request->start_time, 'end' => $request->end_time];
        $event  = Event::where($where)->update($updateArr);

        return Response::json($event);
    }


    public function update(Request $request)
    {
        $where = array('id' => $request->id);
        $updateArr = [  'title' => $request->event_title,
                        'start' => $request->start_time, 
                        'end'   => $request->end_time,
                        'url'   => $request->event_url,
                        'description' => $request->description];
        $event  = Event::where($where)->update($updateArr);

        return Response::json($event);
    }


    public function destroy(Request $request)
    {
        $event = Event::where('id',$request->id)->delete();

        return Response::json($event);
    }
}
