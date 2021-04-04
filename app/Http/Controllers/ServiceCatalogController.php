<?php

namespace App\Http\Controllers;

use App\Localization;
use App\PriceRule;
use Illuminate\Http\Request;
use App\ServiceCatalog;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\True_;
use Validator;

class ServiceCatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $services = ServiceCatalog::all();

        $breadcrumbs = [
            ['link' => "admin-dashboard", 'name' => "Home"], ['name' => "Service Catalog"]
        ];

        return view('/pages/service-catalog', [
            'breadcrumbs' => $breadcrumbs,
            'services' => $services
        ]);
    }

    public function retrive(Request $request)
    {
        $services = ServiceCatalog::all();
        return $services;
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tbl = new ServiceCatalog();
        $request->validate([
            'serviceName' => 'required',
            'serviceCategory' => 'required',
            'serviceMinPrice' => 'required',
            'serviceMaxPrice' => 'required'
        ]);
        $tbl->serviceName = $request->get('serviceName');
        $tbl->serviceCategory = $request->get('serviceCategory');
        $tbl->serviceDescription = $request->get('serviceDescription');
        $tbl->serviceMinPrice = $request->get('serviceMinPrice');
        $tbl->serviceMaxPrice = $request->get('serviceMaxPrice');
        $tbl->save();
        $this->savePriceRule($tbl->id);
        $this->addLocatization($tbl->id);
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        switch ($request->action) {
            case "service":
                $rules = array(
                    'serviceName' => 'required',
                    'serviceCategory' => 'required',
                    'serviceMinPrice' => 'required',
                    'serviceMaxPrice' => 'required'
                );
                $id = $request->id;
                $tmp = $request->all();
                $error = Validator::make($tmp, $rules);
                if ($error->fails()) {
                    return response()->json(['errors' => $error->errors()->all()]);
                }
                unset($tmp['id']);
                unset($tmp['_token']);
                unset($tmp['action']);
                ServiceCatalog::where('id', $id)->update($tmp);
                break;
            case "status":
                $tmp = ServiceCatalog::where('id', $request->id)->get();
                if (!$tmp[0]['serviceStatus']) {
                    ServiceCatalog::where('id', $request->id)->update(['serviceStatus' => true]);
                    return true;
                } else {
                    ServiceCatalog::where('id', $request->id)->update(['serviceStatus' => false]);
                    return false;
                }
                break;
            case "status-enable":
                $tmp = ServiceCatalog::where('id', $request->id)->get();
                ServiceCatalog::where('id', $request->id)->update(['serviceStatus' => true]);
                return true;
                break;
            case "status-disable":
                $tmp = ServiceCatalog::where('id', $request->id)->get();
                ServiceCatalog::where('id', $request->id)->update(['serviceStatus' => false]);
                return true;
                break;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        ServiceCatalog::where('id', $request->id)->delete();
        return true;
    }

    /** Insert Localization */
    private function addLocatization ($ser_id) {
        $tbl_name = "tbl_service_localization";
        $locData = Localization::all();
        foreach ($locData as $row) {
            DB::table($tbl_name)->insert([
                "loc_id" => $row['loc_id'],
                "ser_id" => $ser_id
            ]);
        }
    }

    private function savePriceRule($id) {
        $tbl = new PriceRule();
        $tbl->ser_id = $id;
        $tbl->save();
        return true;
    }
}
