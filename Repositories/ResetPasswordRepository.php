<?php

namespace Elightwalk\AuthGuard\Repositories;

use Elightwalk\AuthGuard\Eloquent\PasswordReset;
use Elightwalk\AuthGuard\Facades\ResetPasswordRepositoryInterface;

class ResetPasswordRepository implements ResetPasswordRepositoryInterface
{
    private $passwordReset ;

    public function __construct(PasswordReset $passwordReset)
    {
        $this->passwordReset=$passwordReset;
    }

    public function checkToken($token)
    {
        return $this->passwordReset->token($token)->first();
    }

    public function deleteRow($request)
    {
        return $this->passwordReset->email($request->email)->delete();
    }
}
?>
