<?php

namespace App\Http\Controllers\client_user\client;

use App\ServiceList;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;

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
		
		$serviceList = DB::table('tbl_service_catalogs')->where('serviceStatus', '1')->get();
//        $serviceList = json_decode($serviceList, true);
        if (!$serviceList->count())
			$serviceList = null;

        try{
            $id = decrypt($request->id);
            $data = $this->getServiceData("service", $id);
            if(!empty($data[0]))
                $passArr['serviceData'] = $data[0];

        } catch(Exception $e) { }

		return view('/pages/client_user/client/client-add-service-listing', $passArr)->with('serviceList', $serviceList);
    }

    public function service_listing() {

        $temp = json_decode(Auth::user(), true);
        $user = array(
            'id' => encrypt($temp['id']),
            'email' => $temp['sClEmail'],
        );
        
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
            'user_id' => 'required',
            'SL_Ser_shopname' => 'required',
            'SL_Ser_experience' => 'required',
            'ser_img' => 'required',
            'SL_Ser_aadharNo' => 'required',
            'doc_img' => 'required',
        ]);

        $client_id = Auth::id();
        $tbl = new ServiceList();

        $tbl->cl_id = $client_id;
        $tbl->ser_cat_id = $request->get('serviceCat_id');
        $tbl->ser_pro_name = $request->get('SL_Ser_shopname');
        $tbl->user_ser_exp = $request->get('SL_Ser_experience');
        $tbl->ser_dec = $request->get('dec_msg');

        $tbl->ser_phone = $request->get('SL_ser_phone');
        $tbl->ser_email = $request->get('SL_ser_email');
        $tbl->ser_web = $request->get('SL_ser_website');
        $tbl->ser_fb = $request->get('SL_ser_fblink');
        $tbl->ser_tw = $request->get('SL_ser_twlink');
        $tbl->ser_linkedin = $request->get('SL_ser_ldlink');

        $tbl->ser_photo = $request->get('ser_img');
        $tbl->doc_no = $request->get('SL_Ser_aadharNo');
        $tbl->doc_image = $request->get('doc_img');

        $tbl->ser_days = $request->get('days');
        $tbl->ser_time = $request->get('time');
        $tbl->save();
        $this->saveItemList($client_id, $tbl->id, $request->get('items'));
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
                ServiceList::where("ser_id", decrypt($id))->update([
                    //"uID" => $request->get('user_id'),
                    "ser_cat_id" => $request->get('serviceCat_id'),
                    "ser_pro_name" => $request->get('SL_Ser_shopname'),
                    "user_ser_exp" => $request->get('SL_Ser_experience'),
                    'ser_dec' => $request->get('dec_msg'),

                    "ser_phone" => $request->get('SL_ser_phone'),
                    "ser_email" => $request->get('SL_ser_email'),
                    "ser_web" => $request->get('SL_ser_website'),
                    "ser_fb" => $request->get('SL_ser_fblink'),
                    "ser_tw" => $request->get('SL_ser_twlink'),
                    "ser_linkedin" => $request->get('SL_ser_ldlink'),

                    "ser_photo" => $request->get('ser_img'),
                    "doc_no" => $request->get('SL_Ser_aadharNo'),
                    "doc_image" => $request->get('doc_img'),

                    "ser_days" => $request->get('days'),
                    "ser_time" => $request->get('time'),
                ]);
                DB::table("tbl_user_ser_item_price")->where("ser_id", decrypt($id))->delete();
                $this->saveItemList(Auth::id(), decrypt($id), $request->get('items'));
                break;

            case "status":
                $status = ($request->get('status') == "Active") ? true : false ;
                ServiceList::where("ser_id", decrypt($id))->update([
                    "ser_status" => $status,
                ]);
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

    /**
     *  Fetch Service Data
     */
    private function getServiceData($action = "all", $id) {

        $where = array();
        if($action == "service") {
            array_push($where, array("ser_id", $id));
        } else {
            array_push($where, array("cl_id", $id));
        }

        $serData = ServiceList::where($where)->get();

        $data = [];
        if(!empty($serData)){
            foreach($serData as $row) {
        
                $itemData = $this->getItemData($row['ser_id'], $row['cl_id']);
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

    /**
     *  Fetch Item of Service Data
     */

    private function getItemData($ser_id , $cl_id) {
        
        $itemData = DB::table('tbl_user_ser_item_price')->where([
            ["item_status", "=", "1"],
            ["ser_id", "=", $ser_id],
            ["cl_id", "=", $cl_id]
        ])->get();
        $itemData = json_decode($itemData, true);
        $data = [];
        foreach ($itemData as $value) {
            $id = encrypt($value['item_id']);
            $arr = array(
                "iID" => $id,
                "iName" => $value['item_name'],
                "iDes" => $value['item_des'],
                "iPrice" => $value['item_price'],
            );
            array_push($data, $arr);
        }
        return $data;
    }

    /**
     * Save Item List
     */

    private function saveItemList($user_id, $ser_id, $data) {
        $tbl_name = "tbl_user_ser_item_price";
        foreach ($data as $value) {
            $table = DB::table($tbl_name)->insert([
                'ser_id' => $ser_id,
                'cl_id' => $user_id,
                'item_name' => $value['pli_name'],
                'item_des' => $value['pli_desc'],
                'item_price' => $value['pli_price'],
            ]);
        }
    }

    /**
     * Save Image
     */
    public function saveImg(Request $request) {
        $path = [];
        if($request->hasFile('SL_ser_photos')){
            $imgFile = $request->file('SL_ser_photos');
            $path['ser_img'] = $this->saveImgToStorage($imgFile,'images/client/ser_img');
        } 
        if($request->hasFile('SL_ser_idproof')) {
            $imgFile = $request->file('SL_ser_idproof');
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
