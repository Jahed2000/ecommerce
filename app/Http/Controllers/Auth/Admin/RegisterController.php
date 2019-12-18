<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;

use App\Models\Division;
use App\Models\District;

use App\Notifications\VerifyRegistration;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    // this fuction brought from vendor/laravel/framework/Illuminate\Foundation\Auth\RegistersUsers; and overrides said function
    {
        $divisions =  Division::orderBy('priority','asc')->get();
        $districts =  District::orderBy('division_id','asc')->get();

        return view('auth.register',compact('divisions','districts'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:20'],
            'last_name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'division_id' => ['required','numeric'],
            'district_id' => ['required','numeric'],
            'street_address' => ['required', 'string', 'max:100'],
            'phone_no' => ['required','max:11'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function register(Request $request) //changed the default create() method to register() method in order to avoid error
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => str_slug( $request->first_name.$request->last_name ),
            'email' => $request->email,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'street_address' => $request->street_address,
            'phone_no' => $request->phone_no,
            'password' => Hash::make($request->password),
            'ip_address' => request()->ip(),
            'remember_token' =>  str_random(50), //generates 50 random number
            'status'    => 0,
        ]);

        $user->notify( new VerifyRegistration($user) );

        session()->flash('success','a confirmation email has been sent to your email');
        return redirect('/');
    }
}
