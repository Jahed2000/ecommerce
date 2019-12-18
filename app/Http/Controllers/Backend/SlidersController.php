<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Slider;
use Image; //intervention image third party class
use File;

class SlidersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $sliders =  Slider::orderBy('priority','asc')->get();
        return view('admin.pages.sliders.index' , compact('sliders') );
    }

    
    public function store(Request $request)
    {
    	// dd('sdf');
        $request->validate([
            'title'      	=>  'required',
            'image'      	=>  'required|image',
            'button_text'   =>  'nullable',
            'button_link'   =>  'nullable|url',
            'priority'  	=>  'required',
        ],
        [
            'title.required'     =>  'please provide a slider title name',
            'image.image'     	=>  'please provide a valid slider image',
            'button_link.required'     =>  'please provide a valid url',
            'priority.required' =>  'please enter a priority',
        ], );


        $slider = new Slider;
        $slider->title = $request->title;
        $slider->button_text = $request->button_text;
        $slider->button_link = $request->button_link;
        $slider->priority = $request->priority;
        if( $request->hasFile('image') ){
    		$image = $request->file('image');
			$img = time().'.'.$image->getClientOriginalExtension(); 
			$location = public_path('images/sliders/'.$img);
			Image::make($image)->save($location);
			$slider->image = $img;
    	}
        $slider->save();

        session()->flash('success', 'slider added successfully');
        return redirect()->route('admin.sliders');
    }

    
   
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'      	=>  'required',
            'image'      	=>  'nullable|image',
            'button_text'   =>  'nullable',
            'button_link'   =>  'nullable|url',
            'priority'  	=>  'required',
        ],
        [
            'title.required'     =>  'please provide a slider title name',
            'image.image'     	=>  'please provide a valid slider image',
            'button_link.required'     =>  'please provide a valid url',
            'priority.required' =>  'please enter a priority',
        ], );


        $slider = Slider::find($id);
        $slider->title = $request->title;
        $slider->button_text = $request->button_text;
        $slider->button_link = $request->button_link;
        $slider->priority = $request->priority;

        if( $request->hasFile('image') ){
        	// delete old image
        	if (File::exists('images/sliders/'.$slider->image)) {
    		File::delete('images/sliders/'.$slider->image);
    		}
        	// add new image
    		$image = $request->file('image');
			$img = time().'.'.$image->getClientOriginalExtension(); 
			$location = public_path('images/sliders/'.$img);
			Image::make($image)->save($location);
			$slider->image = $img;
    	}

        $slider->save();

        session()->flash('success', 'slider added successfully');
        return redirect()->route('admin.sliders');
    }


    public function delete($id)
    {
        $slider = Slider::find($id);
        // delete image
        if (File::exists('images/sliders/'.$slider->image)) {
    		File::delete('images/sliders/'.$slider->image);
    		}
    	// delete all else
            $slider->delete();
         

        session()->flash('success', 'slider deleted successfully');
        return back();
        
    }

  
}
