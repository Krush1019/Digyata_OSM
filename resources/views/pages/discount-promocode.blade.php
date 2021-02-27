@extends('layouts/contentLayoutMaster')

@section('title', 'Discount & Promo Code')

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
  <!-- Discount & promocode start -->
  <section class="users-list-wrapper">
    {{--<!-- users filter start -->
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Filters</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <div class="users-list-filter">
            <form>
              <div class="row">
                <div class="col-12 col-sm-6 col-lg-3">
                  <label for="filter-state">State</label>
                  <fieldset class="form-group">
                    <select class="form-control" id="filter-state">
                      <option value="">All</option>
                      <option value="true">Yes</option>
                      <option value="false">No</option>
                    </select>
                  </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                  <label for="filter-city">City</label>
                  <fieldset class="form-group">
                    <select class="form-control" id="filter-city">
                      <option value="">All</option>
                      <option value="user">User</option>
                      <option value="staff">Staff</option>
                    </select>
                  </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                  <label for="filter-services">Services</label>
                  <fieldset class="form-group">
                    <select class="form-control" id="filter-services">
                      <option value="">All</option>
                      <option value="Sales">Sales</option>
                      <option value="Devlopment">Devlopment</option>
                      <option value="Management">Management</option>
                    </select>
                  </fieldset>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                  <label for="filter-status">Status</label>
                  <fieldset class="form-group">
                    <select class="form-control" id="filter-status">
                      <option value="">All</option>
                      <option value="Enable">Enable</option>
                      <option value="Disable">Disable</option>
                    </select>
                  </fieldset>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- users filter end -->--}}
    <!-- Ag Grid Discount & promocode section start -->
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
                    <button type="button" data-toggle="modal" data-target="#promocodeFormDiv" class="btn btn-icon btn-icon rounded-1 ml-1 btn-outline-primary font-medium-1 btn-flat-primary waves-effect waves-light ">
                      <i class="feather mr-1 icon-plus-square"></i>New Promo Code
                    </button>
                  </div>
                  <div class="ag-btns d-flex flex-wrap">
                    <input type="text" class="ag-grid-filter form-control w-50 mr-1 mb-1 mb-sm-0" id="filter-text-box" placeholder="Search...." />
                    <div class="action-btns">
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
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div id="myGrid-discountPromo" class="aggrid ag-theme-material"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- Ag Grid Discount & promocode section end -->

    {{-- START: Model --}}
    <div class="modal fade text-left" id="promocodeFormDiv" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="form">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="promocodeFormModel">Add Promo Code Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form action="javaScript:void(0)" id="addPromocodeForm" method="post" novalidate>
            <div class="modal-body">
              <div class="form-group">
                <div class="controls">
                  <label for="promocode-name">Promo-Code Name: </label>
                  <input type="text" name="pmc_Name" id="promocode-name" placeholder="Promo-Code Name" class="form-control" data-validation-required-message="This field is required" aria-invalid="false">
                </div>
              </div>
              <div class="form-group">
                <ul class="list-unstyled mb-0">
                  <li class="d-inline-block mr-2">
                    <fieldset>
                      <div class="vs-radio-con">
                        <label for="pmc_Type">Type:</label>
                      </div>
                    </fieldset>
                  </li>
                  <li class="d-inline-block mr-2">
                    <fieldset>
                      <div class="vs-radio-con">
                        <input type="radio" name="pmc_Type" checked value="regular">
                        <span class="vs-radio">
                            <span class="vs-radio--border"></span>
                            <span class="vs-radio--circle"></span>
                          </span>
                        <span>Regular</span>
                      </div>
                    </fieldset>
                  </li>
                  <li class="d-inline-block mr-2">
                    <fieldset>
                      <div class="vs-radio-con">
                        <input type="radio" name="pmc_Type" value="first">
                        <span class="vs-radio">
                            <span class="vs-radio--border"></span>
                            <span class="vs-radio--circle"></span>
                          </span>
                        <span>First</span>
                      </div>
                    </fieldset>
                  </li>
                  <li class="d-inline-block">
                    <fieldset>
                      <div class="vs-radio-con">
                        <input type="radio" name="pmc_Type" value="once">
                        <span class="vs-radio">
                            <span class="vs-radio--border"></span>
                            <span class="vs-radio--circle"></span>
                          </span>
                        <span>Once</span>
                      </div>
                    </fieldset>
                  </li>
                </ul>
              </div>
              <div class="form-group">
                <div class="controls">
                  <label for="promocode-discount">Discount: </label>
                  <input type="text" name="pmc_Discount" id="promocode-discount"
                         placeholder="Discount" class="form-control"
                         data-validation-required-message="This field is required"
                         data-validation-containsnumber-regex="^[0-9]+(\.[0-9]{1,2})?$"
                         data-validation-containsnumber-message="The numeric field may only contain numeric characters."
                         required aria-invalid="false">
                </div>
              </div>
              <div class="form-group">
                <div class="controls">
                  <label for="promocode-minamt">Min Amount: </label>
                  <input type="text" name="pmc_MinAmt" id="promocode-minamt" placeholder="Min Amount" class="form-control"
                         data-validation-required-message="This field is required"
                         data-validation-containsnumber-regex="^[0-9]+(\.[0-9]{1,2})?$"
                         data-validation-containsnumber-message="The numeric field may only contain numeric characters."
                         required aria-invalid="false">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" id="promocode-submitbtn" class="btn btn-outline-primary waves-effect waves-light" autofocus data-action="insert">Add Promo-Code</button>
              <button type="button" id="promocode-dismiss" class="btn btn-outline-danger waves-effect waves-light" data-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    {{-- END: Model --}}
  </section>
  <!-- Discount & promocode ends -->
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/tables/ag-grid/ag-grid-community.min.noStyle.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('vendors/js/forms/validation/jqBootstrapValidation.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/validation/form-validation.js')) }}"></script>
  <script src="{{ asset('js/scripts/ui/discount-promocode.js') }}"></script>
  <script src="{{ asset(mix('js/scripts/modal/components-modal.js')) }}"></script>
  <script src="{{ asset('js/scripts/extensions/sweetalert2.js')}}"></script>
@endsection
