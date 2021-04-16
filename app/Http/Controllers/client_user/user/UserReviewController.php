<?php

namespace App\Http\Controllers\client_user\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ReviewOrders;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\DB;



class UserReviewController extends Controller
{
    public function __construct() {
        $this->middleware("auth:customer");
    }

    public function index(Request $request)
    {
            try {
              $decrypted = decrypt($request->id);
          } catch (DecryptException $e) {
            return view('/pages/error-404');
          }
          $checkOrder = DB::table('tbl_order_manages')
                        ->where([['ser_list_id', '=', $decrypted],
                        ['user_id', '=', auth()->guard('customer')->user()->id]])
                        ->first();

          if (!$checkOrder) {

            return back()
            ->withErrors(['error'=> "you can't leave a reaview because You did't Book this service yet !"]);

          }

          $checkReview = DB::table('tbl_order_manages')
                        ->join('tbl_review_orders', 'tbl_review_orders.uID', '=', 'tbl_order_manages.user_id')
                        ->where([
                          ['ser_list_id', '=', $decrypted],
                          ['user_id', '=', auth()->guard('customer')->user()->id],
                          ['ser_id', '=', $decrypted],
                        ])->first();

          $service = DB::table('tbl_ser_list')
                      ->where('ser_id','=',$decrypted)
                      ->first();
        return view('pages/client_user/user/user-review')->with('checkReview',$checkReview)
                                                         ->with('service',$service)
                                                         ->with('serviceId',$decrypted);
    }

    public function submit(Request $request)
    {
      try {
        $decrypted = decrypt($request->id);
    } catch (DecryptException $e) {
      return view('/pages/error-404');
    }

        $request->validate([
            'resp_revw' => 'required' ,
            'serv_revw' => 'required' ,
            'comm_revw' => 'required' ,
            'price_revw' => 'required' ,
            'revw_title' => 'required' ,
            'revw_text' => 'required' ,
            'revw_fileupload'=>'image'
        ]);

        $data = array(
          'ser_id'=>$decrypted,
          'uID'=> auth()->guard('customer')->user()->id,
          'Res_R1'=>$request->resp_revw,
          'Ser_R2'=>$request->serv_revw,
          'Com_R3'=>$request->comm_revw,
          'Price_R4'=>$request->price_revw,
          'Title'=>$request->revw_title,
          'Feedback'=>$request->revw_text,
        );
        if($request->hasFile('revw_fileupload')){
          $data['Image'] = $request->revw_fileupload->store('/images/reviews');
        }

        ReviewOrders::create($data);
        $request->session()->flash('msg', 'Review Submitted Successfully!');

         return redirect()->route('client-detail',['id'=>$request->id]);

    }

    public function update(Request $request){
      try {
        $decrypted = decrypt($request->id);
    } catch (DecryptException $e) {
      return view('/pages/error-404');
    }

        $request->validate([
            'resp_revw' => 'required' ,
            'serv_revw' => 'required' ,
            'comm_revw' => 'required' ,
            'price_revw' => 'required' ,
            'revw_title' => 'required' ,
            'revw_text' => 'required' ,
            'revw_fileupload'=>'image'
        ]);

        $data = array(
          'ser_id'=>$decrypted,
          'uID'=> auth()->guard('customer')->user()->id,
          'Res_R1'=>$request->resp_revw,
          'Ser_R2'=>$request->serv_revw,
          'Com_R3'=>$request->comm_revw,
          'Price_R4'=>$request->price_revw,
          'Title'=>$request->revw_title,
          'Feedback'=>$request->revw_text,
        );
        if($request->hasFile('revw_fileupload')){
          $data['Image'] = $request->revw_fileupload->store('/images/reviews');
        }
        ReviewOrders::where([
          ['ser_id', '=', $decrypted],
          ['uID', '=', auth()->guard('customer')->user()->id]
        ])->update($data);
        $request->session()->flash('msg', 'Review Updated Successfully!');

        return redirect()->route('client-detail',['id'=>$request->id]);
    }

}
