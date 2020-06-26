<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\LoginService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private $service;

    public function __construct(LoginService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('admin.login');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        return $this->service->login($request->get('username'), $request->get('password'));
    }
}
