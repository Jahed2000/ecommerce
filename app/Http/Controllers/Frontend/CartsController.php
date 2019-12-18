<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Cart;
use App\Models\Order;

use Auth;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.pages.carts');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        dd('fddf');
        $request->validate([
            'product_id'    =>  'required',
        ]);

        if (Auth::check()) {

            $cart = Cart::where('user_id',Auth::id())
                    ->where('product_id',$request->product_id)
                    ->where('order_id',NULL)
                    ->first();
        } else{
            
            $cart = Cart::where('ip_address',request()->ip())
                    ->where('product_id',$request->product_id)
                    ->where('order_id',NULL)
                    ->first();
        }

        if ( !is_null($cart) ) {
            // dd('is null');
            
            $cart->increment('product_quantity');

        } else{
// dd($cart);
            $cart = new Cart;

            if (Auth::check()) {
                //if a registered user is adding to cart
                $cart->user_id = Auth::id();
            } 
            $cart->product_id = $request->product_id;
            $cart->ip_address = $request->ip();

            $cart->save();
        }


        session()->flash('success','product added to cart successfully'); 
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $cart = Cart::find($id);
        if (!is_null($cart)) {
            $cart->product_quantity = $request->product_quantity;
            $cart->save();
        } else{
            return redirect()->route('carts');
        }

        session()->flash('success','cart item updated successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $cart = Cart::find($id);
        if (!is_null($cart)) {
            $cart->delete();
        } else{
            return redirect()->route('carts');
        }

        session()->flash('success','cart item deleted successfully');
        return back();
    }
}
