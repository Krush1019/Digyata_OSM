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
		
      <div class="container margin_60_40">
         <div class="row justify-content-center">
                  <div class="col-lg-8">
                        <div class="box_general write_review">
                              <h1 class="add_bottom_15">Write a review for "Service Provider Name"</h1>

                              <label class="d-block add_bottom_15">Overall rating</label>
                              <div class="row">
                                    <div class="col-md-3 add_bottom_25">
                                       <div class="add_bottom_15">Response time <strong class="food_quality_val"></strong></div>
                               <input type="range" min="0" max="10" step="1" value="0" data-orientation="horizontal" id="food_quality" name="food_quality">
                                    </div>
                                    <div class="col-md-3 add_bottom_25">
                                          <div class="add_bottom_15">Service <strong class="service_val"></strong></div>
                               <input type="range" min="0" max="10" step="1" value="0" data-orientation="horizontal" id="service" name="service">
                                    </div>
                                    <div class="col-md-3 add_bottom_25">
                                          <div class="add_bottom_15">Communication <strong class="location_val"></strong></div>
                               <input type="range" min="0" max="10" step="1" value="0" data-orientation="horizontal" id="location" name="location">
                                    </div>
                                    <div class="col-md-3 add_bottom_25">
                                          <div class="add_bottom_15">Price <strong class="price_val"></strong></div>
                               <input type="range" min="0" max="10" step="1" value="0" data-orientation="horizontal" id="price" name="price">
                                    </div>
                              </div>
                              
                              <div class="form-group">
                                    <label>Title of your review</label>
                                    <input class="form-control" type="text" placeholder="If you could say it in one sentence, what would you say?">
                              </div>
                              <div class="form-group">
                                    <label>Your review</label>
                                    <textarea class="form-control" style="height: 180px;" placeholder="Write your review to help others learn about this online business"></textarea>
                              </div>
                              <div class="form-group">
                                    <label>Add photo (optional)</label>
                                    <div class="fileupload"><input type="file" name="fileupload" accept="image/*"></div>
                              </div>
                              <button id="review-submit-btn" class="btn_1">Submit review</button>
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
      <script src="{{ asset('js/scripts/extensions/sweetalert2.js')}}"></script>
      <script src="{{ asset('client_user/user/scripts/user-review.js') }}"></script>
@endsection
