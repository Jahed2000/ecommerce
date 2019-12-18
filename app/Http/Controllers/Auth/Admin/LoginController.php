<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use App\Notifications\VerifyRegistration;
use App\Models\User;
use App\Models\Admin;
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
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

//overwriting from Illuminate\Foundation\Auth\AuthenticatesUsers;
    public function showLoginForm()
    {
        return view('auth.admin.login');
    }

    // method below is brought from Illuminate\Foundation\Auth\AuthenticatesUsers;

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        //find user by this email
        $admin = Admin::where('email',$request->email)->first();
        if(!is_null($admin)){
           
                //login this admin
                if (Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password,] ,$request->remember)) {

                    //login if email and pass match
                    return redirect()->intended(route('admin.index')); 
                    } else{
                        session()->flash('error','incorrect email or password');
                        return back();
                    }
     
        }  else{
                        session()->flash('error','incorrect email or password');
                        return back();
                    }
    }

// method below is brought from Illuminate\Foundation\Auth\AuthenticatesUsers;
     public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect()->route('admin.login');
    }


}