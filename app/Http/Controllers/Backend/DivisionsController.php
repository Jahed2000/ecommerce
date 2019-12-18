<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Division;
use App\Models\District;

class DivisionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $divisions =  Division::orderBy('priority','asc')->get();
        return view('admin.pages.divisions.index' , compact('divisions') );
    }

    
    public function create()
    {
        return view('admin.pages.divisions.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name'      =>  'required',
            'priority'  =>  'required',
        ],
        [
            'name.required'     =>  'please provide a division name',
            'priority.required' =>  'please enter a priority',
        ] );

        $division = new Division;
        $division->name = $request->name;
        $division->priority = $request->priority;

        $division->save();

        session()->flash('success', 'division added successfully');
        return redirect()->route('admin.divisions');
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $division = Division::find($id);

        if (!is_null($division)) {
        return view('admin.pages.divisions.edit', compact('division'));
        } else{
        return redirect()->route('admin.divisions');
        }

    }

   
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'      =>  'required',
            'priority'  =>  'required',
        ],
        [
            'name.required'     =>  'please provide a division name',
            'priority.required' =>  'please enter a priority',
        ] );

        $division = Division::find($id);
        $division->name = $request->name;
        $division->priority = $request->priority;

        $division->save();

        session()->flash('success', 'division added successfully');
        return redirect()->route('admin.divisions');
    }


    public function delete($id)
    {
        $division = Division::find($id);

        if (!is_null($division)) {
            //delete all districts under the division
            $districts = District::where('division_id',$division->id);
            foreach ($districts as $district) {
                $district->delete();
            }

            $division->delete();
        } 

        session()->flash('success', 'division deleted successfully');
        return back();
        
    }

  
}
