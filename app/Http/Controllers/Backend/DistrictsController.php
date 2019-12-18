<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\District;
use App\Models\Division;

class DistrictsController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $districts =  District::orderBy('division_id','asc')->get();
        return view('admin.pages.districts.index' , compact('districts') );
    }

    
    public function create()
    {
        $divisions =  Division::orderBy('priority','asc')->get();
        return view('admin.pages.districts.create',  compact('divisions'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name'      =>  'required',
            'division_id'  =>  'required',
        ],
        [
            'name.required'     =>  'please provide a district name',
            'division_id.required' =>  'please enter a division for the district',
        ] );

        $district = new District;
        $district->name = $request->name;
        $district->division_id = $request->division_id;

        $district->save();

        session()->flash('success', 'district added successfully');
        return redirect()->route('admin.districts');
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $district = District::find($id);
        $divisions =  Division::orderBy('priority','asc')->get();

        if (!is_null($district)) {
        return view('admin.pages.districts.edit', compact('district','divisions'));
        } else{
        return redirect()->route('admin.districts');
        }

    }

   
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'      =>  'required',
            'division_id'  =>  'required',
        ],
        [
            'name.required'     =>  'please provide a district name',
            'division_id.required' =>  'please enter a division id for district',
        ] );

        $district = District::find($id);
        $district->name = $request->name;
        $district->division_id = $request->division_id;

        $district->save();

        session()->flash('success', 'district added successfully');
        return redirect()->route('admin.districts');
    }


    public function delete($id)
    {
        $district = District::find($id);

        if (!is_null($district)) {
            $district->delete();
        } 

        session()->flash('success', 'district deleted successfully');
        return back();
        
    }
}
