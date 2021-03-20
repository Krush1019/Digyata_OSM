@extends('layouts.client_user.client-contentLayoutMaster')

@section('title','Client Profile')

@section('page-style')
  <link href="{{asset('client_user/client/css/dropzone.css')}}" rel="stylesheet">
@endsection

@section('custom-style')
  <link href="{{asset('client_user/client/css/custom.css')}}" rel="stylesheet">
@endsection

@section('content')
  <div class="box_general padding_bottom">
    <div class="header_box version_2">
      <h2><i class="fa fa-user"></i>Profile details</h2>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Your photo</label>
          <form action="/file-upload" id="clientimgupload" class="dropzone"></form>
        </div>
      </div>
      <div class="col-md-8 add_top_30">
        <form id="updateClientDetail">
          <div class="row">
            <div class="col-md-4">
              <span class="text-dark font-large-2">
            <label>Status: </label>
          </span>
              <span class="mt-5 ml-2"><i class="approved">Active</i></span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" id="cl_name"  name="cl_name" placeholder="Your name">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Last name</label>
                <input type="text" class="form-control" id="cl_lname"  name="cl_lname" placeholder="Your last name">
              </div>
            </div>
          </div>
          <!-- /row-->
          <div class="row">
            <div class="col-md-6">
              <div class=" form-group">
          <span class="mr-3">
            <label for="User_gender" class="">Gender:</label>
          </span>
                <span class="mr-2">
            <input type="radio" name="User_gender" value="male" checked>
            <label> Male</label>
          </span>
                <span class="mr-2">
            <input type="radio" name="User_gender" value="female">
          <label> Female</label>
          </span>
              </div>
            </div>
          </div>
          <!-- /row-->
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label>Mobile No.</label>
                <input type="text" class="form-control" id="cl_mobile"  name="cl_mobile" placeholder="Your Mobile No.">
              </div>
            </div>
          </div>
          <!-- /row-->
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" id="cl_email"  name="cl_email" placeholder="Your email">
              </div>
            </div>
          </div>
          <!-- /row-->
          <div class="row">
            <div class="col">
              <button type="submit" id="updtClientDtlbtn" class="btn btn-success medium">Save</button>
              <a href="{{route('client-dashboard')}}" class="btn btn-secondary medium ml-2">cancel</a>
            </div>
          </div>
        </form>
      </div>
      <div class="col-12 mt-3 form-group">
        <span class="font-medium-5">If you want to change password!</span>
        <a class="mt-5 text-primary font-weight-bolder" data-toggle="modal" href="#changepasswdmodel">change password</a>
      </div>
    </div>
  </div>
  <div class="modal fade" id="changepasswdmodel" tabindex="-1" role="dialog" aria-labelledby="changepasswdModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title"><i class="fa fa-lock"></i>Change password</h2>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <form id="changepasswdform">
              <div class="input-container">
                <label>Old password</label>
                <i class="fa fa-lock"></i>
                <input class="form-control" type="password" name="odpasswd" placeholder="Old password" id="odpasswd">
              </div>
              <div class="form-group">
                <label>New password</label>
                <i class="fa fa-lock"></i>
                <input class="form-control" type="password" name="nwpasswd" placeholder="New password" id="nwpasswd">
                <button type="button" id="btn1" class="my-toggle hideShowPassword-toggle-show" hidden="hidden">show</button>
              </div>
              <div class="form-group">
                <label>Confirm new password</label>
                <input class="form-control" type="password" name="cnfnewpasswd" placeholder="Confirm new password" id="cnfnewpasswd">
              </div>
              <div id="pass-info" class="clearfix"></div>
              <div>
                <input type="submit" class="btn btn-success" id="changepasswdbtn">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('page-script')
  <script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
  <script src="{{asset('client_user/js/pw_strenght.js')}}"></script>
  <script src="{{asset('client_user/client/js/page-scripts/client-profile.js')}}"></script>
@endsection


@section('custom-script')
  <script src="{{asset('client_user/client/js/dropzone.min.js')}}"></script>

@endsection
