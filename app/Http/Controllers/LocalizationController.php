<?php

namespace App\Http\Controllers;

use App\Localization;
use Illuminate\Http\Request;

class LocalizationController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        $tbl = new Localization();
        $tbl->loc_state = $request->get('loc_State');
        $tbl->loc_location = $request->get('loc_Loc');
        $tbl->loc_agent_email = $request->get('loc_Email');
        $tbl->save();
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Localization  $localization
     * @return \Illuminate\Http\Response
     */
    public function show(Localization $localization) {
        $data = Localization::where('loc_d_status',0)->get();
        $newData = []; $i = 0;
        foreach ($data as $user) {
            $id = encrypt($user->loc_id);
            $arr = array(
                'id' => $i + 1,
                'main_id' => $id,
                'state' => $user->loc_state,
                'city' => $user->loc_location,
                'area-agent' => $user->loc_agent_email,
                'services' => "Estonia",
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
                Localization::where('loc_id',$id)->update([
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
        Localization::where('loc_id',decrypt($id))->delete();
        return true;
    }
}
