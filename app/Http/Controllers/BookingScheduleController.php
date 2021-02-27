<?php

namespace App\Http\Controllers;

use App\BookingSchedule;
use Illuminate\Http\Request;
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
        $tbl = new BookingSchedule();
        $tbl->sOrderId = $this->getOrderID("sOrderId");
        $tbl->ser_id = 2;
        $tbl->cl_ID = 2;
        $tbl->uID = 3;
        $tbl->sAddress = "Patan";
        $tbl->sTimeSlot = "10:00am - 2:00 pm";
        $tbl->sAmount = "150";
        $tbl->bPayStatus = 0;
        $tbl->save();

    }

    /**
     * Display the specified resource.
     *
     * @param \App\BookingSchedule $bookingSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(BookingSchedule $bookingSchedule, Request $request) {

        $sql = "SELECT * FROM tbl_booking_schedule AS tbl_bs";
        $sql .= " INNER JOIN tbl_service_catalogs AS tbl_ser ON tbl_ser.id = tbl_bs.ser_id";
        $sql .= " INNER JOIN tbl_user_manage AS tbl_user ON tbl_user.uID = tbl_bs.uID";
        $sql .= " INNER JOIN tbl_client_manage AS tbl_client ON tbl_client.cl_ID = tbl_bs.cl_ID";
        if($request->action == "search"){
            $sql .= " WHERE tbl_bs.sOrderId LIKE '%".$request->text."%' OR tbl_user.sUserID LIKE '%".$request->text."%' OR tbl_client.sClientID LIKE '%".$request->text."%'";
        }
        $sql .= " ORDER BY bPayStatus = 0 OR bSerStatus = 0 DESC";

        $data = DB::select($sql);

        $newData = []; $i = 0;
        foreach($data as $row){
            $id = encrypt($row->bsID);
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
                "service-timeslot" => $row->sTimeSlot,
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
     * @param \App\BookingSchedule $bookingSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(BookingSchedule $bookingSchedule) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\BookingSchedule $bookingSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookingSchedule $bookingSchedule) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\BookingSchedule $bookingSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookingSchedule $bookingSchedule) {
        //
    }

    private function getOrderID($col_name){
        date_default_timezone_set('Asia/Kolkata');
        newOrderID:
            $id = date("ymdH").rand(1000,9999);
        $count = BookingSchedule::where($col_name,$id)->count();
        if($count == 0)
            return $id;
        else
            goto newOrderID;
    }
}
