@extends('layouts.client_user.client-contentLayoutMaster')

@section('title','Client Dashboard')

@section('custom-style')
<link href="{{asset('client_user/client/css/custom.css')}}" rel="stylesheet">
@endsection

@section('content')
<!-- Icon Cards-->
<div class="row">
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card dashboard text-white bg-primary o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-envelope-open"></i>
        </div>
        <div class="mr-5">
          <h5>No New Messages!</h5>
        </div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="#0">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card dashboard text-white bg-warning o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-star"></i>
        </div>
        <div class="mr-5">
          <h5>5 New Reviews!</h5>
        </div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="{{ route('client-review')}}">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card dashboard text-white bg-success o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-calendar-check-o"></i>
        </div>
        <div class="mr-5">
          <h5>1 New Bookings!</h5>
        </div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="{{ route('order-manage.index')}}">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card dashboard text-white bg-danger o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-list"></i>
        </div>
        <div class="mr-5">
          <h5>2 Services</h5>
        </div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="{{ route('service-listing')}}">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
</div>
<!-- /cards -->

<div class="box_general padding_bottom">
  <div class="header_box version_2">
    <h2><i class="fa fa-bar-chart"></i>Statistic</h2>
  </div>
  <canvas id="myAreaChart" width="100%" height="30" style="margin:45px 0 15px 0;"></canvas>
</div>

<div class="box_general box padding_bottom text-center">
  <div class="row h-100">
    <div class="col-sm-12 my-auto">
      <div class="mx-auto">
        <div class="align-middle">
          <span class="font-weight-bolder text-dark font-large-30 ">You haven't add any service yet!!</span>
        </div>
        <div class="text-center ">
          <a href="{{route('add-service-listing','insert')}}" class="btn_1 mt-2 font-weight-bolder">Add New Service</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('custom-script')
<script src="{{asset('client_user/client/js/admin-charts.js')}}"></script>
@endsection