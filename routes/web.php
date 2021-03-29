<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LanguageController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/


/******************
 *   ADMIN
 ******************/

    Route::get('/admin-dashboard', 'DashboardController@dashboardAnalytics')->name('admin-dashboard');

    /** Admin -- service-catalog */
    Route::get('/service-catalog', 'ServiceCatalogController@index')->name('service-catalog');
    Route::post('/service-store', 'ServiceCatalogController@store')->name('service-store');
    Route::post('/service-update', 'ServiceCatalogController@update')->name('service-update');
    Route::post('/service-destroy', 'ServiceCatalogController@destroy')->name('service-destroy');
    Route::post('/service-retrive', 'ServiceCatalogController@retrive')->name('service-retrive');

    /** Admin -- localization */
    Route::get('/localization', 'LocalizationController@index');
    Route::get('/localization-show', 'LocalizationController@show');
    Route::get('/localization-store', 'LocalizationController@store');
    Route::get('/localization-edit/{id}', 'LocalizationController@edit');
    Route::get('/localization-update/{id}', 'LocalizationController@update');
    //    Route::get('/localization-destroy/{id}', 'LocalizationController@destroy');

    /** Admin -- price-rules */
    Route::get('/price-rules', 'PriceRuleController@index');
    Route::get('/price-rules-show', 'PriceRuleController@show');
    Route::get('/price-rules-update', 'PriceRuleController@update');
    Route::get('/price-rules-edit/{id}', 'PriceRuleController@edit');

    /** Admin -- People */

        /** Admin -- Pepole -- client-manage */
        Route::get('/client-manage', 'ClientManageController@index');
        //      Route::get('/client-view', 'ClientManageController@client_view');
        Route::get('/client-manage-show', 'ClientManageController@show');
        Route::get('/client-manage-store', 'ClientManageController@store');
        Route::get('/client-manage-update', 'ClientManageController@update');

        /** Admin -- Pepole -- user-manage */
        Route::get('/user-manage', 'UserManageController@index');
        Route::get('/user-manage-store', 'UserManageController@store');
        //    Route::get('/user-view', 'UserManageController@user_view');
        Route::get('/user-manage-show', 'UserManageController@show');
        Route::get('/user-manage-update', 'UserManageController@update');

    /** Admin -- service-manage */
    Route::get('/service-manage', 'ServiceManageController@index')->name('service-manage');

    /** Admin -- Booking Schedule */
    Route::get('/booking-schedule', 'BookingScheduleController@index');
    //    Route::get('/booking-schedule-store', 'BookingScheduleController@store');
    Route::get('/booking-schedule-show/{action}', 'BookingScheduleController@show');

    /** Admin -- Review Order */
    Route::get('/review-order', 'ReviewOrdersController@index');
    //    Route::get('/review-order-store', 'ReviewOrdersController@store');
    Route::get('/review-order-show/{action}', 'ReviewOrdersController@show');
    Route::get('/review-order-search', 'ReviewOrdersController@search');

    /** Admin -- Discount & PromoCode */
    Route::get('/discount-promo', 'DiscountPromoController@index');
    Route::get('/discount-promo-store', 'DiscountPromoController@store');
    Route::get('/discount-promo-show', 'DiscountPromoController@show');
    Route::get('/discount-promo-update/{id}', 'DiscountPromoController@update');
    Route::get('/discount-promo-edit/{id}', 'DiscountPromoController@edit');
    //    Route::get('/discount-promo-destroy/{id}', 'DiscountPromoController@destroy');


/*********************
 * FRONT_END
 * ********************/

    /** Index page */
    Route::get('/', 'client_user\indexController@index')->name('index-page');
    Route::get('/home', 'client_user\indexController@index')->name('home');

    /** client-register */
    Route::get('/client-register', 'client_user\ClientRegisterController@index')->name('client-register');

    /** user-register */
    Route::get('/user-register', 'client_user\UserRegisterController@index')->name('user-register');

    /** about-us */
    Route::get('/about-us', 'client_user\AboutUsController@index')->name('about-us');

    /** contacts */
    Route::get('/contacts', 'client_user\ContactsController@index')->name('contacts');

    /** captcha */
    Route::get('/contact-form', 'client_user\CaptchaController@index');
    // Route::post('/captcha-validation', 'client_user\CaptchaController@capthcaFormValidate');
    Route::get('/reload-captcha', 'client_user\CaptchaController@reloadCaptcha');


/******************
*   CLIENT
* *****************/

    /** client -- Dashboard */
    Route::get('/client-dashboard', 'client_user\client\ClientDashboardController@index')->middleware('auth:client')->name('client-dashboard');

    /** client -- profile */
    Route::get('/client-profile', 'client_user\client\ClientProfileController@index')->name('client-profile');

    /** client -- service listing */
    Route::get('/service-listing', 'client_user\client\ServiceListController@service_listing')->name('service-listing');
    Route::get('/add-service-listing/{id}', 'client_user\client\ServiceListController@index')->name('add-service-listing');
    Route::post('/service-listing-store', 'client_user\client\ServiceListController@store');
    Route::get('/service-listing-update', 'client_user\client\ServiceListController@update');
    Route::get('/service-listing-show', 'client_user\client\ServiceListController@show');
    Route::post('/service-listing-store-img', 'client_user\client\ServiceListController@saveImg');

    /** client -- reviews */
    Route::get('/client-review', 'client_user\client\ClientReviewController@index')->name('client-review');

    /** client -- Order Manage */
    Route::get('/order-manage', 'client_user\OrderManageController@index')->name('order-manage.index');
    Route::get('/order-manage-show', 'client_user\OrderManageController@show');

    /** client -- bookings */
    // Route::get('/client-order-manage', 'client_user\client\ClientOrderManageController@index')->name('client-order-manage');
    
/******************
*   USER
******************/

    /** user -- Profile */
    Route::get('/user/profile', 'client_user\user\UserProfileController@index')->name('user.profile');
    Route::post('/user/profile', 'client_user\user\UserProfileController@update')->name('user.profileupdate');

    /** user -- My orders */
    Route::get('/user/my-orders', 'client_user\user\MyOrdersController@index')->name('user.myorders');

    /** client -- detail */
    Route::get('/client-detail', 'client_user\user\ClientDetailController@index')->name('client-detail');

    /** client -- listing */
    Route::get('/client-listing', 'client_user\user\ClientListingController@index')->name('client-listing');

    /** confirm -- order */
    Route::get('/confirm-order', 'client_user\user\ConfirmOrderController@index')->name('confirm-order');

    /** user -- review */
    Route::get('/user-review', 'client_user\user\UserReviewController@index')->name('user-review');


/*********************
 * ACESSS CONTROLLER
 * ********************/

    Route::get('/access-control', 'AccessController@index');
    Route::get('/access-control/{roles}', 'AccessController@roles');
    Route::get('/modern-admin', 'AccessController@home')->middleware('permissions:approve-post');
    Route::get('/logout', 'Auth\LoginController@logout');

    Auth::routes();


/******************
*   LOGIN
******************/

    /** Auth -- Client */ 
    // Route::get('/login/client', 'Auth\LoginController@showClientLoginForm')->name('client.login');
    Route::post('/login/client', 'Auth\LoginController@clientLogin')->name('login.client');
    Route::get('/register/client', 'Auth\RegisterController@showClientRegisterForm')->name('client.register');
    Route::post('/register/client', 'Auth\RegisterController@createClient')->name('register.client');

    /** Auth -- Customer */ 
    // Route::get('/login/customer', 'Auth\LoginController@showCustomerLoginForm')->name('customer.login');
    Route::post('/login/customer', 'Auth\LoginController@customerLogin')->name('login.customer');
    Route::get('/register/customer', 'Auth\RegisterController@showCustomerRegisterForm')->name('customer.register');
    Route::post('/register/customer', 'Auth\RegisterController@createCustomer')->name('register.customer');

    /** Auth -- Login */ 
    Route::get('/loginpage', 'Auth\LoginController@LoginPageForm')->name('login-page');


/** locale Route */ 
Route::get('lang/{locale}', [LanguageController::class, 'swap']);
