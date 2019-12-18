<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Image; //uses the intervention image package
use App\Models\ProductImage; 
use File;

class AdminProductsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {   
        $products = Product::orderBy('id','desc')->get();
        return view('admin.pages.product.index')->with('products',$products);
    }


    public function create()
    {
        $brand = Brand::orderBy('id', 'desc')->get();
    	return view('admin.pages.product.create', compact('brand') );
    }

    public function store(Request $request)
    {
    	
    	$this->validator($request); //calls validator function to validate form

    	$product = new Product;

    	$product->title = $request->title;
    	$product->description = $request->description;
    	$product->price = $request->price;
    	$product->quantity = $request->quantity;
    	$product->slug = str_slug($request->title);

    	$product->category_id = $request->category_id;
    	$product->brand_id = $request->brand_id;
    	$product->admin_id =1;

    	$product->save();

/****** THIS PART IS FOR SINGLE IMAGE INPUT ***/

    	// if ($request->hasFile('product_image')) {

    	// 	/*this part moves the image in designated folder as designated name 
    	// 	and it uses the third party Intervention Image package we installed */

    	// 	$image = $request->file('product_image');
    	// 	$img = time(). '.' .$image->getClientOriginalExtension();
    	// 	//so the above part looks like : timestamp.jpg
    	// 	$location = public_path('images/products/'.$img);
    	// 	Image::make($image)->save($location);

    	// 	/* end this part */

    	// 	/* this part inserts the image name in database as we designated
    	// 	and uses typical laravel functionalities */

    	// 	$product_image = new ProductImage;

    	// 	$product_image->product_id = $product->id; //$product->id uses previously created $product object
    	// 	$product_image->image = $img; //just saves the name
    	// 	$product_image->save();
    	// 	/* end this part */
    	// }

/****** END PART FOR SINGLE IMAGE INPUT ***/

/*** THIS PART FOR MULTIPLE IMAGE INPUT ***/
    	if ( $request->product_image>0 ) {

    		foreach ($request->product_image as $image) {

	    		$img = time(). '.' .$image->getClientOriginalExtension();
	    		//so the above part looks like : timestamp.jpg
	    		$location = public_path('images/products/'.$img);
	    		Image::make($image)->save($location);

	    		/* end this part */

	    		/* this part inserts the image name in database as we designated
	    		and uses typical laravel functionalities */

	    		$product_image = new ProductImage;

	    		$product_image->product_id = $product->id; //$product->id uses previously created $product object
	    		$product_image->image = $img; //just saves the name
	    		$product_image->save();
	    		/* end this part */
    		}
    	}

        session()->flash('success', 'Product added successfully');

    	return redirect()->route('admin.product.create');
    }

    public function validator($request)
    {
    	$request->validate([
    		'title'				=>	'required|max:30',
    		'description'		=>	'required|max:400',
    		'price'				=>	'required|max:100000|numeric',
    		'quantity'			=>	'required|max:1000|numeric',
            'category_id'       =>  'required|numeric',
            'brand_id'          =>  'required|numeric',
    	]);
    }


    public function edit($id)
    {	
    	$product = Product::find($id);
        $brand = Brand::orderBy('id', 'desc')->get();


    	return view('admin.pages.product.edit')->with('product',$product)->with('brand',$brand);
    }

    public function update(Request $request)
    {
    	$this->validator($request); //calls validator function to validate form

    	$product = Product::find($request->id);

    	// $product->title = $request->title;
    	// $product->description = $request->description;
    	// $product->price = $request->price;
    	// $product->quantity = $request->quantity;
    	$product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->slug = str_slug($request->title);

        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->admin_id =1;

    	$product->save();

        session()->flash('update', 'Product updated successfully');

    	return redirect()->route('admin.products');
    }


    public function delete($id)
    {   
        $product = Product::find($id);
        // dd($product);


foreach ($product->images as $product_image) {
                //deletes images
                if (File::exists('images/products/'.$product_image->image)) {
            File::delete('images/products/'.$product_image->image);
        }
                //deletes category 
                $product_image->delete();
            }

         
        $product->delete();

        session()->flash('delete','Product deleted successfully');
        
        return back();
    }

}
