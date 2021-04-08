<?php

namespace App\Http\Controllers\client_user\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\DB;



class ConfirmOrderController extends Controller
{
  public function __construct()
    {
      $this->middleware("auth:customer");
    }

    public function index(Request $request)
    {
      try {
        $decrypted = decrypt($request->id);
    } catch (DecryptException $e) {
      return view('/pages/error-404');
    }
    $service =DB::table('tbl_ser_list')->where('ser_id', '=', $decrypted)->first();
      return view('/pages/client_user/user/user-confirm-order')->with('service',$service);
    }
}
