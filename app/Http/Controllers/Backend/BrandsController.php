<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Brand;
use Image; //intervention image third party class
use File;

class BrandsController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
    	$brand = Brand::orderBY('id')->get();
    	return view('admin.pages.brands.index', compact('brand'));
    }

    public function create()
    {	
    	
    	return view('admin.pages.brands.create');
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'name'			=>	'required',
    		'image'			=>	'nullable|image',
    		// 'parent_id'		=>	'nullable',
    		'description'	=>	'nullable',
    	],
    	[
    		'name.required'		=>	'Please provide a brand name',
    		'image.image'		=>	'Selected file must be an image',
    	]
    );


    	$brands = new Brand();

    	$brands->name = $request->name;
    	$brands->description = $request->description;


    	if( $request->hasFile('image') ){
    		//refer to adminproductcontroller in case of confusion
    		$this->__image_uploader($request,$brands);
    	}
    	
    	$brands->save(); 

    	session()->flash('success','The brand has been added successfully');

    	return redirect()->route('admin.brands');
    }

    public function delete($id)
    {	
    	
    	$brands = Brand::find($id);
    	// if its a parent brand, delete its sub brands

    	// if ($brands->parent_id==NULL) {
    	// // deleting sub brands
    	// 	$sub_brand = Brand::orderBY('name','desc')->where('parent_id',$brands->id)->get();
    	// 	foreach ($sub_brand as $sub) {
    	// 		//deletes images
    	// 		if (File::exists('images/brands/'.$sub->image)) {
    	// 		File::delete('images/brands/'.$sub->image);
    	// 		}
    	// 		//deletes brand 
    	// 		$sub->delete();
    	// 	}
    	// }

    	//delete the images that belong to this brand
    	// var_dump(File::exists('images/brands'.$brands->image));
    	if (File::exists('images/brands/'.$brands->image)) {
    		File::delete('images/brands/'.$brands->image);
    	}

    	$brands->delete();

        session()->flash('delete','The brand has been deleted successfully');


    	return back();
    }

    public function edit($id)
    {
    	$brand = Brand::find($id);

    	return view('admin.pages.brands.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
    	$brands = Brand::find($id);

    	$brands->name = $request->name;
    	$brands->description = $request->description;

    	// if (!empty($request->parent_id)) {
    	// 	$brands->parent_id = $request->parent_id;
    	// } else{
    	// 	$brands->parent_id = null;
    	// }

    	if ($request->hasFile('image')) {

//if categoroy already has an image,delete the previous image, then upload the new one
    		if (File::exists('images/brands/'.$brands->image)) {
    			File::delete('images/brands/'.$brands->image);
    		}
//uploads the new one
    		$this->__image_uploader($request,$brands); //calls function
    		}     	

    	$brands->save();

    	session()->flash('update','The brand has been updated successfully');

    	return redirect()->route('admin.brands');
    }

    public function __image_uploader($request,$brands)
    {
    	$image = $request->file('image');
		$img = time().'.'.$image->getClientOriginalExtension(); 
		$location = public_path('images/brands/'.$img);
		Image::make($image)->save($location);

		$brands->image = $img;
    }

}
