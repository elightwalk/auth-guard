<?php

namespace Elightwalk\AuthGuard\Repositories;

use Elightwalk\AuthGuard\Eloquent\Customers;
use Elightwalk\AuthGuard\Facades\CustomerRepositoryInterfaca;

class CustomerRepository implements CustomerRepositoryInterfaca
{
    private $customer ;

    public function __construct(Customers $customer)
    {
        $this->customer=$customer;
    }

    public function updatePassword($request)
    {
        $customer = $this->customer->email($request->email)->first();

        $customer->password = bcrypt($request->new_password);
        $customer->save();

        return;
    }
}
?>
