@extends('layouts.client_user.contentLayoutMaster')

@section('title', 'User Review')

@section('specific-style')
<link href="{{ asset('client_user/css/review.css') }}" rel="stylesheet">
@endsection

@section('custom-style')
<link href="{{ asset('client_user/css/custom.css') }}" rel="stylesheet">
@endsection

@section('header-class', 'header header_in shadow clearfix')


@section('content')
<main class="bg_gray">
  @if ($errors->first())
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> {{$errors->first()}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  @endif
      <div class="container margin_60_40">
            <div class="row justify-content-center">
                  <div class="col-lg-8">
                        <div class="box_general write_review">
                              <form id="reviewForm" action="@if ($checkReview)
                              {{ route('review.update',['id'=>encrypt($checkReview->ser_id)]) }}
                              @else
                              {{ route('review.submit',['id'=>encrypt($serviceId)]) }}
                              @endif" method="POST" enctype="multipart/form-data">
                                    {{ @csrf_field() }}
                                    <h1 class="add_bottom_15">Write a review for
                                          "{{$service->ser_pro_name}}"</h1>
                                    <div class="row">
                                          <div class="col-md-3 col-sm-6 add_bottom_25">
                                                <div class="add_bottom_15">Response time <strong
                                                            class="food_quality_val"></strong></div>
                                                <input type="range" min="0" max="5" step="1"
                                                @if ($checkReview)
                                                value="{{$checkReview->Res_R1}}"
                                                @else
                                                value="0"
                                                @endif
                                                      data-orientation="horizontal" id="resp_revw"
                                                      name="resp_revw">

                                          </div>
                                          <div class="col-md-3 col-sm-6  add_bottom_25">
                                                <div class="add_bottom_15">Service <strong class="service_val"></strong>
                                                </div>
                                                <input type="range" min="0" max="5" step="1"
                                                @if ($checkReview)
                                                value="{{$checkReview->Ser_R2}}"
                                                @else
                                                value="0"
                                                @endif
                                                      data-orientation="horizontal" id="serv_revw" name="serv_revw">
                                          </div>
                                          <div class="col-md-3 col-sm-6  add_bottom_25">
                                                <div class="add_bottom_15">Communication <strong
                                                            class="location_val"></strong></div>
                                                <input type="range" min="0" max="5" step="1"
                                                @if ($checkReview)
                                                value="{{$checkReview->Com_R3}}"
                                                @else
                                                value="0"
                                                @endif
                                                      data-orientation="horizontal" id="comm_revw" name="comm_revw">
                                          </div>
                                          <div class="col-md-3 col-sm-6  add_bottom_25">
                                                <div class="add_bottom_15">Price <strong class="price_val"></strong>
                                                </div>
                                                <input type="range" min="0" max="5" step="1"
                                                @if ($checkReview)
                                                value="{{$checkReview->Price_R4}}"
                                                @else
                                                value="0"
                                                @endif
                                                      data-orientation="horizontal" id="price_revw" name="price_revw">
                                          </div>
                                    </div>

                                    <div class="form-group">
                                          <label for="revw_title">Title of your review</label>
                                          <input class="form-control" type="text" id="revw_title"
                                                @if ($checkReview)
                                                value="{{$checkReview->Title}}"
                                                @else
                                                value=""
                                                @endif
                                          name="revw_title"
                                                placeholder="If you could say it in one sentence, what would you say?">
                                    </div>
                                    <div class="form-group">
                                          <label for="revw_text">Your review</label>
                                          <textarea class="form-control" style="height: 120px;" id="revw_text" name="revw_text"
                                                placeholder="Write your review to help others learn about this online business">@if ($checkReview){{$checkReview->Feedback}}@endif</textarea>
                                    </div>
                                    <div class="form-group">
                                          <label for="revw_fileupload">Add photo (optional)</label>
                                          <div class="fileupload"><input type="file" name="revw_fileupload" id="revw_fileupload" accept="image/*">
                                          </div>
                                    </div>
                                    <button type="submit" id="review-submit-btn" class="btn_1">
                                      @if ($checkReview)
                                      Update Review
                                      @else
                                      Submit review
                                      @endif</button>
                              </form>
                        </div>
                  </div>
            </div>
            <!-- /row -->
      </div>
      <!-- /container -->

</main>
<!-- /main -->

@endsection

@section('specific-script')
<script src="{{ asset('client_user/js/specific_review.js') }}"></script>
@endsection

@section('page-script')
<script src="{{ asset('client_user/user/scripts/user-review.js') }}"></script>
@endsection
