<?php

namespace App\Http\Controllers\client_user;

use App\client_user\OrderManage;
use App\Http\Controllers\Controller;
use App\ServiceList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class OrderManageController extends Controller {

    public function __construct() {
        $this->middleware("auth:client");  
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
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
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
}
