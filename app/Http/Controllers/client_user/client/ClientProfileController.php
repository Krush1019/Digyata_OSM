<?php

namespace App\Http\Controllers\client_user\client;

use App\client_user\client\ClientProfile;
use Illuminate\Support\Facades\Auth;
use App\client_user\ClientManage;
use App\Http\Controllers\Controller;
use App\ServiceList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function GuzzleHttp\json_decode;

class ClientProfileController extends Controller {

    public function __construct() {
        $this->middleware("auth:client");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function index() {

        $clientData = $this->getClientData(Auth::id());

        $breadcrumbs = [['link' => "/client-dashboard", 'name' => "Dashboard"], ['name' => "My Profile"]];
        return view('/pages/client_user/client/client-profile', [
            'breadcrumbs' => $breadcrumbs,
            'clientData' => $clientData
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
     * @param  \App\client_user\client\ClientProfile  $clientProfile
     * @return \Illuminate\Http\Response
     */
    public function show(ClientProfile $clientProfile) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\client_user\client\ClientProfile  $clientProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientProfile $clientProfile) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\client_user\client\ClientProfile  $clientProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientProfile $clientProfile) {
        $action = $request->action;
        switch($action) {
            case 'detail':
                $data = array(
                    // 'sClName' => trim($request->get('client_fname')) . " " . trim($request->get('client_lname')),
                    'sClName' => trim($request->get('client_name')),
                    'sClEmail' => trim($request->get('client_email')),
                    'sClMobile' => trim($request->get('client_mo')),
                    'sClGender' => trim($request->get('gender')),
                    'sClPhotoURL' => trim($request->get('client_img')),
                );
                ClientManage::where("id", Auth::id())->update($data);
                return redirect(route('client-dashboard'));
                break;

            case 'password':
                $old_password = $request->get("old_password");
                $new_password = $request->get("new_password");

                $current_password = Auth::User()->password;  
                if(Hash::check($old_password, $current_password)) {           
                    $user_id = Auth::User()->id;                       
                    $obj_user = ClientManage::find($user_id);
                    $obj_user->password = Hash::make($new_password);
                    $obj_user->save(); 
                }
                return redirect(route('client-profile'));
                break;

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\client_user\client\ClientProfile  $clientProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientProfile $clientProfile) {
        //
    }

    /** Image Save */
    public function saveImg(Request $request) {
        $path = "";
        if($request->hasFile('client_img')) {
            $imgFile = $request->file('client_img');
            $path = $this->saveImgToStorage($imgFile, 'images/client/profile');
        }
        return $path;
    }

    private function saveImgToStorage($imgFile, $saveImgPath) {
        $ext = $imgFile->getClientOriginalExtension();
        $newImgName = rand() . '-' . time() . '.' . $ext;
        $imgFile->move(public_path($saveImgPath), $newImgName);
        return $saveImgPath . '/' . $newImgName;
    }

    /** Verify Password */
    public function verifyPasswoad(Request $request) {
        $current_password = Auth::User()->password;  
        if(Hash::check($request->get('password'), $current_password)) {           
            return true;
        }else {
            return false;
        }
    }

    /** Get Client Data */
    public function getClientData($client_id) {
        $clientData = json_decode(
            ClientManage::where('id', $client_id)->get(), 
            true
        );
        $clientData = $clientData[0];

        $services = ServiceList::where([
            ["client_id", $client_id],
            ["ser_status", "1"]
        ])->count();

        // $name = explode(" ", $clientData['sClName']);
        $data = array(
            "main_id" => encrypt($clientData["id"]),
            "client_id" => $clientData["sClientID"],
            "name" => $clientData["sClName"],
            // "first_name" =>  $name[0],
            // "last_name" =>  $name[1],
            "client_email" => $clientData["sClEmail"],
            "client_gender" => $clientData["sClGender"],
            "client_phone" => $clientData["sClMobile"],
            "client_address" => $clientData["sClAddress"],
            "client_img" => $clientData["sClPhotoURL"],
            "status" => $clientData["sClientStatus"],
            "services" => $services
        );
        return $data;
    }
}
