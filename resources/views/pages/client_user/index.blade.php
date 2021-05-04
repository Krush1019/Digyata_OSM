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
    <div id="poster" class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-5 order-lg-1 order-12 slide-text pl-lg-5 my-2 my-lg-0 text-center text-lg-left">
                <h1>Find a Professional</h1>
                <p>Book a Consultation</p>
                <form id="search-service" method="get" action="{{route('client-listing')}}" class="mb-5 mb-lg-0">
                    <div class="row no-gutters custom-search-input w-75 align-content-center">
                        <div class="col-md-9">
                            <div class="form-group">
                                <input class="form-control" list="services" placeholder="Find a professional...">
                                <datalist id="services">
                                    @foreach ($catalogs as $catalog)
                                    <option value="{{$catalog->serviceName}}"
                                        data-link="{{route('service.filter',['id'=>encrypt($catalog->id)])}}"></option>
                                    @endforeach
                                </datalist>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <input type="submit" value="Find">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-7 order-lg-12 order-1 hero_single version_2">
            </div>
        </div>
    </div>

    <div class="bg_gray">
        <div class="container margin_60_40">
            <div class="main_title center">
                <span><em></em></span>
                <h2>Popular Services</h2>
                <p>Quality Home Services</p>
            </div>
            <div id="service-carousel" class="owl-carousel owl-theme categories_carousel add_bottom_45">
                @foreach ($catalogs as $catalog)
                <div class="item">
                    <a href="{{route('service.filter',['id'=>encrypt($catalog->id)])}}">
                        <span>@if ($catalog->serCount>100)
                            100+
                            @else{{$catalog->serCount}}@endif</span>
                        <img src="{{asset('storage/'.$catalog->serviceImage)}}"
                            data-src="{{asset('storage/'.$catalog->serviceImage)}}" alt="" class="owl-lazy">
                        <div class="info">
                            <h3>{{$catalog->serviceName}}</h3>
                            <small>{{$catalog->serviceCategory}}</small>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

        </div>
    </div>
    <!-- /container -->
    <div>
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
                            <img src="{{asset($service->ser_photo)}}" data-src="{{asset($service->ser_photo)}}"
                                class="img-fluid lazy" alt="">
                            <a href="{{route('client-detail',['id' => encrypt($service->ser_id)])}}" class="strip_info">
                                <div class="item_title">
                                    <h3>{{$service->ser_pro_name}}</h3>
                                    <small>{{$service->serviceName}}</small>
                                </div>
                            </a>
                        </figure>
                        <ul>
                            <li><a class="tooltip-1" data-toggle="tooltip" data-placement="bottom"
                                    title="{{$service->user_ser_exp}} experiance"><i
                                        class="icon_datareport_alt"></i></a>
                            </li>
                            <li><a class="tooltip-1" data-toggle="tooltip" data-placement="bottom"
                                    title="{{$service->ser_address}}"><i
                                        class="text-black-50 font-size-medium">{{$service->ser_city}}</i></a></li>
                            <li>
                                @php
                                $avg =
                                round((round($service->Res_R1,1)+round($service->Ser_R2,1)+round($service->Com_R3,1)+round($service->Price_R4,1))/4,1);
                                @endphp
                                <div class="score"><span>@if ($avg>=4)
                                        superb
                                        @elseif ($avg>=3)
                                        Very Good
                                        @elseif ($avg>=2)
                                        Good
                                        @elseif ($avg>=1)
                                        Pleasant
                                        @elseif ($avg<1) Noob @endif <em>{{$service->revCount}}
                                            Reviews</em></span><strong>{{$avg}}</strong>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- /row -->
            <p class="text-center add_top_30"><a href="{{route('client-listing')}}" class="btn_1 medium">Start
                    Searching</a>
            </p>
        </div>
        <!-- /container -->
    </div>

    <div class="bg_gray">
        <div class="container margin_60_40">
            <div class="main_title center add_bottom_10">
                <span><em></em></span>
                <h2>How does it works?</h2>
            </div>
            <div class="row justify-content-md-center how_2">
                <div class="col-lg-5 text-center">
                    <figure>
                        <img alt="" class="img-fluid lazy" data-src="{{asset('client_user/img/web_wireframe.svg')}}"
                            height="380" src="{{asset('client_user/img/web_wireframe.svg')}}" width="360">
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
                    <p>Join Us to increase your online visibility. You'll have access to even more customers who are
                        looking to
                        professional service or consultation.</p>
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