<?php

namespace App\Http\Controllers;

use App\Localization;
use App\ServiceCatalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocalizationController extends Controller {

    private  $tbl_ser_loc = "tbl_service_localization";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
      $this->middleware("auth");
    }
    
    public function index() {
        $breadcrumbs = [['link'=>"admin-dashboard",'name'=>"Home"], ['name'=>"Localization"]];
        return view('/pages/localization', [
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
        $request->validate([
            'loc_State' => 'required',
            'loc_Loc' => 'required'
        ]);

        $arr = array(
            "loc_state" => trim($request->get('loc_State')),
            "loc_location" => trim($request->get('loc_Loc')),
            "loc_agent_email" => trim($request->get('loc_Email')),
        );
        $table = Localization::create($arr);
        $this->insertSericeLocation($table->id);
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Localization  $localization
     * @return \Illuminate\Http\Response
     */
    public function show(Localization $localization) {
        $tbl_loc = "tbl_localizations";
        $tbl_ser = "tbl_service_catalogs";
        $data = DB::table($this->tbl_ser_loc)
            ->join($tbl_loc, $tbl_loc . ".loc_id", "=", $this->tbl_ser_loc . ".loc_id")
            ->join($tbl_ser, $tbl_ser . ".id", "=", $this->tbl_ser_loc . ".ser_id")
            ->get();
        $newData = []; $i = 0;
        foreach ($data as $user) {
            $id = encrypt($user->sl_id);
            $loc_id = encrypt($user->loc_id);
            $arr = array(
                'id' => $i + 1,
                'main_id' => $id,
                'location_id' => $loc_id,
                'state' => $user->loc_state,
                'city' => $user->loc_location,
                'area-agent' => $user->loc_agent_email,
                'services' => $user->serviceName,
                'status' => array('text'=>($user->loc_status == 1) ? "Enable" : "Disable",'id'=>$id)
            );
            $newData[$i] = $arr;
            $i++;
        }
        return json_encode($newData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Localization  $localization
     * @return \Illuminate\Http\Response
     */
    public function edit(Localization $localization, $id) {
        $data = Localization::where('loc_id',decrypt($id))->get();
        return json_encode($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Localization  $localization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Localization $localization) {
        $id = decrypt($request->id);
        switch ($request->action){
            case 'update':
                $request->validate([
                    'loc_State' => 'required',
                    'loc_Loc' => 'required'
                ]);
                Localization::where('loc_id',$id)->update([
                    'loc_state'=>$request->get('loc_State'),
                    'loc_location'=>$request->get('loc_Loc'),
                    'loc_agent_email'=>$request->get('loc_Email')
                ]);
                break;

            case 'delete':
                Localization::where('loc_id',$id)->update([
                    'loc_d_status' => true
                ]);
                break;

            case 'status':
                $hasClass = ($request->hasClass == "true") ? false : true;
                DB::table($this->tbl_ser_loc)->where('sl_id', $id) ->update([
                    'loc_status'=>$hasClass
                ]);
                break;

        }
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Localization  $localization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Localization $localization, $id) {
//        Localization::where('loc_id',decrypt($id))->delete();
//        return true;
    }

    /** Insert Service Locatization */
    private function insertSericeLocation($loc_id) {
        $data = ServiceCatalog::all();
        foreach ($data as $row) {
            DB::table($this->tbl_ser_loc)->insert([
                "loc_id" => $loc_id,
                "ser_id" => $row['id']
            ]);
        }
    }
}
