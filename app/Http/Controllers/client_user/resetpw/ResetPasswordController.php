<?php

namespace App\Http\Controllers\client_user\resetpw;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function index()
    {
        return view('/auth/passwords/reset-password');
    }
}
