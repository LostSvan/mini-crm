<?php

namespace App\Repositories\Customer;

use App\Models\Customer;

class CustomerRepository
{
    public function firstOrCreate($phone, $name, $email = null)
    {
        $customer = Customer::firstOrCreate(
            ['phone' => $phone], [
           'name' => $name,
           'email' => $email
        ]);

        return $customer;

    }
}
