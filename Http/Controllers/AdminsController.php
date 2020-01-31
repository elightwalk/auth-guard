<?php

namespace Elightwalk\AuthGuard\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminsController extends Controller
{
    public function logout() {
        Auth::guard('admin')->logout();
        return redirect('/login/admin')
                ->with('status','Admin has been logged out!');
    }
}
