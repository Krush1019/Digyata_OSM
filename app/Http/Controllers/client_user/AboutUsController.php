<?php

namespace App\Http\Controllers\client_user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index() {
      return view('/pages/client_user/about-us');
    }
}
