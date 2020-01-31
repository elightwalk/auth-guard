<?php

namespace Elightwalk\AuthGuard\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Elightwalk\AuthGuard\Repositories\ResetPasswordRepository;
use Elightwalk\AuthGuard\Repositories\AdminRepository;
use Elightwalk\AuthGuard\Repositories\CustomerRepository;
use Auth;


class ResetPasswordController extends Controller
{
    use AuthenticatesUsers;

    private $resetPassword;
    private $admin;
    private $customer;

    public function __construct(ResetPasswordRepository $resetPassword, AdminRepository $admin, CustomerRepository $customer)
    {
        $this->middleware('authguardguest:admin')->except('logout');
        $this->middleware('authguardguest:customer')->except('logout');
        $this->resetPassword = $resetPassword;
        $this->admin = $admin;
        $this->customer = $customer;
    }

    public function showAdminResetPasswordForm($token)
    {
        $checkTokenResponse=$this->resetPassword->checkToken($token);
        return view('authguard::auth.resetpassword', ['url' => 'admin', 'token_response'=> $checkTokenResponse]);
    }

    public function resetPasswordForAdmin(Request $request)
    {
        $this->adminValidator($request->all())->validate();

        $this->admin->updatePassword($request);

        $this->resetPassword->deleteRow($request);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->new_password] )) {

            return redirect()->intended('/admin')->withSuccess('authguard::resetpassword.messages.success.reset_password');
        }

        return ;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function adminValidator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|exists:admins,email|exists:password_resets,email',
            'new_password' => 'required|string|min:6',
            'confirm_password' => 'required|string|min:6|same:new_password'
        ],[
            'email.required' => 'Url is invalid.',
            'email.email' => 'Url is invalid.',
            'email.exists' => 'Url is invalid.'
        ]);
    }

    public function showCustomerResetPasswordForm($token)
    {
        $checkTokenResponse=$this->resetPassword->checkToken($token);
        return view('authguard::auth.resetpassword', ['url' => 'customer', 'token_response'=> $checkTokenResponse]);
    }

    public function resetPasswordForCustomer(Request $request)
    {
        $this->customerValidator($request->all())->validate();

        $this->customer->updatePassword($request);

        $this->resetPassword->deleteRow($request);

        if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->new_password] )) {

            return redirect()->intended('/customer')->withSuccess('authguard::resetpassword.messages.success.reset_password');
        }

        return ;
    }

    protected function customerValidator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|exists:customers,email|exists:password_resets, email',
            'new_password' => 'required|string|min:6',
            'confirm_password' => 'required|string|min:6|same:new_password'
        ],[
            'email.required' => 'Url is invalid.',
            'email.email' => 'Url is invalid.',
            'email.exists' => 'Url is invalid.'
        ]);
    }
}
