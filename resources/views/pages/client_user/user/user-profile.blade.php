@extends('layouts.client_user.user-contentLayoutMaster')

@section('title','My Profile')

@section('custom-style')
  <link href="{{asset('client_user/client/css/custom.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="modal-body container-fluid">
  <div class="row">

    <div class="box_general m-4 w-100 pb-4 viewservicespan">
      <div class="header_box version_2">
        <h2><i class="fa fa-file text-pink"></i>My Profile</h2>
      </div>
      <div class="row">
        <div class="col-md-3">
          <img src="{{ asset('client_user/client/img/ser_img/1240506542-1614419650.jpg') }}"
            class="img-thumbnail service_img" alt="Cinque Terre">
        </div>
        <div class="col-md-4">
          <div class="mt-20">
            <div class="col-sm-12 small pl-0">User Name :</div>
            <div
              class="col-sm-12 font-large-17 font-weight-bold pl-0">
              Ramesh Patel</div>
          </div>

        </div>
        <div class="col-md-5">
          <div class="mt-20">
            <div class="col-sm-12 small pl-0">Gender :</div>
            <div
              class="col-sm-12 font-large-17 font-weight-bold pl-0">Male</div>
          </div>
        </div>

        <div class="col-12">
          <div class="mt-20">
            <div class="small pl-0">Address :</div>
            <div
              class="col-sm-12 font-large-17 font-weight-bold pl-0">27 madhuvan complex, Radhanpur cross road, Mahesana - 384623</div>
          </div>
        </div>

      </div>

      <div class="row">

        <div class="col-md-5 mt-20">
          <div class="">
            <div class="user-info">
              <div>
                <span class="col-sm-12 small pl-0">Phone : </span>
                <span
                  class="col-sm-12 font-weight-bold pl-0">8200707338</span>
              </div>
              <div>
                <span class="col-sm-12 small pl-0">E-mail : </span>
                <span class="col-sm-12 font-weight-bold pl-0"><a
                    href="mailto:meetprajapati847@gmail.com"
                    class=""
                    target="_blank">meetprajapati847@gmail.com</a></span>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="modal-footer">
    <a class="btn btn-primary" href="{{route('add-service-listing')}}">Edit Profile</a>
    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
  </div>

</div>
@endsection

@section('page-script')
        <script src="{{asset('client_user/client/js/page-scripts/client-order-manage.js')}}"></script>
        <script src="{{ asset('js/scripts/extensions/sweetalert2.js')}}"></script>
@endsection
