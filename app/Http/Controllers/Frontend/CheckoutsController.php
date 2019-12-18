<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Payment;
use App\Models\Order;
use App\Models\Cart;
use Auth;

class CheckoutsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::orderBy('priority','asc')->get();

        return view('frontend.pages.checkouts',compact('payments'));
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
            'name'          =>  'required',
            'phone_no'          =>  'required',
            'shipping_address'          =>  'required',
            'payment_method_name'          =>  'required',
       ]);

       $order = new Order();

     //check if transaction id is given or not.i.e. cash on delivery or prepaid
       if ($request->payment_method_name!='cash_on_delivery') {

        if ($request->transaction_id==NULL||empty($request->transaction_id)) {
            session()->flash('error','please provide a transaction id');
            return back();
        }else{
           $order->transaction_id = $request->transaction_id;
        }

       }
    //check if registered user or guest
       if (Auth::check()) {
           $order->user_id = Auth::id();
       }

       $order->ip_address = request()->ip();
       $order->name = $request->name;
       $order->email = $request->email;
       $order->phone_no = $request->phone_no;
       $order->shipping_address = $request->shipping_address;
       $order->message = $request->message;
       $order->payment_id = Payment::where('short_name',$request->payment_method_name)->first()->id;

       $order->save();

       foreach(Cart::totalCarts() as $cart) {
           $cart->order_id = $order->id;
           $cart->save();
       }
       

       session()->flash('success','your order has been placed!');
       return redirect()->route('index');


    }

   
}
