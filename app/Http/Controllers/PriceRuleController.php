<?php

namespace App\Http\Controllers;

use App\PriceRule;
use Illuminate\Http\Request;

class PriceRuleController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
      $this->middleware("auth");
    }
    
    public function index() {
        $breadcrumbs = [['link' => "admin-dashboard", 'name' => "Home"], ['name' => "Price Rules"]];
        return view('/pages/price-rules', [
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

    }

    /**
     * Display the specified resource.
     *
     * @param \App\PriceRule $priceRule
     * @return \Illuminate\Http\Response
     */
    public function show(PriceRule $priceRule) {
        $data = PriceRule::where('pr_d_status', 0)
            ->join('tbl_service_catalogs', 'tbl_service_catalogs.id', '=', 'tbl_price_rule.ser_id')
            ->get();
        $newData = []; $i = 0;
        foreach ($data as $user) {
            $id = encrypt($user->pr_id);
            $price_range = $user->serviceMinPrice . " - " . $user->serviceMaxPrice;
            $arr = array(
                '#' => $i + 1,
                'main_id' => $id,
                'price-range'=> $price_range,
                'service-name'=> $user->serviceName,
                'visit-charge-brokrage' => $user->iVisit,
                'service-charge-brokrage' => $user->iService,
                'status' => array('text'=>($user->pr_status == 1) ? "Enable" : "Disable",'id'=>$id)
            );
            $newData[$i] = $arr;
            $i++;
        }

        return json_encode($newData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\PriceRule $priceRule
     * @return \Illuminate\Http\Response
     */
    public function edit(PriceRule $priceRule, $id) {
        $data = PriceRule::where('pr_id', decrypt($id))
            ->join('tbl_service_catalogs', 'tbl_service_catalogs.id', '=' , 'tbl_price_rule.ser_id')
            ->get();
        $newData = array(
            'main_id' => encrypt($data[0]['pr_id']),
            'service_name' => $data[0]['serviceName'],
            'max_price' => $data[0]['serviceMinPrice'],
            'min_price' => $data[0]['serviceMaxPrice'],
            'visit_charge' => $data[0]['iVisit'],
            'service_charge' => $data[0]['iService'],
        );
        return json_encode($newData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\PriceRule $priceRule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PriceRule $priceRule) {
        $id = decrypt($request->id);
        switch ($request->action){
            case 'delete':
                PriceRule::where('pr_id', $id)->update([
                    'pr_d_status' => true
                ]);
                break;

            case 'update':
                PriceRule::where('pr_id', $id)->update([
                    'iVisit' => $request->get('npr_visitbrokrage'),
                    'iService' => $request->get('npr_servicebrokrage'),
                ]);
                break;

            case 'status':
                $hasClass = ($request->hasClass == "true") ? false : true;
                PriceRule::where('pr_id', $id)->update([
                    'pr_status' => $hasClass
                ]);
                break;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\PriceRule $priceRule
     * @return \Illuminate\Http\Response
     */
    public function destroy(PriceRule $priceRule) {

    }
}
