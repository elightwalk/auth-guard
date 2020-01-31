<?php

namespace Elightwalk\AuthGuard\Listeners;

use Elightwalk\AuthGuard\Events\ForgotPassword;
use Elightwalk\AuthGuard\Eloquent\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Elightwalk\AuthGuard\Emails\ResetPasswordEmail;
use Illuminate\Support\Facades\Crypt;

class NotifyForgotPassword
{

    private $passwordReset;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(PasswordReset $passwordReset)
    {
        $this->passwordReset = $passwordReset;
    }

    /**
     * Handle the event.
     *
     * @param ForgotPassword $event
     * @return void
     */
    public function handle(ForgotPassword $event)
    {

        if (isset($event)) {

            $email = $event->data->email;

            //create Token
            $token = Crypt::encrypt($email);
            $event->data->url .= '/'.$token;

            // insert Data
            $this->passwordReset::create([
                'email'=>$email,
                'token'=>$token
            ]);

            // Send Email
            Mail::to($email)
                ->send(new ResetPasswordEmail($event->data));
        }
        return ;
    }
}
