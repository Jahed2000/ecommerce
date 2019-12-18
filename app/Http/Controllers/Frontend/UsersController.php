<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash; //for hashing password

use App\Models\User;
use App\Models\Division;
use App\Models\District;
use Auth;

class UsersController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
    	$user = Auth::user();
    	return view('frontend.pages.users.dashboard', compact('user') );
    }

    public function profile()
    {
    	$divisions =  Division::orderBy('priority','asc')->get();
        $districts =  District::orderBy('division_id','asc')->get();
    	$user = Auth::user();
    	return view('frontend.pages.users.profile',compact('user','divisions','districts') );
    }

    public function update(Request $request)
    {
    	$user = User::find(Auth::id());
        
    	$request->validate([
    		'first_name' => 'required', 'string', 'max:20',
            'last_name' => 'required', 'string', 'max:20',
            'username' => 'required', 'alpha_dash', 'max:20', 'unique:users,username,'.$user->id, //user can update username without email already exists error
            'email' => 'required', 'string', 'email', 'max:100', 'unique:users,email,'.$user->id, //user can update email without email already exists error
            // 'password' =>   'min:6', 'confirmed',
            'division_id' => 'required','numeric',
            'district_id' => 'required','numeric',
            'street_address' => 'required', 'string', 'max:100',
            'phone_no' => 'required','max:11',
    	]);

		// no need to send user id for profile update.. use Auth::user() instead


    		$user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->phone_no = $request->phone_no;
            $user->division_id = $request->division_id;
            $user->district_id = $request->district_id;
            $user->street_address = $request->street_address;
            $user->shipping_address = $request->shipping_address;

            if ( !empty($request->password) ) {
            	$user->password = Hash::make($request->password);
            }
// dd($user);

            $user->save();

            session()->flash('success','user profile has been updated');

            return back();

    }
}
