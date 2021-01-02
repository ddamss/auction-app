<?php

namespace App\Http\Controllers\Auth;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:buyer')->except('logout');
        $this->middleware('guest:seller')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:1'
        ]);

        if (Auth::guard('buyer')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            //(1) Get current buyer App\Buyer::find(1)
            $buyer = Buyer::find(Auth::guard('buyer')->user()->id);
            //(2) Create token
            $token = Auth::guard('buyer')->user()->createToken('authToken')->accessToken;
            //(3) Update auth_token fild of Buyer model with the token value above
            $buyer->update(['access_token' => $token]);
            // dd($token);
            // return redirect()->intended('/home');
            return redirect()->intended(route('auctions.index'));
        } else if (Auth::guard('seller')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended(route('auctions.index'));
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    public function logout(Request $request)
    {

        // dd(Auth::guard('seller')->user());
        Auth::logout();

        $this->guard()->logout();
        // Auth::guard('seller')->logout();

        $request->session()->flush();
        // $request->session()->forget('name');

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->loggedOut($request) ?: redirect('/');
    }
}
