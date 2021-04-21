@extends('layouts/contentLayoutMaster')

@section('title', 'Localization')

@section('vendor-style')
        {{-- Page Css files --}}
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/ag-grid/ag-grid.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/ag-grid/ag-theme-material.css')) }}">
@endsection

@section('page-style')
        {{-- Page Css files --}}
        <link rel="stylesheet" href="{{ asset(mix('css/pages/app-user.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/pages/aggrid.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/plugins/forms/validation/form-validation.css')) }}">
        <link rel="stylesheet" href="{{ asset('css/custom/custom.css') }}">
@endsection

@section('content')
<!-- users list start -->
<section class="users-list-wrapper">
  <!-- Ag Grid users list section start -->
  <div id="basic-examples">
    <div class="card">
      <div class="card-content">
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="ag-grid-btns d-flex justify-content-between flex-wrap mb-1">
                <div class="dropdown sort-dropdown mb-1 mb-sm-0">
                  <button class="btn btn-white filter-btn dropdown-toggle border text-dark" type="button" id="dropdownMenuButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    1 - 20 of 50
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton6">
                    <a class="dropdown-item" href="#">20</a>
                    <a class="dropdown-item" href="#">50</a>
                  </div>
                  <button type="button" data-toggle="modal" data-target="#locationFormDiv" class="btn btn-icon btn-icon rounded-1 ml-0 ml-sm-1 mt-1 mt-sm-0 btn-outline-primary font-medium-1 btn-flat-primary waves-effect waves-light ">
                    <i class="feather mr-1 icon-plus-square"></i>New Location
                  </button>
                </div>
                <div class="ag-btns d-flex flex-wrap">
                  <input type="text" class="ag-grid-filter form-control mr-1 mb-1 mb-sm-0" id="filter-text-box" placeholder="Search...." />
                  {{-- <div class="action-btns">
                    <div class="btn-dropdown ">
                      <div class="btn-group dropdown actions-dropodown">
                        <button type="button" class="btn btn-white px-2 py-75 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Actions
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#"><i class="feather icon-trash-2"></i> Delete</a>
                          <a class="dropdown-item" href="#"><i class="feather icon-clipboard"></i> Archive</a>
                          <a class="dropdown-item" href="#"><i class="feather icon-printer"></i> Print</a>
                          <a class="dropdown-item" href="#"><i class="feather icon-download"></i> CSV</a>
                        </div>
                      </div>
                    </div>
                  </div> --}}
                </div>
              </div>
            </div>
          </div>

          <div id="myGrid" class="aggrid ag-theme-material"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- Ag Grid users list section end -->

  {{-- START: Model --}}
  <div class="modal fade text-left" id="locationFormDiv" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="form">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="locationFormModel">Add Location Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="javaScript:void(0)" id="addLocationForm" method="post" novalidate>
          <div class="modal-body">
            <div class="form-group">
              <div class="controls">
                <label for="location-state">State: </label>
                <fieldset>
                  <select id="location-state" name="loc_State" class="form-control" data-validation-required-message="This field is required" aria-invalid="false"></select>
                </fieldset>
              </div>
            </div>
            <div class="form-group">
              <div class="controls">
                <label for="location-place">Location: </label>
                <input type="text" name="loc_Loc" id="location-place" placeholder="Location" class="form-control" data-validation-required-message="This field is required" aria-invalid="false">
              </div>
            </div>
            <div class="form-group">
              <div class="controls">
                <label for="location-agentEmail">Agent-Admin Email: </label>
                <input type="email" name="loc_Email" id="location-agentEmail" placeholder="Agent-Admin Email" class="form-control" data-validation-required-message="This field is required" aria-invalid="false">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" id="addLocBtn" class="btn btn-outline-primary waves-effect waves-light" autofocus data-action="insert">Add Location</button>
            <button type="button" id="location-dismiss" class="btn btn-outline-danger waves-effect waves-light" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  {{-- END: Model --}}
</section>
<!-- users list ends -->
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/tables/ag-grid/ag-grid-community.min.noStyle.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('vendors/js/forms/validation/jqBootstrapValidation.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/validation/form-validation.js')) }}"></script>
  <script src="{{ asset('js/scripts/ui/localization.js') }}"></script>
  <script src="{{ asset(mix('js/scripts/modal/components-modal.js')) }}"></script>
  <script src="{{ asset('js/scripts/extensions/sweetalert2.js')}}"></script>
@endsection
