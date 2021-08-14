<?php

namespace App\Http\Controllers;
use App\Models\Doctor;
use App\Models\Event;
use App\Models\Work;
use App\Models\Patient;

use Illuminate\Http\Request;

class DoctorController extends Controller
{
        
    
    public function info_full(Request $request)
    {
        if($request->ajax())
        {
            $data = Event::all();
            return response()->json($data);
        }
        return view('welcome');
    }





    public function index()
    {
        $data = Doctor::all();
        return view('Doctor.index', compact('data'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $search = Patient::where("name", "LIKE", "%{$search}%")->get();
        return response()->json($search);
    }

    public function ajax($id)
    {
        $data = Doctor::where('id', $id)->get();
        return view('Doctor.info', compact('data'));
    }

    
    public function info($id, Request $request)
    {
        if($request->ajax())
        {
            $data = Event::where('doctor_id', $id)
                    ->whereDate('start', '>=', $request->start)
                    ->whereDate('end',   '<=', $request->end)
                    ->get(['id', 'title', 'start', 'end', 'doctor_id', 'status']);
            return response()->json($data);
        }
        return view('Doctor.info');
    }

    public function action($id, Request $request)
    {
        if($request->ajax())
        {
            if($request->type == 'add')
            {
                $request->title = Patient::where('id', $request->title)->pluck('name');
                $event = Event::create([
                    'title'     =>  $request->title[0],
                    'start'     =>  $request->start,
                    'end'       =>  $request->end,
                    'doctor_id' =>  $id,
                    'status'    =>  $request->status,
                ]);
                return response()->json($event);
            }

            
            if($request->type == 'update')
            {
                $event = Event::find($request->id)->update(
                [
                    'title'     =>  $request->title,
                    'start'     =>  $request->start,
                    'end'       =>  $request->end,
                    'doctor_id'     =>  $request->doctor_id,
                ]);
                return response()->json($event);
            }

            if($request->type == 'delete')
            {
                $event = Event::find($request->id)->delete();
                return response()->json($event);
            }

            if($request->type == 'about')
            {
                $event = Event::find($request->id);
                return response()->json($event);
            }

            if($request->type == 'change_status')
            {
                $event = Event::find($request->id)->update(
                [
                    'status'  =>  $request->status,
                ]);
                return response()->json($event);
            }

            if($request->type == 'search')
            {
                $search = $request->search;
                $data = Patient::where("name", "LIKE", "%{$search}%")->get();
                return response()->json($data);
            }

            if($request->type == 'color')
            {
                $data = Event::select('status')->get();
                return response()->json($data);
            }
        }
    }

    public function graph($id)
    {
        $data = Doctor::where('id', $id)->get();
        return view('Doctor.graph', compact('data', $data));
    }

    public function graph_register(Request $request)
    {
        $input = $request->all();
        $db = DoctorGraph::all();

        $collect = $db->pluck('date');
        foreach ($collect as $key => $value) 
        {
            if($input['date'] != $value)
            {
                DoctorGraph::create($input);
            }
        }
        
        $doctor = Doctor::all();
        return redirect()->route('doctors');
    }

    public function show_graph($id)
    {
        $data = DoctorGraph::where('doctor_id', $id)->get();
        return view('Doctor.show_graph')->with('data', json_decode($data, true));
    }

    public function search_graph($id, Request $request)
    {
        $data = DoctorGraph::where('date', $request->date)->get();
        return response()->json($data);
        // return view('Doctor.show_graph')->with('data', json_decode($data, true));       
    }

    public function create(Request $request)
    {
        return view('Doctor.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $work =  Doctor::create($input);
        return redirect('/');
    }

    
}
