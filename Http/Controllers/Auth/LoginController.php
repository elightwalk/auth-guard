<?php

namespace Elightwalk\AuthGuard\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Elightwalk\AuthGuard\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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

    // Show Admin Login Page
    public function showAdminLoginForm()
    {
        return view('authguard::auth.login', ['url' => 'admin']);
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/admin')->withSuccess('authguard::admin.messages.success.login');
        }

        return back()->withInput($request->only('email', 'remember'))->withErrors('Credentials are not match.');
    }

    // Show Customer Login Page
    public function showCustomerLoginForm()
    {
        return view('authguard::auth.login', ['url' => 'customer']);
    }

    public function customerLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/customer')->withSuccess('authguard::customer.messages.success.login');
        }

        return back()->withInput($request->only('email', 'remember'))->withErrors('Credentials are not match.');
    }
}
