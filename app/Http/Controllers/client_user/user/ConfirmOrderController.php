<?php

namespace App\Http\Controllers\client_user\user;

use App\client_user\OrderManage;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ConfirmOrderController extends Controller {

	public function __construct() {
		$this->middleware("auth:customer");
	}

    public function index(Request $request) {
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

	public function getInvoice(Request $request) {

		 try {
             $order_id = $request->order_id;
             $tbl_order = "tbl_order_manages";
             $tbl_client = "tbl_client_manage";
             $tbl_user = "tbl_user_manage";
             $tbl_ser_list = "tbl_ser_list";
             $where = array(
                 [ "sOrderId", "=", trim($order_id) ],
                 [ $tbl_order . ".user_id", "=", Auth::id() ]
             );

             $data = OrderManage::where($where)
                 ->join( $tbl_client, $tbl_client . ".id", "=" ,$tbl_order . ".client_id" )
                 ->join( $tbl_user, $tbl_user . ".id", "=" ,$tbl_order . ".user_id" )
                 ->join( $tbl_ser_list, $tbl_ser_list . ".ser_id", "=" ,$tbl_order . ".ser_list_id" )
                 ->select($tbl_order . ".ser_item_id as user_ser_item", $tbl_order . ".*", $tbl_client . ".*", $tbl_user . ".*", $tbl_ser_list . ".*")
                 ->first();

             $client_email = ( $data["ser_email"] != "" ) ? $data["ser_email"] : $data["sClEmail"];
             $client_phone = ( $data["ser_phone"] != "" ) ? $data["ser_phone"] : $data["sClMobile"];
             $items = $this->getItems($data["user_ser_item"]);
             $arr = array(
                 "invoice_no" => $data['sOrderId'],
                 "invoice_date" => date_format($data['created_at'], "M d, Y"),

                 "user_id" => "# " . $data['sUserID'],
                 "user_name" => $data['sUserName'],
                 "user_address" => $data['sAddress'],
                 "user_email" => $data['sUserEmail'],
                 "user_phone" => $data['sUserMobile'],

                 "service_name" => $data['ser_pro_name'],
                 "service_address" => $data['ser_address'] . "<br/>" . $data['ser_city'] . ", " . $data['ser_state'] . " - " . $data['pin_no'],
                 "client_id" => $data['sClientID'],
                 "client_email" => $client_email,
                 "client_phone" => $client_phone,

                 "items" => $items["data"],
                 "total_amount" => $items["total"]
             );
             return view("/pages/client_user/user/invoice", [
                 "data" => $arr
             ]);

         } catch(Exception $e) {
		 	return redirect(route("user.myorders"));
		 }
	}

	private function getItems($items) {
		$item = explode( ",", $items); $arr = array();
		$tbl_item = "tbl_ser_item_price"; $total = 0; $temp = array();
		foreach ($item as $value) {
			if( !empty(trim($value)) ) {
				$data = DB::table($tbl_item)->where( "item_id", $value )->first();
				array_push( $arr, array(
					"item_id" => encrypt($data->item_id),
					"item_name" => $data->item_name,
					"item_price" => (int) $data->item_price,
				));
				$total = $total + (int) $data->item_price;
			}
		}
		$temp["data"] = $arr; $temp["total"] = $total;
		return $temp;
	}
}
