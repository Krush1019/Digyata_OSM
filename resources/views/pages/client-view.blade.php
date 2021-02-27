@extends('layouts/contentLayoutMaster')

@section('title', 'Client View')

@section('page-style')
        {{-- Page Css files --}}
        <link rel="stylesheet" href="{{ asset(mix('css/pages/app-user.css')) }}">
@endsection

@section('content')
<!-- page Client view start -->
<section class="page-users-view">
  <div class="row">
    <!-- account start -->
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="card-title">Account</div>
          <div class="row">
            <div class="col-2 users-view-image">
              <img src="{{ asset('images/portrait/small/avatar-s-12.jpg') }}" class="w-100 rounded mb-2"
                alt="avatar">
              <!-- height="150" width="150" -->
            </div>
            <div class="col-sm-4 col-12">
              <table>
                <tr>
                  <td class="font-weight-bold">Name</td>
                  <td>Angelo Sashington</td>
                </tr>
                <tr>
                  <td class="font-weight-bold">Profession</td>
                  <td>Cleaner</td>
                </tr>
                <tr>
                  <td class="font-weight-bold">Avalibility</td>
                  <td>08:00 AM - 07:00 PM</td>
                </tr>
              </table>
            </div>
            <div class="col-md-6 col-12 ">
              <table class="ml-0 ml-sm-0 ml-lg-0">
                <tr>
                  <td class="font-weight-bold">Status</td>
                  <td>
                    <span class="badge badge-pill badge-warning ">Panding</span>
                  </td>
                </tr>
                <tr>
                  <td class="font-weight-bold">Location</td>
                  <td>Surat</td>
                </tr>
                <tr>
                  <td class="font-weight-bold">WorkPlace</td>
                  <td>-</td>
                </tr>
              </table>
            </div>
            <div class="col-12">
              <button class="btn btn-outline-success mr-1"><i class="feather icon-user-check"></i> Accept</button>
              <button class="btn btn-outline-danger"><i class="feather icon-user-x"></i> Decline</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- account end -->
    <!--Contact information start -->
    <div class="col-md-6 col-12 ">
      <div class="card">
        <div class="card-body">
          <div class="card-title mb-2">Contact Information</div>
          <table>
            <tr>
              <td class="font-weight-bold">Email</td>
              <td>angelo@sashington.com</td>
            </tr>
            <tr>
              <td class="font-weight-bold">Mobile</td>
              <td>+65958951757</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <!--Contact information end -->

    <!--Document Id start -->
    <div class="col-md-6 col-12 ">
      <div class="card ">
        <div class="card-body pb-0">
          <div class="card-title mb-2">Government Id</div>
          <table>
            <tr>
              <td class="font-weight-bold">Aadhar Card No</td>
                <td>659568454895</td>
            </tr>
            <tr>
              <td class="font-weight-bold">Document</td>
              <td>
                <a href="#" class="btn btn-flat-primary mr-1"><i class="fa fa-file-o"></i> View</a>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <!--Document Id end -->

  </div>
</section>
<!-- page users view end -->
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/pages/app-user.js')) }}"></script>
@endsection
