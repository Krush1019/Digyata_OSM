<?php

namespace App\Http\Controllers\client_user\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Encryption\DecryptException;
use App\ReviewOrders;

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
                $ser_id = array_map('intval', explode(',', $services->ser_item_id));
                array_pop($ser_id);


    $items = DB::table('tbl_ser_item_price')
             ->whereIn('item_id', $ser_id)
             ->get();


    $reviews = DB::table('tbl_review_orders')
                ->where('ser_id','=',$decrypted)
                ->join('tbl_user_manage', 'tbl_review_orders.uID', '=', 'tbl_user_manage.id')
                ->get();

    $avg = DB::table('tbl_review_orders')
          ->where('ser_id','=',$decrypted)
          ->select(DB::raw('AVG(Res_R1) as Res_R1'),DB::raw('AVG(Ser_R2) as Ser_R2'),DB::raw('AVG(Com_R3) as Com_R3'),DB::raw('AVG(Price_R4) as Price_R4'))
          ->first();

          if (auth()->guard('customer')->check()) {
            $usrReview = DB::table('tbl_order_manages')
                        ->join('tbl_review_orders', 'tbl_review_orders.uID', '=', 'tbl_order_manages.user_id')
                        ->where([
                          ['ser_list_id', '=', $decrypted],
                          ['user_id', '=', auth()->guard('customer')->user()->id],
                          ['ser_id', '=', $decrypted],
                        ])->first();
            }else{
              $usrReview="";
            }
            // dd($usrReview);
      return view('/pages/client_user/user/client-detail')->with('service',$services)->with('items',$items)
                                                          ->with('reviews',$reviews)->with('avg',$avg)
                                                          ->with('usrReview',$usrReview);

    }

}
