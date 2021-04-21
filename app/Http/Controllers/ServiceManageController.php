<?php

namespace App\Http\Controllers;

use App\ServiceManage;
use App\Http\Controllers\Controller;
use App\ServiceList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceManageController extends Controller {


    public function __construct() {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $breadcrumbs = [['link' => "admin-dashboard", 'name' => "Home"], ['name' => "Service Manage"]];
        return view('/pages/service-manage', [
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ServiceManage  $serviceManage
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceManage $serviceManage) {
        $tbl_ser_cat = "tbl_service_catalogs";
        $tbl_ser_list = "tbl_ser_list";
        $tbl_client = "tbl_client_manage";
        $data = ServiceList::
                    join( $tbl_ser_cat, $tbl_ser_cat . ".id", "=", $tbl_ser_list . ".ser_cat_id" )
                    ->join( $tbl_client, $tbl_client . ".id", "=", $tbl_ser_list . ".client_id" )
                    ->orderBy('ser_status', 'DESC')
                    ->get();
        
        

        $newArr = []; $i =1;
        foreach ($data as $value) {
            $id = encrypt($value['ser_id']);
            array_push($newArr, array(
                "#" => $i++,
                "main_id" => $id, 
                "shop-name" => array( "name" => $value['ser_pro_name'], "img" => $value['ser_photo'] ),
                "service-name" => $value['serviceName'],
                "category" => $value['serviceCategory'],

                "client-id" => "#" . $value['sClientID'],
                "client-name" => $value['sClName'],
                "location" => $value['ser_city'] . " - " . $value['ser_state'],
                "experience" => $value['user_ser_exp'],
                "avalibility" => $value['ser_days'],

                "mobileNo" => $value['sClMobile'],
                "email" => $value['sClEmail'],

                "IDProof" => array( "name" => "Document" , "url" => $value['doc_image'] ),
                "client-status" => array( "val" => $value['ser_status'], "id" => $id ),
                "approval" => array( "val" => $value['ser_status'], "id" => $id ),
                "transactions" => array("id" => $id),
            ));
        }
        
        return json_encode($newArr);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ServiceManage  $serviceManage
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceManage $serviceManage) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ServiceManage  $serviceManage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceManage $serviceManage) {
        $action = $request->get("action");
        switch ($action) {

            case "status": 
                $data_action = $request->get("data_action");
                $status = "";
                switch ($data_action) {

                    case "Approve": $status = "Active"; break;
                    case "Active": $status = "Blocked"; break;
                    case "Blocked": $status = "Active"; break;
                    default: $status = "Rejected"; break;
                }
                $data = array(
                    "ser_status" => $status,
                );
                ServiceList::where("ser_id", decrypt($request->get("main_id")))->update($data);
                return $this->countServiceList();
                break;

            default:
                break;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ServiceManage  $serviceManage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceManage $serviceManage) {
        //
    }

    public function showServiceList (Request $request) {
        $id = decrypt( $request->get('id') ); 
        $data = $this->getServiceData("service", $id);
        return json_encode($data[0]);
    }

    /** Fetch Service Data */
    private function getServiceData($action = "all", $id) {

        $where = array();
        if($action == "service") {
            array_push($where, array("ser_id", $id));
        } else {
            array_push($where, array("client_id", $id));
        }

        $serData = ServiceList::where($where)->get();

        $data = [];
        if(!empty($serData)){
            foreach($serData as $row) {
        
                $itemData = $this->getItemData($row['ser_item_id'], $row['client_id']);
                $service_cat = DB::table("tbl_service_catalogs")->where("id",$row['ser_cat_id'])->get();
                $service_cat = json_decode($service_cat,true);

                $id = encrypt($row['ser_id']);
                $arr = array(
                    "main_id" => $id,
                    "name" => $row['ser_pro_name'],
                    "exp" => $row['user_ser_exp'],
                    "service_id" => encrypt($service_cat[0]['id']),
                    "service_name" => $service_cat[0]['serviceName'],
                    "service_cat" => $service_cat[0]['serviceCategory'],
                    "dec" => $row['ser_dec'],
                    "phone" => $row['ser_phone'],
                    "email" => $row['ser_email'],
    
                    "web" => $row['ser_web'],
                    "fb" => $row['ser_fb'],
                    "tw" => $row['ser_tw'],
                    "linkedin" => $row['ser_linkedin'],
                    "insta" => "instagram.com",
    
                    "img" => $row['ser_photo'],
                    "doc_num" => $row['doc_no'],
                    "doc_img" => $row['doc_image'],

                    "state" => $row['ser_state'],
                    "city" => $row['ser_city'],
                    "address" => $row['ser_address'],
                    "pin_code" => $row['pin_no'],

                    "days" => $row['ser_days'],
                    "days_time" => $row['ser_time'],
                    "item" => $itemData,
                    "status" => $row['ser_status'],   
                );
                array_push($data, $arr);
            }    
        }
        
        return $data;
    }

    /** Fetch Item of Service Data */

    private function getItemData($items) {
        $items = explode( ",", $items);
        $data = array();
        foreach ( $items as $item ) {
            if (trim($item) != "") {
                $temp = json_decode(
                    DB::table('tbl_ser_item_price')->where("item_id", $item)->get(),
                    true
                );
                $id  = encrypt($temp[0]['item_id']);
                array_push($data, array(
                    "iID" => $id,
                    "iName" => $temp[0]['item_name'],
                    "iDes" => $temp[0]['item_des'],
                    "iPrice" => $temp[0]['item_price'],
                ));
            }

        }
        return $data;
    }

    /** Count Pendding Service List */
    private function countServiceList() {
        $count = ServiceList::where( "ser_status", "Pending" )->count();
        return ( $count > 0 ) ? $count : "" ;
    }

}
