<?php

namespace App\Http\Controllers\client_user\user;

use Auth;
use Illuminate\Http\Request;
use App\client_user\user\MyOrders;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Encryption\DecryptException;

class MyOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware("auth:customer");
    }

    public function index(Request $request)
    {
        $data = MyOrders::where('user_id', Auth::guard('customer')->user()->id)
            ->join('tbl_ser_list', 'tbl_ser_list.ser_id', '=', 'tbl_order_manages.ser_list_id')
            ->get();

        if (auth()->guard('customer')->check()) {
            $usrReview = DB::table('tbl_order_manages')
                ->join('tbl_review_orders', 'tbl_review_orders.uID', '=', 'tbl_order_manages.user_id')
                ->where([
                    ['ser_list_id', '='],
                    ['user_id', '=', auth()->guard('customer')->user()->id],
                    ['ser_id', '='],
                ])->first();
        } else {
            $usrReview = "";
        }

        $breadcrumbs = [['link' => route('home'), 'name' => "Dashboard"], ['name' => "My Order"]];
        return view('/pages/client_user/user/my-order', [
            'breadcrumbs' => $breadcrumbs,
            'data' => $data
        ])->with('usrReview', $usrReview);;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\client_user\user\MyOrders  $myOrders
     * @return \Illuminate\Http\Response
     */
    public function show(MyOrders $myOrders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\client_user\user\MyOrders  $myOrders
     * @return \Illuminate\Http\Response
     */
    public function edit(MyOrders $myOrders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\client_user\user\MyOrders  $myOrders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $decrypted = decrypt($request->id);
        } catch (DecryptException $e) {
            return view('/pages/error-404');
        }

        $array = array(
            'bSerStatus' => "complete",
            'bPayStatus' => true
        );
        $tmp = MyOrders::where('order_id', $decrypted)->update($array);

        if ($tmp) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\client_user\user\MyOrders  $myOrders
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyOrders $myOrders)
    {
        //
    }
}
