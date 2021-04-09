@extends('layouts.client_user.contentLayoutMaster')

@section('title', 'Order Booked')

@section('specific-style')
<link href="{{ asset('client_user/css/booking-sign_up.css') }}" rel="stylesheet">
@endsection

@section('custom-style')
<link href="{{ asset('client_user/css/custom.css') }}" rel="stylesheet">
@endsection

@section('header-class', 'header header_in shadow clearfix')


@section('content')
<main class="bg_gray pattern">
      <div class="container margin_60_40">
            <div class="row justify-content-center">
                  <div class="col-lg-4 col-md-5 col-sm-8">
                        <div class="box_booking_2">
                              <div class="head">
                                    <div class="title">
                                          {{-- <h3>{{$service->ser_pro_name}}</h3>
                                          <span>{{$service->ser_address}}, {{$service->ser_city}}, {{$service->ser_state}} -
                                                {{$service->pin_no}}</span> --}}
                                    </div>
                              </div>
                              <!-- /head -->
                              <div class="main">
                                    <div id="switch2">
                                          <div id="confirm">
                                                <div class="icon icon--order-success svg add_bottom_15">
                                                      <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72">
                                                            <g fill="none" stroke="#8EC343" stroke-width="2">
                                                                  <circle cx="36" cy="36" r="35"
                                                                        style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;">
                                                                  </circle>
                                                                  <path d="M17.417,37.778l9.93,9.909l25.444-25.393"
                                                                        style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;">
                                                                  </path>
                                                            </g>
                                                      </svg>
                                                </div>
                                                <h3>Booking Confirmed!</h3>
                                                <p>We will reply shortly to confirm the order.</p>
                                          </div>
                                          <div class="footer-btn text-center">
                                                <a href="#0" class="underline" target="blank">Print receipt</a>
                                                <div>
                                                      <a href="{{ route('home')}}" class="btn_1 mt-4">Back To Home</a>
                                                </div>
                                          </div>
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

