<?php

namespace App\Http\Controllers\client_user\client;

use App\ServiceList;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceListController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $breadcrumbs = [
			['link' => "/client-dashboard", 'name' => "Dashboard"],
			['link' => "/service-listing", 'name' => "Service Listing"], 
			['name' => "Add Service Listing"]
		];
		
		$data = DB::table('tbl_service_catalogs')->where('serviceStatus', '1')->get();
		
		if (!$data->count()) 
			$data = null;

		return view('/pages/client_user/client/client-add-service-listing', [
			'breadcrumbs' => $breadcrumbs,
		])->with('serviceData', $data);
    }

    public function service_listing()
    {
      $breadcrumbs = [['link' => "/client-dashboard", 'name' => "Dashboard"], ['name' => "Service Listing"]];
      return view('/pages/client_user/client/client-service-listing', [
        'breadcrumbs' => $breadcrumbs
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $table = new ServiceList();
        
        $table = new ServiceList();
        $table->uID = $request->get('user_id');
        $table->ser_pro_name = $request->get('SL_Ser_shopname');
        $table->user_ser_exp = $request->get('SL_Ser_experience');

        $table->ser_dec = $request->get('dec_msg');

        $table->ser_phone = $request->get('SL_ser_phone');
        $table->ser_email = $request->get('SL_ser_email');
        $table->ser_web = $request->get('SL_ser_website');
        $table->ser_fb = $request->get('SL_ser_fblink');
        $table->ser_tw = $request->get('SL_ser_twlink');
        $table->ser_linkedin = $request->get('SL_ser_ldlink');

        // $table->ser_photo = $request->file('ser_img');
        $table->doc_no = $request->get('SL_Ser_aadharNo');
        $table->doc_image = $request->get('doc_img');

        $table->ser_days = $request->get('days');
        $table->ser_time = $request->get('time');
        $table->save();
        return $request->get('SL_Ser_shopname');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ServiceList  $serviceList
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceList $serviceList) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ServiceList  $serviceList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceList $serviceList) {
        //
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
     * Save Image
     */
    public function saveImg(Request $request) {
        $path = [];
        if($request->hasFile('SL_ser_photos')){
            $imgFile = $request->file('SL_ser_photos');
            $path['ser_img'] = $this->saveImgToStorage($imgFile,'client_user/client/img/ser_img');
        } 
        if($request->hasFile('SL_ser_idproof')) {
            $imgFile = $request->file('SL_ser_idproof');
            $path['doc_img'] = $this->saveImgToStorage($imgFile,'client_user/client/img/ser_doc_img');
        }
        return $path;
    }


    private function saveImgToStorage($imgFile, $saveImgPath){

        $ext = $imgFile->getClientOriginalExtension();
        $newImgName = rand().'-'.time().'.'.$ext;
        $imgFile->move(public_path($saveImgPath), $newImgName);
        return $saveImgPath.'/'.$newImgName;
    }
}
