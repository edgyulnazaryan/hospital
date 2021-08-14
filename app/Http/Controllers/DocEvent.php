<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DocEvent extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Event::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->get(['id', 'title', 'start', 'end']);
            return response()->json($data);
        }
        return view('Doctor.info');
    }

    public function action(Request $request)
    {
        if($request->ajax())
        {
            if($request->type == 'add')
            {
                $event = Event::create([
                    'title'     =>  $request->title,
                    'start'     =>  $request->start,
                    'end'       =>  $request->end
                ]);

                return response()->json($event);
            }

            if($request->type == 'update')
            {

                $event = Event::find($request->id)->update(
                [
                    'title'     =>  $request->title,
                    'start'     =>  $request->start,
                    'end'       =>  $request->end
                ]);


                return response()->json($event);
            }

            if($request->type == 'delete')
            {
                $event = Event::find($request->id)->delete();

                return response()->json($event);
            }

            if($request->type == 'search')
            {
                $search = $request->search;
                $data = Event::where("title","LIKE", "%{$search}%")->get();
                return response()->json($event);
            }
        }
    }
}
