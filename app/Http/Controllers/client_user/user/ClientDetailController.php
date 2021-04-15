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

    $reviews = ReviewOrders::get();
    
    $r1 = round(($reviews->sum('Res_R1')/ $reviews->count('Res_R1')),1);
    $r2 = round(($reviews->sum('Ser_R2')/ $reviews->count('Ser_R2')),1);
    $r3 = round(($reviews->sum('Com_R3')/ $reviews->count('Com_R3')),1);
    $r4 = round(($reviews->sum('Price_R4')/ $reviews->count('Price_R4')),1);

    $r5 =round((( $r1 + $r2 + $r3 + $r4 )/4),1);
  
    $rev_user = DB::table('tbl_review_orders')
                ->join('tbl_user_manage', 'tbl_review_orders.uID', '=', 'tbl_user_manage.id')
                ->get();
    
    // dd($rev_user[2]->sUserName);
   
      return view('/pages/client_user/user/client-detail')->with('service',$services)->with('items',$items)->with('reviews',$reviews)->with('rev_user',$rev_user)->with('i',0)->with('R1',$r1)->with('R2',$r2)->with('R3',$r3)->with('R4',$r4)->with('R5',$r5);
    
    }  

}
