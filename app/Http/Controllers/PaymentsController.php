<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;

use GuzzleHttp\Psr7\Message;
use Illuminate\Contracts\Encryption\DecryptException;

class PaymentsController extends Controller
{
    function submit(Request $request,$id)
    {
			try {
        $decrypted = decrypt($id);
    } catch (DecryptException $e) {
      	return view('/pages/error-404');
    }

		$service =DB::table('tbl_ser_list')
							->where('ser_id', '=', $decrypted)
							->join('tbl_service_catalogs as tsc', 'tbl_ser_list.ser_cat_id', '=', 'tsc.id')
							->first();


		$ser_id = json_decode($request->cookie('services'));

    foreach ($ser_id as $key => $value) {
        $ser_id[$key] = decrypt($value);
    }

    $items = DB::table('tbl_ser_item_price')
            ->whereIn('item_id', $ser_id)
            ->get();

				$total=0;

				foreach ($items as $item)
							$total = (int)$total + (int)$item->item_price;
		
		
		$api = config('payment.api');
		$token = config('payment.token');
	
    $ch = curl_init();
	

		curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_HTTPHEADER,
		            array("X-Api-Key:$api",
		                  "X-Auth-Token:$token"));
		$payload = Array(
		    'purpose' => $service->serviceName,
		    'amount' => $total,
		    'phone' => auth()->guard('customer')->user()->sUserMobile,
		    'buyer_name' => auth()->guard('customer')->user()->sUserName,
		    'redirect_url' => 'http://127.0.0.1:8000/success/'.$decrypted,
		    'send_email' => true,
				'webhook' => 'http://www.example.com/webhook/',
		    'send_sms' => true,
		    'email' =>auth()->guard('customer')->user()->sUserEmail,
		    'allow_repeated_payments' => false
		);

		// dd($payload);
	
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
		$response = curl_exec($ch);
		curl_close($ch); 
    	
	  // dd($response);

		try{
				$response = json_decode($response);
				return redirect($response->payment_request->longurl);
		}
		catch(Exception $err){

				session()->flash('error','Please Check your Phone No & Email For payment');
				return view('/pages/client_user/user/user-confirm-order')->with('service',$service)->with('items',$items); 

		}

    }

    function success(Request $request,$id)
    {
    	// echo "<pre>";
    	// print_r($_GET);

			// $payment = new Payment();

			// $payment->P_id = $_GET['payment_id'];
			// $payment->sName = '';
			// $payment->uName = auth()->guard('customer')->user()->sUserName;
			// $payment->Price = 100;
			// $payment->P_Status = 1;
			// $payment->P_req_id =  $_GET['payment_request_id'];

			// $payment->save();
			
			// return redirect()->route('user.bookconfirm',['id'=>encrypt($id)]);
		 $encrypt = encrypt($id);

			$input = $request->all();

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payments/'.$request->get('payment_id'));
			curl_setopt($ch, CURLOPT_HEADER, FALSE);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
			curl_setopt($ch, CURLOPT_HTTPHEADER,
					array("X-Api-Key:test_ba6ac8c68e691f2034589cd0e59",
												"X-Auth-Token:test_31bdf4b00236118ad69521f935b"));

			$response = curl_exec($ch);
			$err = curl_error($ch);
			curl_close($ch); 

			$data = json_decode($response);
			
			if($data->success == true) {
					if($data->payment->status == 'Credit') {

							$input['name'] = $data->payment->buyer_name;
							$input['email'] = $data->payment->buyer_email;
							$input['mobile'] = $data->payment->buyer_phone;
							$input['amount'] = $data->payment->amount;
							Payment::create($input);

							return redirect('home');

					}
			}
	}
}




// $payload = Array(
// 	'purpose' => $service->serviceName,
// 	'amount' => $total,
// 	'phone' => $service->sUserMobile,
// 	'buyer_name' => $service->sUserName,
// 	'redirect_url' => 'http://127.0.0.1:8000/success/',
// 	'send_email' => true,
// 	'send_sms' => true,
// 	'email' => $service->sUserEmail,
// 	'allow_repeated_payments' => false
// );