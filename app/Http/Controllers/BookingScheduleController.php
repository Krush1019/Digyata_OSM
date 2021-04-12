<?php

namespace App\Http\Controllers;

use App\client_user\OrderManage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class BookingScheduleController extends Controller {

    public function __construct() {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $breadcrumbs = [['link' => "admin-dashboard", 'name' => "Home"], ['name' => "Booking Schedule"]];
        return view('/pages/booking-schedule', [
            'breadcrumbs' => $breadcrumbs
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

    }

    /**
     * Display the specified resource.
     *
     * @param \App\OrderManage $orderManage
     * @return \Illuminate\Http\Response
     */
    public function show(OrderManage $orderManage, Request $request) {

        $sql = "SELECT * FROM tbl_order_manages AS tbl_om";
        $sql .= " INNER JOIN tbl_ser_list AS tbl_ser ON tbl_ser.ser_id = tbl_om.ser_list_id";
        $sql .= " INNER JOIN tbl_service_catalogs AS tbl_ser_cat ON tbl_ser_cat.id = tbl_ser.ser_cat_id";
        $sql .= " INNER JOIN tbl_user_manage AS tbl_user ON tbl_user.id = tbl_om.user_id";
        $sql .= " INNER JOIN tbl_client_manage AS tbl_client ON tbl_client.id = tbl_om.client_id";
        if($request->action == "search"){
            $sql .= " WHERE tbl_om.sOrderId LIKE '%".$request->text."%' OR tbl_user.sUserID LIKE '%".$request->text."%' OR tbl_client.sClientID LIKE '%".$request->text."%'";
        }
        $sql .= " ORDER BY bPayStatus = 0 OR bSerStatus = 0 DESC";

        $data = DB::select($sql);

        $newData = []; $i = 0;
        foreach($data as $row){
            $id = encrypt($row->sOrderId);
            if($i > 199)
                if($row->bPayStatus == 1 && $row->bSerStatus == 1)
                    break;


            $payStatus = ($row->bPayStatus == 0) ? "Pending" : "Completed";
            $serStatus = ($row->bSerStatus == 0) ? "Pending" : "Completed";
            $arr = array(
                "#" => $i+1,
                "order-id" => $row->sOrderId,
                "service-name" => $row->serviceName,
                "service-provider" => array('clientName'=>$row->sClName, "clientImg"=>$row->sClPhotoURL),
                "user-name" => array('userName'=>$row->sUserName, "userImg"=>$row->sUserImgURL),
                "service-address" => $row->sAddress,
                "service-timeslot" =>$row->sbDate. " ".$row->sTimeSlot,
                "service-amount" => $row->sAmount,
                "payment-status" => $payStatus,
                "service-status" => $serStatus,
            );
            $newData[$i] = $arr; $i++;
        }
        return json_encode($newData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\OrderManage $orderManage
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderManage $orderManage) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\OrderManage $orderManage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderManage $orderManage) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\OrderManage $orderManage
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderManage $orderManage) {
        //
    }

    private function getOrderID($col_name){
        date_default_timezone_set('Asia/Kolkata');
        newOrderID:
            $id = date("ymdH").rand(1000,9999);
        $count = OrderManage::where($col_name,$id)->count();
        if($count == 0)
            return $id;
        else
            goto newOrderID;
    }
}
