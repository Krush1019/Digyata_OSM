@extends('layouts.client_user.contentLayoutMaster')

@section('title', 'Confirm Order')

@section('specific-style')
<link href="{{ asset('client_user/css/booking-sign_up.css') }}" rel="stylesheet">
@endsection

@section('custom-style')
<link href="{{ asset('client_user/css/custom.css') }}" rel="stylesheet">
@endsection

@section('header-class', 'header header_in shadow clearfix')


@section('content')
<main class="bg_gray pattern">
  @if ($errors->first())
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{$errors->first()}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
      @endif
    <div class="container margin_60_40">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-5 col-sm-8">
                <div class="box_booking_2">
                    <div class="head">
                        <div class="title">
                            <h3>{{$service->ser_pro_name}}</h3><span>{{$service->ser_address}}, {{$service->ser_city}}, {{$service->ser_state}} - {{$service->pin_no}}</span>
                        </div>
                    </div>
                    <!-- /head -->
                    <div class="main">
                        <div id="switch1">
                            <form id="cnfm-od-form" method="POST" action="{{route('user.bookconfirm',['id'=>encrypt($service->ser_id)])}}">
                                <section id="switch_inner2">
                                  @csrf
                                    <div class="mb-3">
                                        <h6>Work Location details</h6>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <select class="form-control" name="state" id="cnfod_state">
                                                  <option value="{{$service->ser_state}}" selected>{{$service->ser_state}}</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                                <select name="city" id="cnfod_city" class="form-control">
                                                    <option value="{{$service->ser_city}}" selected>{{$service->ser_city}}</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-12">
                                                <input type="text" class="form-control" value="{{Auth::guard('customer')->user()->sUserHouseNo}}" id="cnfod_ad1" name="address1"
                                                    placeholder="*House no., Building Name">
                                            </div>
                                            <div class="form-group col-12">
                                                <input type="text" class="form-control" value="{{Auth::guard('customer')->user()->sUserArea}}" id="cnfod_ad2" name="address2"
                                                    placeholder="*Road name, Area, Colony">
                                            </div>
                                            <div class="form-group col-6">
                                                <input type="text" class="form-control" value="{{Auth::guard('customer')->user()->sUserPincode}}" placeholder="*Pincode"
                                                    id="cnfod_pin" name="pincode">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button id="BO_btn2" type="button" class="btn_1 full-width mb_5">Confirm
                                            Order</button>
                                    </div>
                                </section>
                                <section id="switch_inner3" hidden>
                                    <div class="mb-4">
                                        <h6>Booking summary</h6>
                                        <ul>
                                            <li>Date<span>{{Cookie::get('date')}}</span></li>
                                            <li>Time Slot<span>{{Cookie::get('selected_time')}}</span></li>
                                            <li>Category<span>{{ucfirst($service->serviceCategory)}}</span></li>
                                            <li>Service<span>{{ucfirst($service->serviceName)}}</span></li>
                                        </ul>
                                        <hr>
                                        <h6>Work Location Details</h6>
                                        <ul>
                                            <li>Address Line 1<span class="s_address1"></span></li>
                                            <li>Address Line 2<span class="s_address2"></span></li>
                                            <li>City<span class="s_city"></span></li>
                                            <li>State<span class="s_state"></span></li>
                                            <li>Pincode<span class="s_pin"></span></li>
                                        </ul>
                                        <hr>
                                        <h6>Service Item Details</h6>
                                        <ol>
                                          @php
                                          $total=0
                                          @endphp
                                          @foreach ($items as $item)
                                          @php
                                            $total = (int)$total + (int)$item->item_price;
                                          @endphp
                                          <li><label> {{$item->item_name}}</label><label class="float-right"> {{$item->item_price}} ₹</label></li>
                                          @endforeach
                                            </li>
                                        </ol>

                                        <ul class="pb-4">
                                            <li><span class="float-right border-top"><label
                                                        class="font-weight-bolder">Grand
                                                        Total:</label> <label class="font-weight-bolder ml-3"> {{$total}}
                                                        ₹</label></span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div>
                                        <button id="BO_btn3" type="submit" class="btn_1 full-width mb_5">Book
                                            Now</button>
                                    </div>
                                </section>

                                <a href="{{ url()->previous()}}" class="btn_1 full-width outline mb_25">Change
                                    Booking</a>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /box_booking -->
        </div>
        <!-- /col -->
    </div>
    <!-- /row -->
    </div>
    <!-- /container -->
</main>
@endsection

@section('page-script')
<script src="{{ asset('client_user/user/scripts/user-confirm-order.js') }}"></script>
@endsection
