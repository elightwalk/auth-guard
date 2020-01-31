<?php

namespace Elightwalk\AuthGuard\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CustomersController extends Controller
{
    //
    public function logout() {
        Auth::guard('customer')->logout();
        return redirect('/login/customer')
                ->with('status','Customer has been logged out!');
    }
}
