<?php

namespace App\Http\Controllers\client_user\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientDetailController extends Controller
{
    public function index()
    {
      return view('/pages/client_user/user/client-detail');
    }
}
