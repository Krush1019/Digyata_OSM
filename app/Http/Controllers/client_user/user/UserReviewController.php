<?php

namespace App\Http\Controllers\client_user\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ServiceList;
use App\ReviewOrders;

class UserReviewController extends Controller
{
    public function __construct() {
        $this->middleware("auth:customer");
    }
    
    public function index(Request $req)
    {
         
        $service = ServiceList::where('ser_id',decrypt($req->id))->first();
        //  dd($service);
        return view('pages/client_user/user/user-review')->with('service',$service);
        //return view('pages/client_user/user/user-review');
    }

    public function submit(Request $req)
    {
        
        $req->validate([
            'resp_revw' => 'required' ,
            'serv_revw' => 'required' ,
            'comm_revw' => 'required' ,
            'price_revw' => 'required' ,
            'revw_title' => 'required' ,
            'revw_text' => 'required' ,
        ]);

        $uID = auth()->user()->id;
        $r1 = $req->input('resp_revw');
        $r2 = $req->input('serv_revw');
        $r3 = $req->input('comm_revw');
        $r4 = $req->input('price_revw');
        $title = $req->input('revw_title');
        $your_review = $req->input('revw_text');
        $iReview_Rating = ( $r1 + $r2 +$r3 +$r4 ) / 4 ;
        $Overall_Rating = 1 ;
        $image = $req->file('revw_fileupload')->store('public/client_user/client/img/review_image');
        
         $res = new ReviewOrders();
         $res->order_id   = 1 ;
         $res->ser_id  = 1;
         $res->cl_ID  = 1;
         $res->uID = $uID;
         $res->Res_R1 = $r1;
         $res->Ser_R2 = $r2;
         $res->Com_R3 = $r3;
         $res->Price_R4 = $r4;
         $res->Avg_Rating = $iReview_Rating;
         $res->Overall_Rating = $Overall_Rating;
         $res->Title = $title;
         $res->Feedback = $your_review;

         $res->Image = $image ;
         
         $res->bReview_Status = 1;
         $res->save();
         
         session()->flash('msg','Review Submitted Successfully');
         return back();
         
         //return redirect('home');

    }
    
}
