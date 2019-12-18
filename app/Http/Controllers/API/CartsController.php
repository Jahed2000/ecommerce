<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Cart;
use App\Models\Order;

use Auth;

class CartsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
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


        return json_encode( ['status'=>'success','message'=>'Item added to cart','totalItems'=>Cart::totalItems()] );

    }

 
 
}
