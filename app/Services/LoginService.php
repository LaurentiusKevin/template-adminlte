<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    public function __construct()
    {
    }

    public function login($username,$password)
    {
        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            return 'success';
        } else {
            return 'failed';
        }
    }
}
