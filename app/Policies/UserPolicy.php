<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
     public function accessUser(User $user){
        return $user ->email ==='nelson@gmail.com';
    }

    public function __construct()
    {
        //
    }
}