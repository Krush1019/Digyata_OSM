<?php

namespace App\Http\Controllers\client_user\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ClientReviewController extends Controller
{
  public function __construct() {
    $this->middleware("auth:client");
}

    public function index(){
      $reviews = DB::table('tbl_review_orders')
                 ->join('tbl_user_manage as tum', 'tbl_review_orders.uID', '=', 'tum.id')
                 ->get();
                //  dd($reviews);
      $breadcrumbs = [['link' => "/client-dashboard", 'name' => "Dashboard"], ['name' => "Reviews"]];
      return view('/pages/client_user/client/client-review', [
        'breadcrumbs' => $breadcrumbs
      ])->with('reviews',$reviews);
    }
}
