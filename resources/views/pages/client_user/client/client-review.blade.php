@extends('layouts.client_user.client-contentLayoutMaster')

@section('title','Client Review')

@section('page-style')
<link href="{{asset('client_user/client/css/animate.min.css')}}" rel="stylesheet">
<link href="{{asset('client_user/client/css/magnific-popup.css')}}" rel="stylesheet">
@endsection

@section('custom-style')
<link href="{{asset('client_user/client/css/custom.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="box_general">
  <div class="header_box">
    <h2 class="d-inline-block">Reviews List</h2>
    {{-- <div class="filter">
        <select name="orderby" class="selectbox">
          <option value="Any time">Any time</option>
          <option value="Latest">Latest</option>
          <option value="Oldest">Oldest</option>
        </select>
      </div> --}}
  </div>
  <div class="list_general reviews">
    <ul class="review-ul">
      @if (!$reviews->first())
      <div class="box_general box padding_bottom text-center">
        <div class="row h-100">
          <div class="col-sm-12 my-auto">
            <div class="mx-auto">
              <div class="align-middle">
                <span class="font-weight-bolder text-dark font-large-30 float-none">You haven't get any Reviews
                  yet!!</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      @else
      @foreach ($reviews as $review)
      <li>
        <div class="row">
          <div class="col-sm-9">
            <div class="font-weight-bold font-large-20">RM Cleaners</div><label class="mb-0"><small>Cleaning</small></label>
            
          </div>
          <div class="col-sm-3">
            <span class="mt-1 mt-sm-0 float-sm-right">on {{date_format(date_create($review->created_at),"M d Y")}}</span>
          </div>
        </div>
        <div class="row mb-4 mb-md-3">
          <div class="col-md-5">
            <div class="font-weight-bold font-large-17 mt-2 mb-10"><small>by</small> {{$review->sUserName}}</div>
          </div>
          <div class="col-md-7">
            <div class="row d-flex align-items-center">
              <div class="col-sm-9 reviews_sum_details">
                <div class="row">
                  <div class="col-md-6">
                    <label>Response time</label>
                    <div class="row">
                      <div class="col-xl-10 col-lg-9 col-9">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90"
                            aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                      <div class="col-xl-2 col-lg-3 col-3"><strong>9.0</strong></div>
                    </div>
                    <!-- /row -->
                    <label>Service</label>
                    <div class="row">
                      <div class="col-xl-10 col-lg-9 col-9">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: 95%" aria-valuenow="95"
                            aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                      <div class="col-xl-2 col-lg-3 col-3"><strong>9.5</strong></div>
                    </div>
                    <!-- /row -->
                  </div>
                  <div class="col-md-6">
                    <label>Communication</label>
                    <div class="row">
                      <div class="col-xl-10 col-lg-9 col-9">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60"
                            aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                      <div class="col-xl-2 col-lg-3 col-3"><strong>6.0</strong></div>
                    </div>
                    <!-- /row -->
                    <label>Price</label>
                    <div class="row">
                      <div class="col-xl-10 col-lg-9 col-9">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60"
                            aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                      <div class="col-xl-2 col-lg-3 col-3"><strong>6.0</strong></div>
                    </div>
                    <!-- /row -->
                  </div>
                </div>
                <!-- /row -->
              </div>
              <div class="col-sm-3 align-self-center">
                <div id="review_summary">
                  <strong>8.5</strong>
                  <em>Superb</em>
                  <small>Based on 4 reviews</small>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-9">
            <p class="font-weight-bold font-large-17 mb-1">{{$review->Title}}</p>
            <div class="mt-0 text-justify">{{$review->Feedback}}</div>
          </div>  
          @if($review->Image)
          <div class="col-md-3 mt-sm-0 mt-15 text-center">
            <img class="img-fluid img-thumbnail float-md-right mb-10 w-auto" src="{{asset('storage/'.$review->Image)}}"
              height="130px">
          </div>
          @endif
        </div>
      </li>
      @endforeach
      @endif

    </ul>
  </div>
</div>
<!-- /box_general-->
{{-- <nav aria-label="...">
    <ul class="pagination pagination-sm add_bottom_30">
      <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Previous</a></li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item"><a class="page-link" href="#">Next</a></li>
    </ul>
  </nav> --}}
<!-- /pagination-->
<!-- Reply to review popup -->
{{-- <div id="modal-reply" class="white-popup mfp-with-anim mfp-hide">
  <div class="small-dialog-header">
    <h3>Reply to review</h3>
  </div>
  <div class="message-reply margin-top-0">
    <div class="form-group">
      <textarea cols="40" rows="3" class="form-control"></textarea>
    </div>
    <button class="btn_1">Reply</button>
  </div>
</div> --}}
@endsection

@section('page-script')
<script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('client_user/client/js/page-scripts/client-review.js')}}"></script>
@endsection