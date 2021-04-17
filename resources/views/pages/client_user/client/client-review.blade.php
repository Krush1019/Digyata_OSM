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
        <div class="d-block">
          <div class="d-block d-sm-inline-block font-large-20"><small>by</small> {{$review->sUserName}}</div>
          <div class="d-block d-sm-inline-block float-left float-sm-right">
            <span class="float-right">{{date_format(date_create($review->created_at),"M d Y")}}</span>
            <span class="rating mr-8" data-value="{{round((round($review->Res_R1,1)+round($review->Ser_R2,1)+round($review->Com_R3,1)+round($review->Price_R4,1))/4,1)}}"></span>
          </div>
        </div>
        <div class="d-inline-block">
        <p class="font-weight-bold font-large-15 mb-0 mt-2 ">{{$review->Title}}</p>
        <p class="mt-0">{{$review->Feedback}}</p>
        @if($review->Image)
        <figure id="revwfig-img"><img src="{{ asset('storage/'.$review->Image) }}" alt=""></figure>
        @endif
        <ul id="revw-Ul" class="list-unstyled w-75 w-sm-100">
          <li class="list-inline-item"><label class="mr-0 mr-sm-2">Respnse Time: </label><span class="rating" data-value="{{$review->Res_R1}}"></span></li>
          <li class="list-inline-item"><label class="mr-0 mr-sm-2">Service: </label><span class="rating" data-value="{{$review->Ser_R2}}"></span></li>
          <li class="list-inline-item"><label class="mr-0 mr-sm-2">Comunication: </label><span class="rating" data-value="{{$review->Com_R3}}"></span></li>
          <li class="list-inline-item"><label class="mr-0 mr-sm-2">Price: </label><span class="rating" data-value="{{$review->Price_R4}}"></span></li>
        </ul>
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
<div id="modal-reply" class="white-popup mfp-with-anim mfp-hide">
  <div class="small-dialog-header">
    <h3>Reply to review</h3>
  </div>
  <div class="message-reply margin-top-0">
    <div class="form-group">
      <textarea cols="40" rows="3" class="form-control"></textarea>
    </div>
    <button class="btn_1">Reply</button>
  </div>
</div>
@endsection

@section('page-script')
<script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('client_user/client/js/page-scripts/client-review.js')}}"></script>
@endsection
