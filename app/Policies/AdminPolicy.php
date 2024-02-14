<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{
     
    public function accessAdmin(User $user){
        return $user ->email ==='fmuethea9@gmail.com';
    }

    public function __construct()
    {
        
    }
}