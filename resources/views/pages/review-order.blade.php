@extends('layouts/contentLayoutMaster')

@section('title', 'Review Orders')

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
  <!-- search review orders start -->
  <section class="users-list-wrapper">
    <!-- Search review orders start -->
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Search</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <div class="users-list-filter">
            <form id="revwosrderSearchForm">
              <div class="row">
                <div class="col-9 col-sm-12 col-lg-12 mb-2">
                  <ul class="list-unstyled mb-0">
                    <li class="d-inline-block mr-2">
                      <fieldset>
                        <div class="vs-radio-con">
                          <label for="searchBy" class="font-medium-1">Search By:</label>
                        </div>
                      </fieldset>
                    </li>
                    <li class="d-inline-block mr-2">
                      <fieldset>
                        <div class="vs-radio-con">
                          <input type="radio" name="SearchBy" checked value="order id">
                          <span class="vs-radio">
                            <span class="vs-radio--border"></span>
                            <span class="vs-radio--circle"></span>
                          </span>
                          <span>Order ID</span>
                        </div>
                      </fieldset>
                    </li>
                    <li class="d-inline-block mr-2">
                      <fieldset>
                        <div class="vs-radio-con">
                          <input type="radio" name="SearchBy" value="service provider">
                          <span class="vs-radio">
                            <span class="vs-radio--border"></span>
                            <span class="vs-radio--circle"></span>
                          </span>
                          <span>Service Provider</span>
                        </div>
                      </fieldset>
                    </li>
                    <li class="d-inline-block">
                      <fieldset>
                        <div class="vs-radio-con">
                          <input type="radio" name="SearchBy" value="user">
                          <span class="vs-radio">
                            <span class="vs-radio--border"></span>
                            <span class="vs-radio--circle"></span>
                          </span>
                          <span class="">User</span>
                        </div>
                      </fieldset>
                    </li>
                  </ul>
                </div>
                <div class="col-9 col-sm-6 col-lg-3">
                  <div id="tex" class="form-group">
                    <div class="controls">
                      <input type="text" id="search-text" class="form-control"
                             data-validation-required-message="This field is required" placeholder="Search text"
                             aria-invalid="false">
                      <div class="help-block"></div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                  <button type="submit" id="search_btn" class="btn btn-primary waves-effect waves-light">Search</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Search review orders end -->
    <!-- Ag Grid review orders section start -->
    <div id="basic-examples">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="ag-grid-btns d-flex justify-content-between flex-wrap mb-1">
                  <div class="dropdown sort-dropdown mb-1 mb-sm-0">
                    <button class="btn btn-white filter-btn dropdown-toggle border text-dark" type="button"
                            id="dropdownMenuButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      1 - 20 of 50
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton6">
                      <a class="dropdown-item" href="#">20</a>
                      <a class="dropdown-item" href="#">50</a>
                    </div>
                  </div>
                  <div class="ag-btns d-flex flex-wrap">
                    <input type="text" class="ag-grid-filter form-control mr-1 mb-1 mb-sm-0" id="filter-text-box"
                           placeholder="Search...."/>
                    {{-- <div class="action-btns">
                      <div class="btn-dropdown ">
                        <div class="btn-group dropdown actions-dropodown">
                          <button type="button"
                                  class="btn btn-white px-2 py-75 dropdown-toggle waves-effect waves-light"
                                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                          </button>
                          <div class="dropdown-menu">
                            <button type="button" id="Aggrid-deleteAll-btn" class="dropdown-item w-100"><i class="feather icon-trash-2 font-medium-1"></i> Delete</button>
                            <button type="button" id="Aggrid-print-btn" class="dropdown-item w-100"><i class="feather icon-printer font-medium-1"></i> Print</button>
                            <button type="button" id="Aggrid-export-btn" class="dropdown-item w-100"><i class="feather icon-download font-medium-1"></i> CSV</button>
                          </div>
                        </div>
                      </div>
                    </div> --}}
                  </div>
                </div>
              </div>
            </div>

            <div id="myGrid-revworder" class="aggrid ag-theme-material"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- Ag Grid review orders section end -->

  </section>
  <!-- review orders ends -->
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/tables/ag-grid/ag-grid-community.min.noStyle.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('vendors/js/forms/validation/jqBootstrapValidation.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/validation/form-validation.js')) }}"></script>
  <script src="{{ asset('js/scripts/ui/review-orders.js') }}"></script>
  <script src="{{ asset(mix('js/scripts/modal/components-modal.js')) }}"></script>
  <script src="{{ asset('js/scripts/extensions/sweetalert2.js')}}"></script>
@endsection
