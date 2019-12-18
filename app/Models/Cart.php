<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Auth;

class Cart extends Model
{
     public $fillable = [
    		'product_id',
    		'user_id',
    		'order_id',
    		'ip_address',
    		'product_quantity',
    ];
   
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }

    public function order()
    {
    	return $this->belongsTo(Order::class);
    }


 	public static function totalCarts() //returns items in cart
    {
    	if(Auth::check()){
    		$carts = Cart::where('user_id',Auth::id())
                    ->where('order_id',NULL)
                    ->get();
    	} else{
    		$carts = Cart::where('ip_address',request()->ip())
                    ->get();
    	}

    	return $carts;
    }

    public static function totalItems() //returns number of items in cart
    {
    	if(Auth::check()){
    		$carts = Cart::where('user_id',Auth::id())
                    ->where('order_id',NULL)
                    ->get();
    	} else{
    		$carts = Cart::where('ip_address',request()->ip())
                    ->where('order_id',NULL)
                    ->get();
    	}

    	$total_items = 0;

    	foreach($carts as $cart){
    		$total_items = $total_items+$cart->product_quantity;
    	}
    	return $total_items;
    }
}
