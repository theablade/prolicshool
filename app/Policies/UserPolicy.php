<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
     public function accessUser(User $user){
        return $user ->role ==='User';
    }

    public function __construct()
    {
        //
    }
}