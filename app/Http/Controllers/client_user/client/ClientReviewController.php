<?php

namespace App\Http\Controllers\client_user\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientReviewController extends Controller
{   
  public function __construct() {
    $this->middleware("auth:client");
}

    public function index(){
      $breadcrumbs = [['link' => "/client-dashboard", 'name' => "Dashboard"], ['name' => "Reviews"]];
      return view('/pages/client_user/client/client-review', [
        'breadcrumbs' => $breadcrumbs
      ]);
    }
}
