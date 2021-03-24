<?php

namespace App\Http\Controllers\client_user\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfirmOrderController extends Controller
{
  public function __construct()
    {
      $this->middleware("auth:customer");
    }
    
    public function index()
    {
      return view('/pages/client_user/user/user-confirm-order');
    }
}
