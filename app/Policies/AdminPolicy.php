<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{
     
    public function accessAdmin(User $user){
        return $user ->role ==='Admin';
    }

    public function __construct()
    {
        
    }
}