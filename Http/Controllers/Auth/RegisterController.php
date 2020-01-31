<?php

namespace Elightwalk\AuthGuard\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Elightwalk\AuthGuard\Providers\RouteServiceProvider;
use Elightwalk\AuthGuard\Eloquent\Admins;
use Elightwalk\AuthGuard\Eloquent\Customers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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
        $this->middleware('authguardguest:admin')->except('logout');
        $this->middleware('authguardguest:customer')->except('logout');
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers', 'unique:admins'],
            'password' => ['required', 'string', 'min:6'],
        ]);
    }

    // Admin

    public function showAdminRegisterForm()
    {
        return view('authguard::auth.register', ['url' => 'admin']);
    }
    protected function createAdmin(Request $request)
    {
        $this->validator($request->all())->validate();
        Admins::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'remember_token' => $request['_token'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->intended('login/admin');
    }

    // Customer

    public function showCustomerRegisterForm()
    {
        return view('authguard::auth.register', ['url' => 'customer']);
    }

    protected function createCustomer(Request $request)
    {
        $this->validator($request->all())->validate();
        Customers::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'remember_token' => $request['_token'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->intended('login/customer');
    }
}
