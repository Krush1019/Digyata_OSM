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

              $services = DB::table('tbl_ser_list')
                      ->join('tbl_service_catalogs as tsc', 'tbl_ser_list.ser_cat_id', '=', 'tsc.id')
                      ->Paginate(6);
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

    $services = DB::table('tbl_ser_list')
                // ->where('ser_cat_id','=' ,$decrypted)
                ->join('tbl_service_catalogs as tsc', 'tbl_ser_list.ser_cat_id', '=', 'tsc.id')
                ->Paginate(6);
    $catalogs = DB::table('tbl_service_catalogs')
                ->get();

      return view('/pages/client_user/user/client-listing')->with('services',$services)->with('catalogs',$catalogs)->with('selectId',$decrypted);

    }
}
