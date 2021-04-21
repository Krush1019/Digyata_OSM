<?php

namespace App\Http\Controllers;

use App\UserManage;
use Illuminate\Http\Request;

class UserManageController extends Controller {

    public function __construct() {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $breadcrumbs = [['link' => "admindashboard", 'name' => "Home"], ['name' => "User Manage"]];
        return view('/pages/user-manage', [
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
     * @param  \App\UserManage  $userManage
     * @return \Illuminate\Http\Response
     */
    public function show(UserManage $userManage) {
        $data = UserManage::all();
        $newData = []; $i = 0;
        foreach ($data as $row) {
            $id = encrypt($row['id']);
            $temp = array(
                '#' => $i + 1,
                'user-id' => '#'. $row['sUserID'],
                'user-name' =>$row['sUserName'],
                'mobileNo' =>$row['sUserMobile'],
                'email' =>$row['sUserEmail'],
                'user-location' =>$row['sUserLoc'],
                'user-status' => array('text'=>($row['bUserStatus'] == 1) ? 'Active' : 'Inactive', 'id'=>$id),
            );
            $newData[$i] = $temp; $i++;
        }
        return json_encode($newData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserManage  $userManage
     * @return \Illuminate\Http\Response
     */
    public function edit(UserManage $userManage) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserManage  $userManage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserManage $userManage) {
        $id = decrypt($request->id);
        switch ($request->action) {
            case 'status':
                $hasClass = ($request->hasClass == 'true') ? false : true;
                UserManage::where('id', $id)->update([
                    'bUserStatus' => $hasClass
                ]);
                break;
        }
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserManage  $userManage
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserManage $userManage) {
        //
    }

    private function getUserID(){
        newUserID:
        $id = date("ym").rand(1000, 9999);
        $count = UserManage::where('sUserID',$id)->count();
        if($count == 0)
            return $id;
        else
            goto newUserID;
    }
}
