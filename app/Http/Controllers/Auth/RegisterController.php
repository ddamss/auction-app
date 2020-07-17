<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Buyer;
use App\Seller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:buyer');
        $this->middleware('guest:seller');
    }

        /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:1', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Buyer
     * @return \App\Seller     
     * */
    protected function create(array $data)
    {
        if($data['type']==='buyer')
        {

            $buyer=new \App\Buyer([
                'name' => $data['name'],
                'email' =>$data['email'],
                'password' => Hash::make($data['password']),
                'api_token' => Str::random(60),
            ]);

            // if($buyer) {Mail::to($data['email'])->send(new WelcomeUser($data));}

            return $buyer->save();
            
        }else{
            $seller=new \App\Seller([
                'name' => $data['name'],
                'email' =>$data['email'],
                'password' => Hash::make($data['password']),
            ]);

            // if($cleaner) {Mail::to($data['email'])->send(new WelcomeUser($data));}

            return $seller->save();
        }
    }
}
