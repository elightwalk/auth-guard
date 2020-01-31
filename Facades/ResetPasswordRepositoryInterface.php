<?php

namespace Elightwalk\AuthGuard\Facades;

interface ResetPasswordRepositoryInterface
{
    public function checkToken($token);

    public function deleteRow($request);
}

?>
