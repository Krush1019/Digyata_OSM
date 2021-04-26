<?php

namespace App\Http\Controllers\client_user\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\DB;



class ConfirmOrderController extends Controller
{
  public function __construct()
    {
      $this->middleware("auth:customer");
    }

    public function index(Request $request)
    {
      try {
        $decrypted = decrypt($request->id);
    } catch (DecryptException $e) {
      return view('/pages/error-404');
    }
    $service =DB::table('tbl_ser_list')
              ->where('ser_id', '=', $decrypted)
              ->join('tbl_service_catalogs as tsc', 'tbl_ser_list.ser_cat_id', '=', 'tsc.id')
              ->first();
        
              $ser_id = json_decode($request->cookie('services'));

              foreach ($ser_id as $key => $value) {
                $ser_id[$key] = decrypt($value);
              }
    $items = DB::table('tbl_ser_item_price')
            ->whereIn('item_id', $ser_id)
            ->get();
      return view('/pages/client_user/user/user-confirm-order')->with('service',$service)->with('items',$items);
    }
}
