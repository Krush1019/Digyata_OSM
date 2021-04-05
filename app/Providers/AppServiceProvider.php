<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\client_user\ClientManage;


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
        $arr['countClientManage'] = $this->getClientCount();
        return $arr;
    }

    /** Get Client Manage Count */
    private function getClientCount() {
        $count = ClientManage::where('sClientStatus', '=', 'Pending')->count();
        return ( $count > 0 ) ? $count : "" ;
    }

}
