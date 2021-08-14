<?php

namespace App\Http\Controllers;
use App\Models\Patient;
use App\Models\Event;
use App\Models\Doctor;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $data = Patient::all();
        return view('Patient.index', compact('data'));
    }

    public function show($id)
    {
        $patient = Patient::find($id);
        $name = $patient->name;
        $data[0] = Event::where('title', $name)->get();
        $doctor_id[]=$data[0]->pluck('doctor_id');
        foreach ($doctor_id as $key => $value) 
        {
            $data[0]->doctor_id = Doctor::whereIn('id', $value)->get('name');
        }
        // dd($data[0]->doctor_id[0]->name);
        return view('Patient.show', compact('data'));
    }


    public function create(Request $request)
    {
        return view('Patient.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $work =  Patient::create($input);
        return redirect('/');
    }
}
