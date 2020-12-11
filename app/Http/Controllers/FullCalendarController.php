<?php

namespace App\Http\Controllers;

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

            $data = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id','title','start', 'end']);
            return Response::json($data);
        }
        return view('fullcalendar');
    }

    public function create(Request $request)
    {
        $event = new Event();
        $event->title=$request->get('event_title');
        $event->start=$request->get('start_time');
        $event->end=$request->get('end_time');
        $event->save();

        return Redirect::to('/calendar');
    }


    public function update(Request $request)
    {
        $where = array('id' => $request->id);
        $updateArr = ['start' => $request->start_time, 'end' => $request->end_time];
        $event  = Event::where($where)->update($updateArr);

        return Response::json($event);
    }


    public function destroy(Request $request)
    {
        $event = Event::where('id',$request->id)->delete();

        return Response::json($event);
    }
}
