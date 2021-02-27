@extends('layouts.client_user.client-contentLayoutMaster')

@section('title','Service Listing')

@section('custom-style')
  <link href="{{asset('client_user/client/css/custom.css')}}" rel="stylesheet">
@endsection

@section('content')
  <div class="box_general">
    <div class="header_box">
        <a class="font-large-20 btn btn-success mr-3" href="{{route('add-service-listing')}}">
          <i class="fa fa-plus"></i>
        </a>
      <h2 class="d-inline-block ">Service Listings</h2>
      <div class="filter">
        <select name="orderby" class="selectbox">
          <option value="All">All</option>
          <option value="Panding">Panding</option>
          <option value="Active">Active</option>
          <option value="Reject">Reject</option>
        </select>
      </div>
    </div>
    <div class="list_general">
        {{--<div class="box_general box padding_bottom text-center">
          <div class="row h-100">
            <div class="col-sm-12 my-auto">
              <div class="mx-auto">
                <div class="align-middle">
                  <span class="font-weight-bolder text-dark font-large-30 ">You haven't add any service yet!!</span>
                </div>
                <div class="text-center ">
                  <a href="{{route('add-service-listing')}}" class="btn_1 mt-2 font-weight-bolder">Add Now!</a>
                </div>
              </div>
            </div>
          </div>
        </div>--}}
      <ul>
        <li>
          <figure><img src="{{asset('client_user/client/img/item_1.jpg')}}" alt=""></figure>
          <small>Cleaning</small>
          <h4>Dusting</h4>
          <p>We clean your office, home, garden etc. </p>
          <p><a href="#viewservicemodal" data-toggle="modal" class="btn_1 gray"><i class="fa fa-fw fa-eye"></i> View Service</a></p>
          <ul class="buttons">
            <li><a href="#0" class="btn_1 gray s_status approve"><i class="fa fa-fw fa-check"></i> Active</a></li>
          </ul>
        </li>
        <li>
          <figure><img src="{{asset('client_user/client/img/item_2.jpg')}}" alt=""></figure>
          <small>Maintenance</small>
          <h4>Painting</h4>
          <p>We paint your office, home, garden etc. </p>
          <p><a href="#viewservicemodal" data-toggle="modal" class="btn_1 gray"><i class="fa fa-fw fa-eye"></i> View Service</a></p>
          <ul class="buttons">
            <li><a href="#0" class="btn_1 gray s_status approve"><i class="fa fa-fw fa-check"></i> Active</a></li>
          </ul>
        </li>
        <li>
          <figure><img src="{{asset('client_user/client/img/item_3.jpg')}}" alt=""></figure>
          <small>Maintenance</small>
          <h4>Plumbing</h4>
          <p>We have complete plumbing solution for office, home, garden etc. </p>
          <p><a href="#viewservicemodal" data-toggle="modal" class="btn_1 gray"><i class="fa fa-fw fa-eye"></i> View Service</a></p>
          <ul class="buttons">
            <li><a href="#0" class="btn_1 gray s_status approve"><i class="fa fa-fw fa-check"></i>Active</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
  <!-- /box_general-->
  <nav aria-label="...">
    <ul class="pagination pagination-sm add_bottom_30">
      <li class="page-item disabled">
        <a class="page-link" href="#" tabindex="-1">Previous</a>
      </li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item">
        <a class="page-link" href="#">Next</a>
      </li>
    </ul>
  </nav>
  <!-- /pagination-->

  <div  class="modal fade" id="viewservicemodal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div  class="modal-header">
          <h4 class="modal-title">View Service</h4>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body container-fluid">
          <div class="row">
            <div class="box_general m-4 w-100 pb-4 viewservicespan">
              <div class="header_box version_2">
                <h2><i class="fa fa-file text-pink"></i>Service info</h2>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <span>
                    <label>Service Name: </label><label class="font-large-17 font-weight-bold">Cleaning</label>
                  </span>
                </div>
                <div class="col-md-6">
                  <span>
                    <label>category: </label><label>Cleaning</label>
                  </span>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <span>Shop Name/Provider Name: </span>
                  <span>M.K. Claners</span>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <span>
                    <label>Expericence in related Field (In Months/Years): </label><label>2 Years</label>
                  </span>
                </div>
              </div>
              <div class="row">
                <div class="col-auto">
                  <span><label>Description: </label></span>
                </div>
                <div class="col-auto">
                  <span>We clean your office, home, garden etc.</span>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <span>
                    <label>Phone: </label><label>7845123698</label>
                  </span>
                </div>
                <div class="col-md-6">
                  <span>
                    <label>Website: </label><span><a href="#" class="text-primary">www.example.com</a></span>
                  </span>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <span>
                    <label>Email: </label><span><a href="#" class="text-primary">example1@gmail.com</a></span>
                  </span>
                </div>
                <div class="col-md-6">
                  <span>
                    <label>Facebook Link: </label><label></label>
                  </span>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <span>
                    <label>Twitter Link: </label><label></label>
                  </span>
                </div>
                <div class="col-md-6">
                  <span>
                    <label>LinkedIn Link: </label><label></label>
                  </span>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <span>
                    <label>Photos: </label><span><a href="#" class="text-primary">photos</a></span>
                  </span>
                </div>
              </div>
              <div class="header_box version_2 mt-4">
                <h2><i class="fa fa-paperclip"></i>Document</h2>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <span>ID Proof: </span><span><a href="#" class="text-primary">document</a></span>
                </div>
                <div class="col-md-6">
                  <span>Aadhar No.: </span><span>788565231578</span>
                </div>
              </div>
              <div class="header_box version_2 mt-4">
                <h2><i class="fa fa-map-marker"></i>Location</h2>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <span>
                    <label>City: </label><label>Mahesana</label>
                  </span>
                </div>
                <div class="col-md-6">
                  <span>
                    <label>State: </label><label>Gujarat</label>
                  </span>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <span><label>Address: </label><label>20, Madhuvan Complex, Radhanpur Cross road, Mahesana-2</label></span>
                </div>
                <div class="col-md-6">
                  <span><label>Pincode: </label><label>698745</label></span>
                </div>
              </div>
              <div class="header_box version_2 mt-4">
                <h2><i class="fa fa-clock-o"></i>Availability</h2>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <span><label>Working Days in Week:</label><label> 6 Days (Mon-Sat)</label></span>
                </div>
                <div class="col-md-6">
                  <span><label>Time: </label><label>08:00 TO 19:00</label></span>
                </div>
              </div>
              <div class="header_box version_2 mt-4">
                <h2><i class="fa fa-dollar"></i>Pricing</h2>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <span><label>Item 1: </label><label> 1 BHK home</label></span>
                </div>
                <div class="col-md-6">
                  <span><label>Price: </label><label> 100 ₹</label></span>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <span><label>Description: </label><label> 1 BHK House Cleaning</label></span>
                </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <a class="btn btn-primary" href="{{route('add-service-listing')}}">Edit Service</a>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  </div>
@endsection

@section('page-script')
  <script src="{{asset('client_user/client/js/page-scripts/client-service-listing.js')}}"></script>
  <script src="{{ asset('js/scripts/extensions/sweetalert2.js')}}"></script>
@endsection
