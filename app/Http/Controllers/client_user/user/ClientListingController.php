<?php

namespace App\Http\Controllers\client_user\user;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ClientListingController extends Controller
{
    public function index(Request $request)
    {

              DB::statement("SET SQL_MODE=''");//this is the trick use it just before your query

              $services = DB::table('tbl_ser_list')
                ->join('tbl_service_catalogs', 'tbl_ser_list.ser_cat_id', '=', 'tbl_service_catalogs.id')
                ->leftJoin('tbl_review_orders', 'tbl_ser_list.ser_id', '=', 'tbl_review_orders.ser_id')
                ->select(DB::raw('COUNT(RoID) as revCount, tbl_ser_list.*, tbl_service_catalogs.serviceName'),DB::raw('AVG(Res_R1) as Res_R1, AVG(Ser_R2) as Ser_R2, AVG(Com_R3) as Com_R3, AVG(Price_R4) as Price_R4'))
                ->where('ser_status','=','Active')
                ->groupBy('tbl_ser_list.ser_id')
                ->paginate(6);

              $catalogs = DB::table('tbl_service_catalogs')
                      ->get();

      return view('/pages/client_user/user/client-listing')->with('services',$services)->with('catalogs',$catalogs)->with('selectId',"");
    }

    public function filter(Request $request){
              try {
                $decrypted = decrypt($request->id);
            } catch (DecryptException $e) {
              return view('/pages/error-404');
            }

    DB::statement("SET SQL_MODE=''");//this is the trick use it just before your query
    $services = DB::table('tbl_ser_list')
                ->where('ser_cat_id','=' ,$decrypted)
                ->join('tbl_service_catalogs', 'tbl_ser_list.ser_cat_id', '=', 'tbl_service_catalogs.id')
                ->leftJoin('tbl_review_orders', 'tbl_ser_list.ser_id', '=', 'tbl_review_orders.ser_id')
                ->select(DB::raw('COUNT(RoID) as revCount, tbl_ser_list.*, tbl_service_catalogs.serviceName'),DB::raw('AVG(Res_R1) as Res_R1, AVG(Ser_R2) as Ser_R2, AVG(Com_R3) as Com_R3, AVG(Price_R4) as Price_R4'))
                ->where('ser_status','=','Active')
                ->groupBy('tbl_ser_list.ser_id')
                ->paginate(6);
    $catalogs = DB::table('tbl_service_catalogs')
                ->get();

      return view('/pages/client_user/user/client-listing')->with('services',$services)->with('catalogs',$catalogs)->with('selectId',$decrypted);

    }
}
