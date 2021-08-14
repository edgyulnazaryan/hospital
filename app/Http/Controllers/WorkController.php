<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\Event;
class WorkController extends Controller
{
    public function index($id, Request $request)
    {
        $event = Event::find($request->id);
        return view('Work.create', compact('event'));
    }

    public function create(Request $request)
    {
        $input = $request->all();
        $work =  Work::create($input);
        return redirect('/');
    }
    
      
}
