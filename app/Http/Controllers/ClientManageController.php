<?php

namespace App\Http\Controllers;

use App\ClientManage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientManageController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [['link' => "admin-dashboard", 'name' => "Home"], ['name' => "Client Manage"]];
        return view('/pages/client-manage', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClientManage  $clientManage
     * @return \Illuminate\Http\Response
     */
    public function show(ClientManage $clientManage, Request $request)
    {

        if ($request->action == "Pending") {
            return ClientManage::where('sClientStatus', '=', 'Pending')->count();
        } else {
            $data = DB::select('SELECT * FROM tbl_client_manage ORDER BY (sClientStatus = "Pending") DESC, created_at DESC ');

            $newData = [];
            $i = 0;
            foreach ($data as $row) {
                $id = encrypt($row->id);
                $tempArr = array(
                    "#" => $i + 1,
                    "client-id" => '#'.$row->sClientID,
                    "client-name" => $row->sClName,
                    "avatar" => $row->sClPhotoURL,
                    "mobileNo" => $row->sClMobile,
                    "email" => $row->sClEmail,
                    "client-status" => array('val' => $row->sClientStatus, "id" => $id),
                    "approval" => array('val' => $row->sClientStatus, "id" => $id),
                );
                $newData[$i] = $tempArr;
                $i++;
            }
            return json_encode($newData);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClientManage  $clientManage
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientManage $clientManage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClientManage  $clientManage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientManage $clientManage)
    {
        $id = decrypt($request->id);
        switch ($request->action) {
            case 'status':
                switch ($request->status) {
                    case "Approve":
                        $status = "Active";
                        break;

                    case "Rejected":
                        $status = "Rejected";
                        break;

                    case "Active":
                        $status = "Active";
                        break;

                    default:
                        $status = "Blocked";
                        break;
                }
                ClientManage::where('id', $id)->update([
                    "sClientStatus" => $status
                ]);
                break;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientManage  $clientManage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientManage $clientManage)
    {
        //
    }

    private function getClientID($col_name)
    {
        newClientID:
        $id = date('ym') . rand(1000, 9999);
        $count = ClientManage::where($col_name, $id)->count();
        if ($count == 0)
            return $id;
        else
            goto newClientID;
    }
}
