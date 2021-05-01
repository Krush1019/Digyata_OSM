<?php

namespace App\Http\Controllers\client_user\client;

use App\ServiceCatalog;
use App\ServiceList;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Crypt;

class ServiceListController extends Controller {


    public function __construct() {
        $this->middleware("auth:client");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        $passArr = array();
        $breadcrumbs = [
			['link' => "/client-dashboard", 'name' => "Dashboard"],
			['link' => "/service-listing", 'name' => "Service Listing"], 
			['name' => "Add Service Listing"]
		];
        $passArr['breadcrumbs'] = $breadcrumbs;

        $passArr['serviceList'] = $this->getServices();

        try{
            $id = decrypt($request->id);
            $data = $this->getServiceData("service", $id);
            if(!empty($data[0]))
                $passArr['serviceData'] = $data[0];

            $where = array(
                ["loc_status", "=", 1],
                ["tbl_service_catalogs.id", "=", decrypt($data[0]['service_id'])]
            );
            $passArr['state'] = $this->getLocationDetail($where, "tbl_localizations.loc_state", "state");

            array_push($where, ["tbl_localizations.loc_state", "=", $data[0]['state']]);
            $passArr['city'] = $this->getLocationDetail($where, "tbl_localizations.loc_location", "city");


        } catch(Exception $e) { }

		return view('/pages/client_user/client/client-add-service-listing', $passArr);
    }

    public function service_listing() {

        // $temp = json_decode(Auth::user(), true);
        // $user = array(
        //     'id' => encrypt($temp['id']),
        //     'email' => $temp['sClEmail'],
        // );
        
        $breadcrumbs = [['link' => "/client-dashboard", 'name' => "Dashboard"], ['name' => "Service Listing"]];

        $data = $this->getServiceData("all", Auth::id());

        return view('/pages/client_user/client/client-service-listing',[
            'breadcrumbs' => $breadcrumbs,
            // 'user'=> $user,
        ])->with("serviceList", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'provider_name' => 'required',
            'ser_exp' => 'required',
            'ser_img' => 'required',
            'ser_doc_no' => 'required',
            'doc_img' => 'required',
        ]);

        $client_id = Auth::id();
        $items = $this->saveItemList($client_id, $request->get('items'));

        $arr = array(
            "client_id" => $client_id,
            "ser_cat_id" => decrypt($request->get('service_id')),
            "ser_pro_name" => trim($request->get('provider_name')),
            "user_ser_exp" => trim($request->get('ser_exp')),
            "ser_dec" => trim($request->get('dec_msg')),

            "ser_phone" => trim($request->get('ser_phone')),
            "ser_email" => trim($request->get('ser_email')),
            "ser_web" => trim($request->get('ser_website')),
            "ser_fb" => trim($request->get('ser_fblink')),
            "ser_tw" => trim($request->get('ser_twlink')),
            "ser_linkedin" => trim($request->get('ser_ldlink')),

            "ser_photo" => $request->get('ser_img'),
            "doc_no" => trim($request->get('ser_doc_no')),
            "doc_image" => $request->get('doc_img'),

            "ser_state" => Crypt::decryptString(trim($request->get('ser_state'))),
            "ser_city" => Crypt::decryptString(trim($request->get('ser_city'))),
            "ser_address" => trim($request->get('ser_address')),
            "pin_no" => trim($request->get('ser_pin_no')),

            "ser_days" => $request->get('days'),
            "ser_time" => $request->get('time'),
            "ser_item_id" => $items
        );

        ServiceList::create($arr);

        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ServiceList  $serviceList
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceList $serviceList, Request $request) {
        $id = decrypt($request->get('id'));
        $data = $this->getServiceData("service", $id);
        return json_encode($data[0]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ServiceList  $serviceList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceList $serviceList) {
        $action = $request->get("action");
        $id = $request->get("id");
        switch ($action) {
      
            case "update":
                $items = $this->saveItemList(Auth::id(), $request->get('items'));
                $arr = array(
                    "ser_cat_id" => decrypt($request->get('service_id')),
                    "ser_pro_name" => trim($request->get('provider_name')),
                    "user_ser_exp" => trim($request->get('ser_exp')),
                    "ser_dec" => trim($request->get('dec_msg')),

                    "ser_phone" => trim($request->get('ser_phone')),
                    "ser_email" => trim($request->get('ser_email')),
                    "ser_web" => trim($request->get('ser_website')),
                    "ser_fb" => trim($request->get('ser_fblink')),
                    "ser_tw" => trim($request->get('ser_twlink')),
                    "ser_linkedin" => trim($request->get('ser_ldlink')),

                    "ser_photo" => $request->get('ser_img'),
                    "doc_no" => trim($request->get('ser_doc_no')),
                    "doc_image" => $request->get('doc_img'),

                    "ser_state" => Crypt::decryptString(trim($request->get('ser_state'))),
                    "ser_city" => Crypt::decryptString(trim($request->get('ser_city'))),
                    "ser_address" => trim($request->get('ser_address')),
                    "pin_no" => trim($request->get('ser_pin_no')),

                    "ser_days" => $request->get('days'),
                    "ser_time" => $request->get('time'),
                    "ser_item_id" => $items
                );
                ServiceList::where("ser_id", decrypt($id))->update($arr);
                break;

            case "status":
                $status = decrypt($request->get('status'));
                $arr = array();
                if ( $status == "Active" ) { $arr['ser_status'] = "Inactive"; }
                else if ( $status == "Inactive" ) { $arr['ser_status'] = "Active"; }
                else { break; }
                ServiceList::where("ser_id", decrypt($id))->update($arr);
                return encrypt($arr['ser_status']);
                break;
        }
        return true;        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ServiceList  $serviceList
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceList $serviceList) {
        //
    }

    public function getLocation (Request $request) {
        $action = $request->get('action');
        switch ($action) {
            case "state":
                $ser_id = decrypt($request->get("service_id"));
                $where = array(
                    ["loc_status", "=", 1],
                    ["tbl_service_catalogs.id", "=", $ser_id]
                );
                $data = $this->getLocationDetail($where, "tbl_localizations.loc_state", $action);
                return json_encode($data);
                break;

            case "city":
                $state = Crypt::decryptString($request->get("state_id"));
                $ser_id = decrypt($request->get("service_id"));
                $where = array(
                    ["loc_status", "=", 1],
                    ["tbl_service_catalogs.id", "=", $ser_id],
                    ["tbl_localizations.loc_state", "=", $state],
                );
                $data = $this->getLocationDetail($where, "tbl_localizations.loc_location", $action);
                return json_encode($data);
                break;
        }
    }

    private function getLocationDetail ($where = array(), $select = "", $action = "") {
        $tbl_loc = "tbl_localizations";
        $tbl_ser = "tbl_service_catalogs";
        $tbl_ser_loc = "tbl_service_localization";

        $data = DB::table($tbl_ser_loc)
            ->select($select)
            ->where($where)
            ->join($tbl_loc, $tbl_loc . ".loc_id", "=", $tbl_ser_loc . ".loc_id")
            ->join($tbl_ser, $tbl_ser . ".id", "=", $tbl_ser_loc . ".ser_id")
            ->groupBy($select)
            ->get();
        $newData = array();
        if($action == "state") {
            foreach ($data as $row) {
                $temp = Crypt::encryptString($row->loc_state);
                $arr = array(
                    "main_id" => $temp,
                    "state" => $row->loc_state
                );
                array_push($newData, $arr);
            }
        } else if($action == "city" ) {
            foreach ($data as $row) {
                $temp = Crypt::encryptString($row->loc_location);
                $arr = array(
                    "main_id" => $temp,
                    "city" => $row->loc_location
                );
                array_push($newData, $arr);
            }
        }

        return $newData;
    }

    /** Get Services Data */
    private function getServices () {
        $data = ServiceCatalog::where("serviceStatus", 1)->get();
        $arr = array();
        foreach ($data as $row) {
            $id = encrypt($row['id']);
            array_push($arr, array(
                "main_id" => $id,
                "ser_name" => $row['serviceName'],
                "ser_cat" => $row['serviceCategory']
            ));
        }
        return $arr;
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
                    "status_id"  => encrypt($row['ser_status'])
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

    /** Save Item List */

    private function saveItemList($user_id, $data) {
        $tbl_name = "tbl_ser_item_price";
        $items = "";
        foreach ($data as $value) {
            $data = array(
            //    'ser_id' => $ser_id,
                'client_id' => $user_id,
                'item_name' => $value['pli_name'],
                'item_des' => $value['pli_desc'],
                'item_price' => (int) $value['pli_price'],
            );
            if(isset($value['item_id'])) {
                $id = decrypt($value['item_id']);
                DB::table($tbl_name)->where("item_id", $id)->update($data);
            } else {
                $id = DB::table($tbl_name)->insertGetId($data);
            }
            $items .=  $id . ", ";
        }
        return $items;
    }

    /** Save Image */
    public function saveImg(Request $request) {
        $path = [];
        if($request->hasFile('ser_img')){
            $imgFile = $request->file('ser_img');
            $path['ser_img'] = $this->saveImgToStorage($imgFile,'images/client/ser_img');
        } 
        if($request->hasFile('ser_doc_img')) {
            $imgFile = $request->file('ser_doc_img');
            $path['doc_img'] = $this->saveImgToStorage($imgFile,'images/client/ser_doc_img');
        }
        return $path;
    }

    private function saveImgToStorage($imgFile, $saveImgPath) {
        $ext = $imgFile->getClientOriginalExtension();
        $newImgName = rand() . '-' . time() . '.' . $ext;
        $imgFile->move(public_path($saveImgPath), $newImgName);
        return $saveImgPath . '/' . $newImgName;
    }
}
