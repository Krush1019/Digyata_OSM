<?php

namespace App\Http\Controllers\client_user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class indexController extends Controller
{
    public function index(){
      $services = DB::table('tbl_ser_list')
                ->join('tbl_service_catalogs', 'tbl_ser_list.ser_cat_id', '=', 'tbl_service_catalogs.id')
                ->inRandomOrder()
                ->limit(6)
                ->get();
      return view('/pages/client_user/index')->with('services',$services);
    }
}
