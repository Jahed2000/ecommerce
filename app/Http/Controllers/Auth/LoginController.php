<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use App\Notifications\VerifyRegistration;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // method below is brought from Illuminate\Foundation\Auth\AuthenticatesUsers;

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        //find user by this email
        $user = User::where('email',$request->email)->first();
        if(!is_null($user)){
        ////
            if ($user->status==1) {

                //login this user
                if (Auth::guard('web')->attempt(['email'=>$request->email, 'password'=>$request->password,] ,$request->remember)) {

                    //login if email and pass match
                    return redirect()->intended(route('index')); 
                    } else{
                        session()->flash('error','incorrect email or password');
                        return redirect('login');
                    }

                } else{
               

                    //send him a token if his status isnt active
                    //if the user exists in DB
                    if (!is_null($user)) {

                        $user->notify( new VerifyRegistration($user) );
                        session()->flash('success','a new confirmation email has been sent to your email');
                        return redirect('/');
                    } else{
                    //if the user doesnt exist in DB
                        session()->flash('error','Please register first!');
                        return redirect('register');
                    }
                }
            ////
            }else{
                session()->flash('error','user does not exist');
                    return redirect('login');
            }

        } 
    }

