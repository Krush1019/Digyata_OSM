@extends('layouts.client_user.user-contentLayoutMaster')

@section('title','My Profile')

@section('page-style')
<link href="{{asset('client_user/client/css/dropzone.css')}}" rel="stylesheet">
@endsection

@section('custom-style')
<link href="{{asset('client_user/client/css/custom.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <form id="profile-update-form">
      <div class="box_general pb-4">
        <div class="header_box version_2">
          <h2><i class="fa fa-file text-pink"></i>My Profile</h2>
        </div>
        <div class="row">
          <div class="col-md-4">
            {{-- <div class="mb-3 text-center text-md-left">
              <img id="user-propic" src="{{ asset('client_user/client/img/ser_img/1240506542-1614419650.jpg') }}"
            class="img-thumbnail service_img" alt="">
          </div>
          <div class="form-group" id="edit-photo-div" hidden>
            <div class="custom-file">
              <input type="file" class="custom-file-input w-50" id="us_propic" name="Profile Photo">
              <label class="custom-file-label w-75" for="us_propic">Choose file</label>
            </div>
          </div>
          <div class="">
            <button type="button" class="btn_1 btn-primary font-weight-light" id="us-edit-photo">Edit Image</button>
          </div> --}}
          <label>Your photo</label>
          <div id="profile-pic" action='/file-upload' class="dropzone mr-3"></div>
        </div>

        <div class="col-md-8 pl-0">
          <div class="row">
            <div class="col-md-8">
              <div class="form-group mt-20">
                <div class="small pl-0">Name</div>
                <input type="text" class="form-control font-weight-bold" id="us_fname" name="name"
                  placeholder="Full Name">
              </div>
            </div>
          </div>
          <!-- /row-->

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <span class="mr-3 small pl-0">Gender:</span>
                <span class="mr-2">
                  <input type="radio" name="gender" value="male" checked>
                  <label class="font-weight-bold"> Male</label>
                </span>
                <span class="mr-2">
                  <input type="radio" name="gender" value="female">
                  <label> Female</label>
                </span>
              </div>
            </div>
          </div>
          <!-- /row-->

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <span class="small">Mobile : </span>
                <input type="text" name="mobile" id="us_mobile" class="form-control font-weight-bold">
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <span class="small">E-mail : </span>
                <input type="email" name="email" id="us_email" class="form-control font-weight-bold">
              </div>
            </div>
          </div>
          <!-- /row -->

          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <span class="mr-3 small pl-0">Address:</span>
                <div class="row">
                  <div class="form-group col-8 col-md-6">
                    <select class="form-control font-weight-bold h-auto" name="od_state" id="us_state"></select>
                  </div>
                  <div class="form-group col-8 col-md-6">
                    <input type="text" name="od_city" id="us_city" class="form-control font-weight-bold h-auto">
                  </div>
                  <div class="form-group col-12">
                    <input type="text" class="form-control font-weight-bold" id="us_addl1" name="Address Line 1"
                      placeholder="House no., Building Name" value="27 madhuvan complex">
                  </div>
                  <div class="form-group col-12">
                    <input type="text" class="form-control font-weight-bold" id="us_addl2" name="Address Line 2"
                      placeholder="Road name, Area, Colony" value="Radhanpur cross road, Mahesana">
                  </div>
                  <div class="form-group col-6 col-md-4">
                    <input type="text" class="form-control font-weight-bold" placeholder="Pincode" id="us_pincode"
                      name="Pincode" value="384001">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /row-->
        </div>

        <div class="col-12 mt-15 form-group">
          <div>
            <span class="font-medium-5">If you want to change password!</span>
            <a id="chngpswdbtn" class="mt-5 text-primary font-weight-bolder" href="#0">change password</a>
          </div>
        </div>
      </div>
  </div>

  <div id="chngepassworddiv" class="box_general pb-md-4  display-hidden">
    <div class="row mt-25">
      <div class="col-12 col-md-4">
        <div class="form-group">
          <label>Old password</label>
          <i class="fa fa-lock"></i>
          <input id="us_old_pswd" class="form-control" type="password" name="oldpassword" placeholder="Old password">
        </div>
      </div>

      <div class="col-12 col-md-4">
        <div class="form-group">
          <label>New password</label>
          <i class="fa fa-lock"></i>
          <input class="form-control new-password" type="password" name="newpassword" placeholder="New password"
            id="us_new_pswd">
        </div>
      </div>

      <div class="col-12 col-md-4">
        <div class="form-group">
          <label>Confirm new password</label>
          <input class="form-control cnfm-new-password" type="password" name="confirmnewpassword"
            placeholder="Confirm new password" id="us_cnf_new_pswd">
        </div>
      </div>

      <div class="col-12">
        <div class="col-12 text-center">
          <div class="mx-md-15">
            <div id="pass-info" class="clearfix"></div>
          </div>
        </div>
      </div>

      <div class="col-12 mb-4">
        <button type="button" class="btn btn-success small" id="upchgpswdbtn">Update Password</button>
        <button class="btn btn-secondary small mt-3 mt-md-0" type="button" id="cncpswdbtn">Cancel</button>
      </div>
    </div>
  </div>

  <div class="mb-4">
    <button id="updt-prof-btn" type="submit" class="btn btn-primary">Update Profile</button>
  </div>
  </form>
</div>

</div>
@endsection


@section('page-script')
{{-- <script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script> --}}
<script src="{{asset('client_user/user/scripts/user-profile.js')}}"></script>
<script src="{{asset('js/scripts/extensions/sweetalert2.js')}}"></script>
<script src="{{asset('client_user/js/pw_strenght.js')}}"></script>
@endsection

@section('custom-script')
<script src="{{asset('client_user/client/js/dropzone.min.js')}}"></script>
@endsection