<?php

namespace Elightwalk\AuthGuard\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Elightwalk\AuthGuard\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Elightwalk\AuthGuard\Events\ForgotPassword;

class ForgotController extends Controller
{

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

    // Show Admin Forgot Password Page
    public function showAdminForgotPasswordForm()
    {
        return view('authguard::auth.forgot', ['url' => 'admin']);
    }

    public function sendLinkToEmailForAdminForgotPassword(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email|exists:admins,email|unique:password_resets',
            'url'   =>  'required'
        ],[
           'email.unique' => 'Reset link already sended. Please check your email.'
        ]);

        // Send email
        event(new ForgotPassword($request));

        return back()->withInput($request->only('email'))->withSuccess('authguard::forgot.messages.admin.success.sended');
    }

    // Show Customer Forgot Password Page
    public function showCustomerForgotPasswordForm()
    {
        return view('authguard::auth.forgot', ['url' => 'customer']);
    }

    public function sendLinkToEmailForCustomerForgotPassword(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email|exists:customers,email|unique:password_resets',
            'url'   =>  'required'
        ],[
            'email.unique' => 'Reset link already sended. Please check your email.'
         ]);

        // Send email

        return back()->withInput($request->only('email'))->withSuccess('authguard::forgot.messages.customer.success.sended');
    }
}
