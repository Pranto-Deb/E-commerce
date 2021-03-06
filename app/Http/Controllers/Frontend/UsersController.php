<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\District;
use App\Models\Division;


class UsersController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(){
    	$user = Auth::user();
       	return view('frontend.pages.users.dashboard', compact('user'));
    }
    public function profile(){
    	$divisions = Division::orderBy('priority', 'asc')->get();
        $districts = District::orderBy('name', 'asc')->get();
    	$user = Auth::user();
       	return view('frontend.pages.users.profile', compact('user', 'divisions', 'districts'));
    }
    public function profileUpdate(Request $request){
    	$user = Auth::user();
    	$this->validate($request, [
    		'first_name' => 'required|string|max:30',
            'last_name' => 'nullable|string|max:15',
            'user_name' => 'required|alpha_dash|max:100|unique:users,user_name,'.$user->id,
            'email' => 'required|string|email|max:100|unique:users,email,'.$user->id,
            'phone_no' => 'required|max:15|unique:users,phone_no,'.$user->id,
            'district_id' => 'required|numeric',
            'division_id' => 'required|numeric',
            'street_address' => 'required|max:100',
        ]);
    	$user->first_name = $request->first_name;
    	$user->last_name = $request->last_name;
    	$user->user_name = $request->user_name;
    	$user->email = $request->email;
    	$user->phone_no = $request->phone_no;
    	$user->district_id = $request->district_id;
    	$user->division_id = $request->division_id;
    	$user->street_address = $request->street_address;
    	$user->shipping_address = $request->shipping_address;
    	if($request->password != NULL || $request->password == ""){
    		$user->password = Hash::make($request->password);
    	}
    	$user->ip_address = request()->ip();
    	$user->save();

    	session()->flash('success', 'User profile has updated successfully !!');
       	return redirect()->back();
    }
}
