<?php

namespace App\Http\Controllers\client_user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class indexController extends Controller
{
    public function index(){
      DB::statement("SET SQL_MODE=''");//this is the trick use it just before your query
      $services = DB::table('tbl_ser_list')
                ->join('tbl_service_catalogs', 'tbl_ser_list.ser_cat_id', '=', 'tbl_service_catalogs.id')
                ->leftJoin('tbl_review_orders', 'tbl_ser_list.ser_id', '=', 'tbl_review_orders.ser_id')
                ->select(DB::raw('COUNT(RoID) as revCount, tbl_ser_list.*, tbl_service_catalogs.*'),DB::raw('AVG(Res_R1) as Res_R1, AVG(Ser_R2) as Ser_R2, AVG(Com_R3) as Com_R3, AVG(Price_R4) as Price_R4'))
                ->inRandomOrder()
                ->limit(6)
                ->groupBy('tbl_ser_list.ser_id')
                ->get();
                // dd($services);
      $catalogs = DB::table('tbl_service_catalogs')
                  ->inRandomOrder()
                  ->limit(6)
                  ->get();
      return view('/pages/client_user/index')->with('services',$services)->with('catalogs',$catalogs);
    }
}
