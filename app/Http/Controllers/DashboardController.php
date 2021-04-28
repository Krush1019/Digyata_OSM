<?php

namespace App\Http\Controllers;

use App\client_user\ClientManage;
use Illuminate\Http\Request;
use App\client_user\OrderManage;
use App\client_user\UserManage;
use App\ReviewOrders;

class DashboardController extends Controller
{
    public function __construct()
    {
      $this->middleware("auth");
    }

    // Dashboard - Analytics
    public function dashboardAnalytics(){
        
        $countClient = ClientManage::all()->count();
        $countUser = UserManage::all()->count();
        $countOrder = OrderManage::all()->count();
        $countReview = ReviewOrders::all()->count();

        $pageConfigs = [
            'pageHeader' => false
        ];

        return view('/pages/dashboard-analytics', [
            'pageConfigs' => $pageConfigs,
            'countClient' => $countClient,
            'countReview' => $countReview,
            'countOrder' => $countOrder,
            'countUser' => $countUser

        ]);
    }

    public function OrderDetails(Request $request) {
        $countOrder = OrderManage::all()->count();
        $countPendingOrder = OrderManage::where('bSerStatus', 'pending')->count();
        $CountCompleteOrder = $countOrder - $countPendingOrder;
        $comp_oderper = ($CountCompleteOrder / $countOrder) * 100;
        $pend_oderper = ($countPendingOrder / $countOrder) * 100;
        $array = [$countOrder, $CountCompleteOrder, $countPendingOrder, $comp_oderper, $pend_oderper];
        return json_encode($array);
    } 

}

