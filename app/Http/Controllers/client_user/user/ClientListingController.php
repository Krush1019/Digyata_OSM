<?php

namespace App\Http\Controllers\client_user\user;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ClientListingController extends Controller
{
    public function index()
    {
      return view('/pages/client_user/user/client-listing');
    }

    public function filter(Request $request){
              try {
                $decrypted = decrypt($request->id);
            } catch (DecryptException $e) {
              return view('/pages/error-404');
            }

    $services = DB::table('tbl_ser_list')
                ->where('ser_cat_id','=' ,$decrypted)
                ->join('tbl_service_catalogs as tsc', 'tbl_ser_list.ser_cat_id', '=', 'tsc.id')
                // ->join('tbl_client_manage as tcm', 'tbl_ser_list.ser_cat_id', '=', 'tcm.id')
                ->Paginate(6);
                // ->get();
    $catalogs = DB::table('tbl_service_catalogs')
                ->get();

            // dd($services);
      return view('/pages/client_user/user/client-listing')->with('services',$services)->with('catalogs',$catalogs);

    }
}
