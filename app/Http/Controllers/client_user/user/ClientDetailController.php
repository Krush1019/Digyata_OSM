<?php

namespace App\Http\Controllers\client_user\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Encryption\DecryptException;

class ClientDetailController extends Controller
{
    public function index(Request $request)
    {

      try {
        $decrypted = decrypt($request->id);
    } catch (DecryptException $e) {
      return view('/pages/error-404');
    }
    
    $services = DB::table('tbl_ser_list')
                ->where('ser_id', '=', $decrypted)
                ->join('tbl_service_catalogs as tsc', 'tbl_ser_list.ser_cat_id', '=', 'tsc.id')
                ->join('tbl_client_manage as tcm', 'tbl_ser_list.ser_cat_id', '=', 'tcm.id')
                ->first();

    $items = DB::table('tbl_ser_item_price')
                ->where('ser_id', '=', $decrypted)
                ->get();
      return view('/pages/client_user/user/client-detail')->with('service',$services)->with('items',$items);
    }
}
