<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\client_user\ClientManage;
use App\client_user\OrderManage;
use App\ServiceList;
use Illuminate\Support\Facades\Auth;
use Exception;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Schema::defaultStringLength(191);
        Passport::routes();
        View::share($this->getViewData());
    }

    /** Get Data */
    private function getViewData () {
        $arr = array();
        // $arr['countClient'] = $this->getClientCount();
        // $arr['countAdminServiceList'] = $this->getAdminServiceListCount();
        // $arr['countOrderManage'] = $this->getOrderManageCount();
        return $arr;
    }

    /** Get Client Manage Count */
    private function getClientCount() {
        // try {
        //     $count = ClientManage::where('sClientStatus', '=', 'Pending')->count();
        // } catch(Exception $e) { $count = ""; }
        $count = ClientManage::where('sClientStatus', '=', 'Pending')->count();
        return ( $count > 0 ) ? $count : "" ;
    }

    /** Get Service List Count */
    private function getAdminServiceListCount() {
        $count = ServiceList::where( "ser_status", "Pending" )->count();
        return ( $count > 0 ) ? $count : "" ;
    }

    /** Get Client Order Manage Count */
    private function getOrderManageCount() {
        $where = [
            ["bSerStatus" , "pending" ],
            ["client_id", Auth::id()]
        ];
        // $count = OrderManage::where($where)->count();
        $count = 10;
        return ( $count > 0 ) ? $count : "" ;
    }

}
