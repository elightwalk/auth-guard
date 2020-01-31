<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Default
Route::middleware(['web', 'authguardguest'])->group(function(){

    Route::view('/', 'authguard::index')->name('home');

    // Login Page
    Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
    Route::post('/login/admin', 'Auth\LoginController@adminLogin');

    Route::get('/login/customer', 'Auth\LoginController@showCustomerLoginForm');
    Route::post('/login/customer', 'Auth\LoginController@customerLogin');

    // Register Page
    Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
    Route::post('/register/admin', 'Auth\RegisterController@createAdmin');

    Route::get('/register/customer', 'Auth\RegisterController@showCustomerRegisterForm');
    Route::post('/register/customer', 'Auth\RegisterController@createCustomer');

    // Forgot Password
    Route::get('/forgot/password/admin', 'Auth\ForgotController@showAdminForgotPasswordForm');
    Route::post('/send/passwordlink/admin', 'Auth\ForgotController@sendLinkToEmailForAdminForgotPassword');

    Route::get('/forgot/password/customer', 'Auth\ForgotController@showCustomerForgotPasswordForm');
    Route::post('/send/passwordlink/customer', 'Auth\ForgotController@sendLinkToEmailForCustomerForgotPassword');

    // Reset Password
    Route::get('/reset/password/admin/{token}', 'Auth\ResetPasswordController@showAdminResetPasswordForm');
    Route::post('/reset/password/admin', 'Auth\ResetPasswordController@resetPasswordForAdmin');

    Route::get('/reset/password/customer/{token}', 'Auth\ResetPasswordController@showCustomerResetPasswordForm');
    Route::post('/reset/password/customer', 'Auth\ResetPasswordController@resetPasswordForCustomer');
});

Route::prefix('admin')->middleware(['web', 'admin'])->group(function(){
    Route::view('/', 'authguard::admin.dashboard');
    Route::get('/logout', 'AdminsController@logout');
});

Route::prefix('customer')->middleware(['web', 'customer'])->group(function(){
    Route::view('/', 'authguard::customer.dashboard');
    Route::get('/logout', 'CustomersController@logout');
});
