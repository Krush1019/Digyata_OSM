<?php

namespace App\Http\Controllers\client_user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginPageController extends Controller
{
    public function index(){
        return view('/pages/client_user/login-page');
      }
}
