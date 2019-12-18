<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use Image; //intervention image third party class
use File;

class CategoriesController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
    	$category = Category::orderBY('id')->get();
    	return view('admin.pages.categories.index', compact('category'));
    }

    public function create()
    {	
    	$primary_categories = Category::orderBY('name','desc')->where('parent_id',NULL)->get();

    	return view('admin.pages.categories.create', compact('primary_categories'));
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'name'			=>	'required',
    		'image'			=>	'nullable|image',
    		'parent_id'		=>	'nullable',
    		'description'	=>	'nullable',
    	],
    	[
    		'name.required'		=>	'Please provide a category name',
    		'image.image'				=>	'Selected file must be an image',
    	]
    );


    	$category = new Category();

    	$category->name = $request->name;
    	$category->description = $request->description;

    	if (!empty($request->parent_id)) {
    		$category->parent_id = $request->parent_id;
    	} else{
    		$category->parent_id = null;
    	}

    	if( $request->hasFile('image') ){
    		//refer to adminproductcontroller in case of confusion
    		$this->__image_uploader($request,$category);
    	}
    	
    	$category->save(); 

    	session()->flash('success','The category has been added successfully');

    	return redirect()->route('admin.categories');
    }

    public function delete($id)
    {	
    	
    	$category = Category::find($id);
    	// if its a parent category, delete its sub categories

    	if ($category->parent_id==NULL) {
    	// deleting sub categories
    		$sub_category = Category::orderBY('name','desc')->where('parent_id',$category->id)->get();
    		foreach ($sub_category as $sub) {
    			//deletes images
    			if (File::exists('images/categories/'.$sub->image)) {
    			File::delete('images/categories/'.$sub->image);
    			}
    			//deletes category 
    			$sub->delete();
    		}
    	}

    	//delete the images that belong to this category
    	if (File::exists('images/categories/'.$category->image)) {
    		File::delete('images/categories/'.$category->image);
    	}

    	$category->delete();

        session()->flash('delete','The category has been deleted successfully');

    	return back();
    }

    public function edit($id)
    {
    	$category = Category::find($id);

    	$primary_categories = Category::orderBY('name','desc')->where('parent_id',null)->get();

    	return view('admin.pages.categories.edit', compact('category', 'primary_categories'));
    }

    public function update(Request $request, $id)
    {
    	$category = Category::find($id);

    	$category->name = $request->name;
    	$category->description = $request->description;

    	if (!empty($request->parent_id)) {
    		$category->parent_id = $request->parent_id;
    	} else{
    		$category->parent_id = null;
    	}

    	if ($request->hasFile('image')) {

//if categoroy already has an image,delete the previous image, then upload the new one
    		if (File::exists('images/categories/'.$category->image)) {
    			File::delete('images/categories/'.$category->image);
    		}
//uploads the new one
    		$this->__image_uploader($request,$category);
    	}

    	$category->save();

    	session()->flash('update','The category has been updated successfully');

    	return redirect()->route('admin.categories');
    }

    public function __image_uploader($request,$category)
    {
    	$image = $request->file('image');
		$img = time().'.'.$image->getClientOriginalExtension(); 
		$location = public_path('images/categories/'.$img);
		Image::make($image)->save($location);

		$category->image = $img;
    }

}
