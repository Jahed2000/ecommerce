<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Slider;

class PagesController extends Controller
{
    public function index()
    {
    	$products = Product::orderBy('id', 'desc')->paginate(6);
        $sliders = SLider::orderBy('priority', 'asc')->get();
    	return view('frontend.pages.product.index')->with('products',$products)->with('sliders',$sliders);
    }

    public function contact()
    {
    	return view('frontend.pages.contact'); 
    }

    public function search(Request $request)
    {	
    	$search = $request->search;
    	$products = Product::orWhere('title','like','%'.$search.'%')
    	->orWhere('description','like', '%'.$search.'%')
    	->orWhere('slug','like', '%'.$search.'%')
    	->orderBy('id', 'desc')->paginate(6);
    	return view('frontend.pages.product.search' , compact('search', 'products'));
    }
    
}

