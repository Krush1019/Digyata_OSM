@extends('layouts.client_user.contentLayoutMaster')

@section('title','HomePage')

@section('specific-style')
  <link href="{{asset('client_user/css/home.css')}}" rel="stylesheet">
@endsection

@section('custom-style')
  <link href="{{asset('client_user/css/custom.css')}}" rel="stylesheet">
@endsection

@section('header-class', 'header clearfix element_to_stick')
@section('content')
<main>
  <div id="carousel-home">
    <div class="owl-carousel owl-theme">
      <div class="owl-slide cover" style="background-image: url({{asset('client_user/img/slides/slide_home_1.jpg')}})">
        <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.2)">
          <div class="container">
            <div class="row justify-content-center justify-content-md-start">
              <div class="col-lg-12 static">
                <div class="slide-text text-center white">
                  <h2 class="owl-slide-animated owl-slide-title">Find a Professional</h2>
                  <p class="owl-slide-animated owl-slide-subtitle">
                    Book a Consultation
                  </p>
                  <div class="owl-slide-animated owl-slide-cta"><a class="btn_1" href="{{route('client-listing')}}" role="button">Find Now</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/owl-slide-->
      <div class="owl-slide cover" style="background-image: url({{asset('client_user/img/slides/slide_home_2.jpg')}})">
        <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.2)">
          <div class="container">
            <div class="row justify-content-center justify-content-md-start">
              <div class="col-lg-7 static">
                <div class="slide-text white">
                  <h2 class="owl-slide-animated owl-slide-title">Only Verified Professionals</h2>
                  <p class="owl-slide-animated owl-slide-subtitle">
                    More than +1,000 trusted professionals listed
                  </p>
                  <div class="owl-slide-animated owl-slide-cta"><a class="btn_1" href="{{route('client-listing')}}" role="button">view More</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/owl-slide-->
      <div class="owl-slide cover" style="background-image: url({{asset('client_user/img/slides/slide_home_3.jpg')}})">
        <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.2)">
          <div class="container">
            <div class="row justify-content-center justify-content-md-end">
              <div class="col-lg-6 static">
                <div class="slide-text text-right white">
                  <h2 class="owl-slide-animated owl-slide-title">Are you a Professional?</h2>
                  <p class="owl-slide-animated owl-slide-subtitle">
                    Join to Digyata for Free and get more visibility
                  </p>
                  <div class="owl-slide-animated owl-slide-cta"><a class="btn_1" href="{{route('client.register')}}" role="button">Join Now</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/owl-slide-->
      </div>
    </div>
    <div id="icon_drag_mobile"></div>
  </div>
  <!--/carousel-->

  <div class="bg_gray">
    <div class="container margin_60_40">
      <div class="main_title center">
        <span><em></em></span>
        <h2>Popular Professionals</h2>
        <p>Expert Professionals At Your Doorsteps</p>
      </div>
      <div class="row">
      @foreach ($services as $service)
      <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
          <div class="strip">
            <figure>
              <img src="{{asset($service->ser_photo)}}" data-src="{{asset($service->ser_photo)}}" class="img-fluid lazy" alt="">
              <a href="{{route('client-detail',['id' => encrypt($service->ser_id)])}}" class="strip_info">
                <div class="item_title">
                  <h3>{{$service->ser_pro_name}}</h3>
                  <small>{{$service->serviceName}}</small>
                </div>
              </a>
            </figure>
            <ul>
              <li><a class="tooltip-1" data-toggle="tooltip" data-placement="bottom" title="{{$service->user_ser_exp}} experiance"><i class="icon_datareport_alt"></i></a></li>
              <li><a class="tooltip-1" data-toggle="tooltip" data-placement="bottom" title="{{$service->ser_address}}"><i class="text-black-50 font-size-medium">{{$service->ser_city}}</i></a></li>
              <li>
                @php
                $avg = round((round($service->Res_R1,1)+round($service->Ser_R2,1)+round($service->Com_R3,1)+round($service->Price_R4,1))/4,1);
                @endphp
                <div class="score"><span>@if ($avg>=4)
                  superb
                @elseif ($avg>=3)
                Very Good
                @elseif ($avg>=2)
                Good
                @elseif ($avg>=1)
                Pleasant
                @elseif ($avg<1)
                Noob
                @endif
                <em>{{$service->revCount}} Reviews</em></span><strong>{{$avg}}</strong></div>
              </li>
            </ul>
          </div>
        </div>
      @endforeach
      </div>
      <!-- /row -->
      <p class="text-center add_top_30"><a href="{{route('client-listing')}}" class="btn_1 medium">Start Searching</a></p>
    </div>
    <!-- /container -->
  </div>
  <!-- /bg_gray -->
  <div class="container margin_60_40">
    <div class="main_title center">
      <span><em></em></span>
      <h2>Popular Services</h2>
      <p>Quality Home Services</p>
    </div>
    <!-- /main_title -->
    <div class="owl-carousel owl-theme categories_carousel add_bottom_45">
      @foreach ($catalogs as $catalog)
      <div class="item_version_2">
        <a href="{{route('service.filter',['id'=>encrypt($catalog->id)])}}">
          <figure>
            <span>@if ($catalog->serCount>100)
              100+
            @else{{$catalog->serCount}}@endif</span>
            <img src="{{asset('storage/'.$catalog->serviceImage)}}" data-src="{{asset('storage/'.$catalog->serviceImage)}}" alt="" class="owl-lazy">
            <div class="info">
              <h3>{{$catalog->serviceName}}</h3>
            </div>
          </figure>
        </a>
      </div>
      @endforeach
    </div>
    <!-- /carousel -->

  </div>
  <!-- /container -->

  <div class="bg_gray">
    <div class="container margin_60_40">
      <div class="main_title center add_bottom_10">
        <span><em></em></span>
        <h2>How does it works?</h2>
      </div>
      <div class="row justify-content-md-center how_2">
        <div class="col-lg-5 text-center">
          <figure>
            <img alt=""
                 class="img-fluid lazy" data-src="{{asset('client_user/img/web_wireframe.svg')}}" height="380" src="{{asset('client_user/img/web_wireframe.svg')}}" width="360">
          </figure>
        </div>
        <div class="col-lg-5">
          <ul>
            <li>
              <h3><span>#01.</span> Search for a Professional</h3>
              <p>Search over 1,000 verifyed professionals that match your criteria.</p>
            </li>
            <li>
              <h3><span>#02.</span> View Professional Profile</h3>
              <p>View professional introduction and read reviews from other customers.</p>
            </li>
            <li>
              <h3><span>#03.</span> Enjoy the Consultation</h3>
              <p>Connect with your professional booking an appointment.</p>
            </li>
          </ul>
          <p class="add_top_30"><a href="{{route('client-listing')}}" class="btn_1">Start Searching</a></p>
        </div>
        <!-- /row -->
      </div>
    </div>
    <!-- /container -->
  </div>
  <!-- /bg_gray -->

  <div class="call_section version_2 lazy" data-bg="url({{asset('client_user/img/index-register.jpg')}})">
    <div class="container clearfix">
      <div class="col-lg-5 col-md-6 float-right wow">
        <div class="box_1">
          <div class="ribbon_promo"><span>Free</span></div>
          <h3>Are you a Professional?</h3>
          <p>Join Us to increase your online visibility. You'll have access to even more customers who are looking to professional service or consultation.</p>
          <a href="{{route('client.register')}}" class="btn_1">Join Now</a>
        </div>
      </div>
    </div>
  </div>
  <!--/call_section-->

</main>
@endsection

@section('page-script')
<script src="{{asset('client_user/js/UI/index.js')}}"></script>
@endsection
