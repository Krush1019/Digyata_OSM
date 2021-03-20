<?php

namespace App\Http\Controllers;

use App\DiscountPromo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiscountPromoController extends Controller
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
    
    public function index() {
      $breadcrumbs = [['link'=>"admin-dashboard",'name'=>"Home"], ['name'=>"Discount & Promo Code"]];
      return view('/pages/discount-promocode', [
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
     * @return bool
     */
    public function store(Request $request)
    {
      $request->validate([
        'pmc_Name' => 'required',
        'pmc_Discount' => 'required',
        'pmc_MinAmt' => 'required',
        'pmc_Type' => 'required'
      ]);

      $tbl = new DiscountPromo();
      $tbl->sdpc_name = $request->get('pmc_Name');
      $tbl->fdpc_discount = $request->get('pmc_Discount');
      $tbl->fdpc_minAmount = $request->get('pmc_MinAmt');
      $tbl->sdpc_type = $request->get('pmc_Type');
      $tbl->save();
      return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DiscountPromo  $discountPromo
     * @return \Illuminate\Http\Response
     */
    public function show(DiscountPromo $discountPromo)
    {
        $data = DiscountPromo::where('bdpc_d_status', 0)->get();
        $newData = []; $i = 0;
        foreach ($data as $user){
          $id = encrypt($user->dpc_Id);
          $arr = array(
            '#' => $i + 1,
            'main_id' => $id,
            'promocode-name'=> $user->sdpc_name,
            'promo-type'=> $user->sdpc_type,
            'discount'=>$user->fdpc_discount,
            'min-amount'=>$user->fdpc_minAmount,
            'status'=>array('text'=>($user->bdpc_status == 1) ? "Enable" : "Disable",'id'=>$id)
          );
          $newData[$i] = $arr;
          $i++;
        }
        return json_encode($newData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DiscountPromo  $discountPromo
     * @return \Illuminate\Http\Response
     */
    public function edit(DiscountPromo $discountPromo, $id)
    {
      $data = DiscountPromo::where('dpc_Id', decrypt($id))->get();
//      $newData = array(
//        'main_id' => encrypt($data[0]['dpc_Id']),
//        'promocode-name' => $data[0]['sdpc_name'],
//        'promo-type' => $data[0]['sdpc_type'],
//        'discount' => $data[0]['fdpc_discount'],
//        'min-amount' => $data[0]['fdpc_minAmount'],
//      );
//      return json_encode($newData);
        return json_encode($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DiscountPromo  $discountPromo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DiscountPromo $discountPromo)
    {
      $id = decrypt($request->id);
      switch ($request->action){
        case 'update':
          $request->validate([
            'pmc_Name' => 'required',
            'pmc_Discount' => 'required',
            'pmc_MinAmt' => 'required',
            'pmc_Type' => 'required'
          ]);
          DiscountPromo::where('dpc_Id',$id)->update([
            'sdpc_name' => $request->get('pmc_Name'),
            'fdpc_discount' => $request->get('pmc_Discount'),
            'fdpc_minAmount' => $request->get('pmc_MinAmt'),
            'sdpc_type' => $request->get('pmc_Type')
          ]);
          break;

        case 'delete':
          DiscountPromo::where('dpc_Id',$id)->update([
            'bdpc_d_status' => true
          ]);
          break;

        case 'status':
          $hasClass = ($request->hasClass == "true") ? false : true;
          DiscountPromo::where('dpc_Id',$id)->update([
            'bdpc_status'=>$hasClass
          ]);
          break;

      }
      return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DiscountPromo  $discountPromo
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiscountPromo $discountPromo, $id)
    {
        DiscountPromo::where('dpc_Id',decrypt($id))->delete();
        return true;
    }
}
