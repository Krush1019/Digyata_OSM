@extends('layouts.client_user.contentLayoutMaster')

@section('title','Client Listing')

@section('specific-style')
  <link href="{{asset('client_user/css/listing.css')}}" rel="stylesheet">
@endsection

@section('custom-style')
  <link href="{{asset('client_user/css/custom.css')}}" rel="stylesheet">
@endsection

@section('header-class', 'header header_in clearfix')

@section('content')
  <main class="bg_color">

    <div class="filters_full element_to_stick">
      <div class="container clearfix d-inline-flex d-md-block">
        <div class="sort_select mr-1 w-auto">
          <select name="SL_service" id="SL_service" class="form-control">
            <option value="all" selected disabled>all</option>
            <option value="Dusting">Dusting</option>
            <option value="Painting">Painting</option>
            <option value="Electric service">Electric service</option>
            <option value="carpentering">carpentering</option>
            <option value="pest Controlling">pest Control service</option>
          </select>
        </div>
        <a href="#collapseFilters" data-toggle="collapse" class="btn_filters dor"><i class="icon_adjust-vert"></i><span>Filters</span></a>
        <div class="search_bar_list">
          <input type="text" class="form-control search-input" placeholder="Search again...">
        </div>
        <a class="btn_search_mobile btn_filters" data-toggle="collapse" href="#collapseSearch"><i
            class="icon_search"></i></a>
      </div>
      <div class="collapse filters_2" id="collapseFilters">
        <div class="container margin_detail">
          <div class="row">
            <div class="col-12">
              <div class="filter_type">
                <h6>Rating</h6>
                <ul>
                  <li class="list-inline-item float-sm-none float-left">
                    <label class="container_check">Superb 4+
                      <input type="checkbox">
                      <span class="checkmark"></span>
                    </label>
                  </li>
                  <li class="list-inline-item float-sm-none float-right">
                    <label class="container_check">Very Good 3+
                      <input type="checkbox">
                      <span class="checkmark"></span>
                    </label>
                  </li>
                  <li class="list-inline-item float-sm-none float-left">
                    <label class="container_check">Good 2+
                      <input type="checkbox">
                      <span class="checkmark"></span>
                    </label>
                  </li>
                  <li class="list-inline-item float-sm-none float-right rate-mr-3_75">
                    <label class="container_check">Pleasant 1+
                      <input type="checkbox">
                      <span class="checkmark"></span>
                    </label>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!-- /row -->
        </div>
      </div>
      <!-- /filters -->
      <div class="collapse" id="collapseSearch">
        <div class="search_bar_list">
          <input type="text" class="form-control search-input" placeholder="Search again...">
        </div>
      </div>
      <!-- /collapseSearch -->
    </div>
    <!-- /filters_full -->

    <div class="container margin_30_40">
      <div class="page_header">
        <span></span>
      </div>
      <!-- /page_header -->
      <div id="search-content" class="row">
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 search-item">
          <div class="strip">
            <figure>
              <img src="{{asset('client_user/img/elecrician-person.jpg')}}"
                   data-src="{{asset('client_user/img/elecrician-person.jpg')}}" class="img-fluid lazy" alt="">
              <a href="{{route('client-detail')}}" class="strip_info">
                <div class="item_title">
                  <h3>Ramesh Patel</h3>
                  <small>Electician</small>
                </div>
              </a>
            </figure>
            <ul>
              <li><a class="tooltip-1" data-toggle="tooltip" data-placement="bottom"
                     title="Available Appointment"><i class="icon-users"></i></a></li>
              <li><a class="tooltip-1" data-toggle="tooltip" data-placement="bottom" title="Available Chat"><i
                    class="icon-chat"></i></a></li>
              <li>
                <div class="score"><span>Superb<em>150 Reviews</em></span><strong>4.3</strong></div>
              </li>
            </ul>
          </div>
        </div>
        <!-- /strip grid -->
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 search-item">
          <div class="strip">
            <figure>
              <img src="{{asset('client_user/img/plumber-person.jpg')}}"
                   data-src="{{asset('client_user/img/plumber-person.jpg')}}" class="img-fluid lazy" alt="">
              <a href="{{route('client-detail')}}" class="strip_info">
                <div class="item_title">
                  <h3>Kapil Satavara</h3>
                  <small>Plumber</small>
                </div>
              </a>
            </figure>
            <ul>
              <li><a class="tooltip-1" data-toggle="tooltip" data-placement="bottom"
                     title="Available Appointment"><i class="icon-users"></i></a></li>
              <li><a class="tooltip-1" data-toggle="tooltip" data-placement="bottom" title="Available Chat"><i
                    class="icon-chat"></i></a></li>
              <li>
                <div class="score"><span>Superb<em>172 Reviews</em></span><strong>4.2</strong></div>
              </li>
            </ul>
          </div>
        </div>
        <!-- /strip grid -->
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 search-item">
          <div class="strip">
            <figure>
              <img src="{{asset('client_user/img/painter-person.jpg')}}"
                   data-src="{{asset('client_user/img/painter-person.jpg')}}" class="img-fluid lazy" alt="">
              <a href="{{route('client-detail')}}" class="strip_info">
                <div class="item_title">
                  <h3>Ankit Modi</h3>
                  <small>Painter</small>
                </div>
              </a>
            </figure>
            <ul>
              <li><a class="tooltip-1" data-toggle="tooltip" data-placement="bottom"
                     title="Available Appointment"><i class="icon-users"></i></a></li>
              <li><a class="tooltip-1" data-toggle="tooltip" data-placement="bottom" title="Available Chat"><i
                    class="icon-chat"></i></a></li>
              <li>
                <div class="score"><span>Superb<em>200 Reviews</em></span><strong>4.4</strong></div>
              </li>
            </ul>
          </div>
        </div>
        <!-- /strip grid -->
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 search-item">
          <div class="strip">
            <figure>
              <img src="{{asset('client_user/img/cleaner-person.jpg')}}"
                   data-src="{{asset('client_user/img/cleaner-person.jpg')}}" class="img-fluid lazy" alt="">
              <a href="{{route('client-detail')}}" class="strip_info">
                <div class="item_title">
                  <h3>Manubhai Khoja</h3>
                  <small>Cleaner</small>
                </div>
              </a>
            </figure>
            <ul>
              <li><a class="tooltip-1" data-toggle="tooltip" data-placement="bottom" title="Available Chat"><i
                    class="icon-users"></i></a></li>
              <li><a class="tooltip-1" data-toggle="tooltip" data-placement="bottom" title="Available Chat"><i
                    class="icon-chat"></i></a></li>
              <li>
                <div class="score"><span>Superb<em>300 Reviews</em></span><strong>4.1</strong></div>
              </li>
            </ul>
          </div>
        </div>
        <!-- /strip grid -->
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 search-item">
          <div class="strip">
            <figure>
              <img src="{{asset('client_user/img/pest_controller-person.jpg')}}"
                   data-src="{{asset('client_user/img/pest_controller-person.jpg')}}" class="img-fluid lazy" alt="">
              <a href="{{route('client-detail')}}" class="strip_info">
                <div class="item_title">
                  <h3>Umang Panchal</h3>
                  <small>Pest Controller, Fumigators</small>
                </div>
              </a>
            </figure>
            <ul>
              <li><a class="tooltip-1" data-toggle="tooltip" data-placement="bottom" title="Available Chat"><i
                    class="icon-users"></i></a></li>
              <li><a class="tooltip-1" data-toggle="tooltip" data-placement="bottom" title="Available Chat"><i
                    class="icon-chat"></i></a></li>
              <li>
                <div class="score"><span>Superb<em>140 Reviews</em></span><strong>4.2</strong></div>
              </li>
            </ul>
          </div>
        </div>
        <!-- /strip grid -->
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 search-item">
          <div class="strip">
            <figure>
              <img src="{{asset('client_user/img/carpenter-person.jpg')}}"
                   data-src="{{asset('client_user/img/carpenter-person.jpg')}}" class="img-fluid lazy" alt="">
              <a href="{{route('client-detail')}}" class="strip_info">
                <div class="item_title">
                  <h3>paresh Mistri</h3>
                  <small>Carpenter</small>
                </div>
              </a>
            </figure>
            <ul>
              <li><a class="tooltip-1" data-toggle="tooltip" data-placement="bottom"
                     title="Available Appointment"><i class="icon-users"></i></a></li>
              <li><a class="tooltip-1" data-toggle="tooltip" data-placement="bottom" title="Available Chat"><i
                    class="icon-chat"></i></a></li>
              <li>
                <div class="score"><span>Superb<em>200 Reviews</em></span><strong>4.3</strong></div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- /row -->
      <div class="pagination_fg">
        <a href="#">&laquo;</a>
        <a href="#" class="active">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
        <a href="#">&raquo;</a>
      </div>
    </div>
    <!-- /container -->

  </main>
  <!-- /main -->

@endsection

@section('specific-script')
  <script src="{{asset('client_user/js/sticky_sidebar.min.js')}}"></script>
  <script src="{{asset('client_user/js/specific_listing.min.js')}}"></script>
@endsection
<!-- SPECIFIC SCRIPTS -->

@section('page-script')
  <script src="{{asset('client_user/user/scripts/client-listing.js')}}"></script>
@endsection


