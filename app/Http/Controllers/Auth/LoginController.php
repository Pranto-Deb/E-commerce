<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Notifications\VerifyRegistration;

use App\Models\User;
use App\Models\Cart;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //find user by this email
        $user = User::where('email', $request->email)->first();
        if ($user->status == 1) {
            //Login this User
            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                //log this user now
                Cart::Where('ip_address', request()->ip())
                    ->where('user_id',null)
                    ->update([
                        'user_id'=>auth()->id(),
                    ]);

                return redirect()->intended(route('index'));
            }
            else{
                session()->flash('sticky_error', 'Invalid Login !!');
                return redirect()->route('login');
            }
        }
        else{
            //Send this user token again
            if (!is_null($user)) {
                $user->notify(new VerifyRegistration($user));
                session()->flash('success', 'A new confirmation email has sent to you...Please check and confirm your email');
                return redirect('/');
            }
            else{
                session()->flash('errors', 'Please Login First !!');
                return redirect()->route('login');
            }
        }

    }

}
