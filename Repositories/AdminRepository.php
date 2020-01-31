<?php

namespace Elightwalk\AuthGuard\Repositories;

use Elightwalk\AuthGuard\Eloquent\Admins;
use Elightwalk\AuthGuard\Facades\AdminRepositoryInterfaca;

class AdminRepository implements AdminRepositoryInterfaca
{
    private $admin ;

    public function __construct(Admins $admin)
    {
        $this->admin=$admin;
    }

    public function updatePassword($request)
    {
        $admin = $this->admin->email($request->email)->first();

        $admin->password = bcrypt($request->new_password);
        $admin->save();

        return;
    }
}
?>
