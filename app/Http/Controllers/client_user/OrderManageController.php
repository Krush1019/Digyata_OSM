<?php

namespace App\Http\Controllers\client_user;

use App\client_user\OrderManage;
use App\Http\Controllers\Controller;
use App\ServiceList;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Cookie;
use App\client_user\UserManage;


class OrderManageController extends Controller {

    public function __construct() {
        $this->middleware("auth:client")->except(['store','create']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        // $sql = DB::table('tbl_order_manages')
        //     ->join('tbl_service_catalogs', 'tbl_order_manages.ser_id', '=', 'tbl_service_catalogs.id')
        //     ->join('tbl_client_manage', 'tbl_order_manages.cl_ID', '=', 'tbl_client_manage.id')
        //     ->join('tbl_user_manage', 'tbl_order_manages.uID', '=', 'tbl_user_manage.id')
        //     ->get();

        // $sql2 = DB::table('tbl_order_manages')
        //     ->join('tbl_user_ser_item_price', 'tbl_order_manages.i_id', '=', 'tbl_user_ser_item_price.ser_id')
        //     ->get();

        // // $total = DB::table('tbl_user_ser_item_price')->where('ser_id' '=' '{{ $sql2-> }}')->sum('balance');

        // $order = OrderManage::all();

        $orderList = $this->getOrderList(Auth::id());

        // echo "<pre>";
        // print_r($orderList);

        $breadcrumbs = [['link' => "/client-dashboard", 'name' => "Dashboard"], ['name' => "Order Manage"]];

        return view('/pages/client_user/client/client-order-manage', [
            'breadcrumbs' => $breadcrumbs,
            'orderList'=>$orderList,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {

        $request->validate([
          'state' => 'required',
          'city' => 'required',
          'address1' => 'required',
          'address2' => 'required',
          'pincode' => 'required|digits:6|integer'
      ]);
        $address = $request->address1 .', '. $request->address2 .', '. $request->city .', '. $request->state .' - '. $request->pincode;
        $date = date_create_from_format('d-m-Y', $request->cookie('date'));
        $selected_time = $request->cookie('selected_time');
        $services = json_decode($request->cookie('services'));
        $itm = "";
        $amount = 0;
          foreach ($services as $key => $value) {
            $services[$key] = decrypt($value);
            if (!$itm) {
              $itm = decrypt($value);
            }else {
              $itm = $itm .", ". decrypt($value);
            }
          }
          $item = DB::table('tbl_ser_item_price')
                ->whereIn('item_id', $services)
                ->get();
                foreach ($item as $raw) {
                  if (!$amount) {
                    $amount = (int)$raw->item_price;
                  }else {
                    $amount = (int)$amount + (int)$raw->item_price;
                  }
                }
          $cl_id =  DB::table('tbl_ser_list')
                        ->select('client_id')
                        ->where('ser_id', '=', decrypt($request->id))
                        ->first();
        $data = array(
          "sOrderId" => $this->getGenerateID('sOrderId'),
          "client_id" => $cl_id->client_id,
          "user_id" => Auth::guard('customer')->user()->id,
          "ser_list_id" => decrypt($request->id),
          "ser_item_id" => $itm,
          "sbDate" => $date,
          "sAddress" => $address,
          "sTimeSlot" => $selected_time,
          "sAmount" => $amount
      );
      $usr_address = array(
        'sUserHouseNo' => $request->address1,
        'sUserArea' => $request->address2,
        'sUserCity' => $request->city,
        'sUserState' => $request->state,
        'sUserPincode' => $request->pincode,
      );
      UserManage::where('id', Auth::guard('customer')->user()->id)->update($usr_address);
      $raw = OrderManage::create($data);
      Cookie::queue(Cookie::forget('date'));
      Cookie::queue(Cookie::forget('selected_time'));
      Cookie::queue(Cookie::forget('services'));
      return redirect(route('confirm.msg',['id'=>encrypt($raw->sOrderId)]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $request->validate([
          'date' => 'required',
          'selected_time' => 'required',
          'services' => 'required'
      ]);
      $cookie1 = cookie('date', $request->date);
      $cookie2 = cookie('selected_time', $request->selected_time);
      $cookie3 = cookie('services', json_encode($request->services));
      return redirect(route('confirm-order',['id'=>$request->id]))->cookie($cookie1)->cookie($cookie2)->cookie($cookie3);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderManage  $orderManage
     * @return \Illuminate\Http\Response
     */
    public function show(OrderManage $orderManage, Request $request) {
        $id = $request->get('id');
        $action = $request->get('action');
        switch ($action){
            case 'Detail' :
                $data = $this->getClientOrderDetali(Auth::id(), decrypt($id));
                return $data;
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderManage  $orderManage
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderManage $orderManage) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderManage  $orderManage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderManage $orderManage) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderManage  $orderManage
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderManage $orderManage) {
        //
    }

    /** Get Order Detail */
    private function getClientOrderDetali($client_id, $order_id) {

        $tbl_order_manage = "tbl_order_manages";
        $tbl_ser_list = "tbl_user_ser_list";
        $tbl_user = "tbl_user_manage";
        $tbl_client = "tbl_client_manage";

        $where = [
            ['client_id', $client_id,],
            ['order_id', $order_id]
        ];

        $data = OrderManage::where($where)
                    ->join($tbl_ser_list, $tbl_ser_list.'.ser_id', '=', $tbl_order_manage.'.ser_list_id')
                    ->join($tbl_user, $tbl_user.".id", "=", $tbl_order_manage.".user_id")
                    ->join($tbl_client, $tbl_client.".id", "=", $tbl_order_manage.".client_id")
                    ->get();

        $data = $data[0];
        $newData = array (
            // Order Info
            "provider_name" => $data["ser_pro_name"],
            "service_status" => $data["bSerStatus"],
            "order_id" => $data['sOrderId'],
            "service_name" => "Service Name",
            "service_cat" => "Service Cat.",
            "booking_date" => $data["sbDate"],
            "booking_time" => $data["sTimeSlot"],
            "city" => "Mahesana - Gujarata",
            "address" => $data["sAddress"],

            //User Info
            "user_id" => $data["sUserID"],
            "user_name" => $data["sUserName"],
            "user_email" => $data["sUserEmail"],
            "user_phone" => $data["sUserMobile"],

            //Client Info
            "client_id" => $data["sClientID"],
            "client_name" => $data["sClName"],
            "client_email" => $data["sClEmail"],

            //Item
            "payment_status" => $data["bPayStatus"],
            "items" =>$data["ser_item_id"],
            "oAmount" => $data["sAmount"]
        );
        return $newData;
    }

    /** Get Order List */
    private function getOrderList($id) {
        $data = OrderManage::where("client_id", $id)->get();
        $arr = array();
        foreach ($data as $value) {
           $serviceData =  $this->getServiceData($value['ser_list_id']);
            array_push($arr, array(
                "main_id" => encrypt($value['order_id']),
                "order_id" => $value['sOrderId'],
                "service_name" => $serviceData['ser_pro_name'],
                "service_img" => $serviceData['ser_photo'],
                "booking_date" => $value['sbDate'],
                "booking_time" => $value['sTimeSlot'],
                "amount" => $value['sAmount'],
                "address" => $value['sAddress'],
                "payment_status" => $value['bPayStatus'],
                "ser_status" => $value['bSerStatus'],
            ));
        }
        return $arr;
    }

    /** Get Service Data */
    private function getServiceData($ser_id) {
        $data = ServiceList::where("ser_id", $ser_id)->get();
        return json_decode($data[0], true);
    }

    // Generate ID
    private function getGenerateID($col_name){

      newGenerateID:
      $id = date('ym').rand(100000, 999999);
      $count = OrderManage::where($col_name, $id)->count();
      if($count == 0)
          return $id;
      else
          goto newGenerateID;
  }
}
