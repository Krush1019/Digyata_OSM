@extends('layouts.client_user.contentLayoutMaster')

@section('title','User Dashboard')

@section('specific-style')
  <link href="{{asset('client_user/css/home.css')}}" rel="stylesheet">
@endsection

@section('custom-style')
  <link href="{{asset('client_user/css/custom.css')}}" rel="stylesheet">
@endsection

@section('top_menu_content')
<ul id="top_menu" class="drop_user">
  <li>
    <div class="dropdown user clearfix">
      <a href="#" data-toggle="dropdown">
        <figure><img src="{{asset('client_user/img/avatar1.jpg')}}" alt=""></figure>Jhon Doe
      </a>
      <div class="dropdown-menu">
        <div class="dropdown-menu-content">
          <ul>
            <li><a href="#0"><i class="icon_cog"></i>Dashboard</a></li>
            <li><a href="#0"><i class="icon_document"></i>Bookings</a></li>
            <li><a href="#0"><i class="icon_mail"></i>Messages</a></li>
            <li><a href="#0"><i class="icon_key"></i>Log out</a></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /dropdown -->
  </li>
</ul>
@endsection

@section('content')
  <main>
    <div id="carousel-home">
      <div class="owl-carousel owl-theme">
        <div class="owl-slide cover" style="background-image: url({{asset('client_user/img/slides/slide_home_1.jpg')}})">
          <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.6)">
            <div class="container">
              <div class="row justify-content-center justify-content-md-start">
                <div class="col-lg-12 static">
                  <div class="slide-text text-center white">
                    <h2 class="owl-slide-animated owl-slide-title">Find a Professional</h2>
                    <p class="owl-slide-animated owl-slide-subtitle">
                      Book a Consultation by Appointment or Chat
                    </p>
                    <div class="owl-slide-animated owl-slide-cta"><a class="btn_1" href="grid-listing-1.html" role="button">Read more</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/owl-slide-->
        <div class="owl-slide cover" style="background-image: url({{asset('client_user/img/slides/slide_home_2.jpg')}})">
          <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
            <div class="container">
              <div class="row justify-content-center justify-content-md-start">
                <div class="col-lg-7 static">
                  <div class="slide-text white">
                    <h2 class="owl-slide-animated owl-slide-title">Only Verified Professionals</h2>
                    <p class="owl-slide-animated owl-slide-subtitle">
                      More than +1,000 trusted professionals listed
                    </p>
                    <div class="owl-slide-animated owl-slide-cta"><a class="btn_1" href="grid-listing-1.html" role="button">Read more</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/owl-slide-->
        <div class="owl-slide cover" style="background-image: url({{asset('client_user/img/slides/slide_home_3.jpg')}})">
          <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.6)">
            <div class="container">
              <div class="row justify-content-center justify-content-md-end">
                <div class="col-lg-6 static">
                  <div class="slide-text text-right white">
                    <h2 class="owl-slide-animated owl-slide-title">Are you a Professional?</h2>
                    <p class="owl-slide-animated owl-slide-subtitle">
                      Join to Digyata for Free and get more visibility
                    </p>
                    <div class="owl-slide-animated owl-slide-cta"><a class="btn_1" href="submit-professional.html" role="button">Read more</a></div>
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
          <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <div class="strip">
              <figure>
                <a href="#0" class="wish_bt"><i class="icon_heart"></i></a>
                <img src="{{asset('client_user/img/elecrician-person.jpg')}}" data-src="{{asset('client_user/img/elecrician-person.jpg')}}" class="img-fluid lazy" alt="">
                <a href="detail-page.html" class="strip_info">
                  <div class="item_title">
                    <h3>Ramesh Patel</h3>
                    <small>Electician</small>
                  </div>
                </a>
              </figure>
              <ul>
                <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="bottom" title="Available Appointment"><i class="icon-users"></i></a></li>
                <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="bottom" title="Available Chat"><i class="icon-chat"></i></a></li>
                <li>
                  <div class="score"><span>Superb<em>150 Reviews</em></span><strong>4.3</strong></div>
                </li>
              </ul>
            </div>
          </div>
          <!-- /strip grid -->
          <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <div class="strip">
              <figure>
                <a href="#0" class="wish_bt"><i class="icon_heart"></i></a>
                <img src="{{asset('client_user/img/plumber-person.jpg')}}" data-src="{{asset('client_user/img/plumber-person.jpg')}}" class="img-fluid lazy" alt="">
                <a href="detail-page.html" class="strip_info">
                  <div class="item_title">
                    <h3>Kapil Satavara</h3>
                    <small>Plumber</small>
                  </div>
                </a>
              </figure>
              <ul>
                <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="bottom" title="Available Appointment"><i class="icon-users"></i></a></li>
                <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="bottom" title="Available Chat"><i class="icon-chat"></i></a></li>
                <li>
                  <div class="score"><span>Superb<em>172 Reviews</em></span><strong>4.2</strong></div>
                </li>
              </ul>
            </div>
          </div>
          <!-- /strip grid -->
          <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <div class="strip">
              <figure>
                <a href="#0" class="wish_bt"><i class="icon_heart"></i></a>
                <img src="{{asset('client_user/img/painter-person.jpg')}}" data-src="{{asset('client_user/img/painter-person.jpg')}}" class="img-fluid lazy" alt="">
                <a href="detail-page.html" class="strip_info">
                  <div class="item_title">
                    <h3>Ankit Modi</h3>
                    <small>Painter</small>
                  </div>
                </a>
              </figure>
              <ul>
                <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="bottom" title="Available Appointment"><i class="icon-users"></i></a></li>
                <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="bottom" title="Available Video Call"><i class="icon-videocam"></i></a></li>
                <li>
                  <div class="score"><span>Superb<em>200 Reviews</em></span><strong>4.4</strong></div>
                </li>
              </ul>
            </div>
          </div>
          <!-- /strip grid -->
          <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <div class="strip">
              <figure>
                <a href="#0" class="wish_bt"><i class="icon_heart"></i></a>
                <img src="{{asset('client_user/img/cleaner-person.jpg')}}" data-src="{{asset('client_user/img/cleaner-person.jpg')}}" class="img-fluid lazy" alt="">
                <a href="detail-page.html" class="strip_info">
                  <div class="item_title">
                    <h3>Manubhai Khoja</h3>
                    <small>Cleaner</small>
                  </div>
                </a>
              </figure>
              <ul>
                <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="bottom" title="Available Chat"><i class="icon-chat"></i></a></li>
                <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="bottom" title="Available Video Call"><i class="icon-videocam"></i></a></li>
                <li>
                  <div class="score"><span>Superb<em>300 Reviews</em></span><strong>4.1</strong></div>
                </li>
              </ul>
            </div>
          </div>
          <!-- /strip grid -->
          <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <div class="strip">
              <figure>
                <a href="#0" class="wish_bt"><i class="icon_heart"></i></a>
                <img src="{{asset('client_user/img/pest_controller-person.jpg')}}" data-src="{{asset('client_user/img/pest_controller-person.jpg')}}" class="img-fluid lazy" alt="">
                <a href="detail-page.html" class="strip_info">
                  <div class="item_title">
                    <h3>Umang Panchal</h3>
                    <small>Pest Controller, Fumigators</small>
                  </div>
                </a>
              </figure>
              <ul>
                <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="bottom" title="Available Chat"><i class="icon-chat"></i></a></li>
                <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="bottom" title="Available Video Call"><i class="icon-videocam"></i></a></li>
                <li>
                  <div class="score"><span>Superb<em>140 Reviews</em></span><strong>4.2</strong></div>
                </li>
              </ul>
            </div>
          </div>
          <!-- /strip grid -->
          <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <div class="strip">
              <figure>
                <a href="#0" class="wish_bt"><i class="icon_heart"></i></a>
                <img src="{{asset('client_user/img/carpenter-person.jpg')}}" data-src="{{asset('client_user/img/carpenter-person.jpg')}}" class="img-fluid lazy" alt="">
                <a href="detail-page.html" class="strip_info">
                  <div class="item_title">
                    <h3>paresh Mistri</h3>
                    <small>Carpenter</small>
                  </div>
                </a>
              </figure>
              <ul>
                <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="bottom" title="Available Appointment"><i class="icon-users"></i></a></li>
                <li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="bottom" title="Available Chat"><i class="icon-chat"></i></a></li>
                <li>
                  <div class="score"><span>Superb<em>200 Reviews</em></span><strong>4.3</strong></div>
                </li>
              </ul>
            </div>
          </div>
          <!-- /strip grid -->
        </div>
        <!-- /row -->
        <p class="text-center add_top_30"><a href="grid-listing-1.html" class="btn_1 medium">Start Searching</a></p>
      </div>
      <!-- /container -->
    </div>
    <!-- /bg_gray -->
    <div class="container margin_60_40">
      <div class="main_title center">
        <span><em></em></span>
        <h2>Popular Categories</h2>
        <p>Quality Home Services</p>
      </div>
      <!-- /main_title -->
      <div class="owl-carousel owl-theme categories_carousel add_bottom_45">
        <div class="item_version_2">
          <a href="grid-listing-1.html">
            <figure>
              <span>50</span>
              <img src="{{asset('client_user/img/electrician.jpg')}}" data-src="{{asset('client_user/img/electrician.jpg')}}" alt="" class="owl-lazy">
              <div class="info">
                <h3>Electician</h3>
                <small>Avg price ₹200</small>
              </div>
            </figure>
          </a>
        </div>
        <div class="item_version_2">
          <a href="grid-listing-1.html">
            <figure>
              <span>20</span>
              <img src="{{asset('client_user/img/plumber.jpg')}}" data-src="{{asset('client_user/img/plumber.jpg')}}" alt="" class="owl-lazy">
              <div class="info">
                <h3>Plumber</h3>
                <small>Avg price ₹100</small>
              </div>
            </figure>
          </a>
        </div>
        <div class="item_version_2">
          <a href="grid-listing-1.html">
            <figure>
              <span>10</span>
              <img src="{{asset('client_user/img/painter.jpg')}}" data-src="{{asset('client_user/img/painter.jpg')}}" alt="" class="owl-lazy">
              <div class="info">
                <h3>Painter</h3>
                <small>Avg price ₹200</small>
              </div>
            </figure>
          </a>
        </div>
        <div class="item_version_2">
          <a href="grid-listing-1.html">
            <figure>
              <span>40</span>
              <img src="{{asset('client_user/img/cleaner.jpg')}}" data-src="{{asset('client_user/img/cleaner.jpg')}}" alt="" class="owl-lazy">
              <div class="info">
                <h3>Cleaner</h3>
                <small>Avg price ₹100</small>
              </div>
            </figure>
          </a>
        </div>
        <div class="item_version_2">
          <a href="grid-listing-1.html">
            <figure>
              <span>7</span>
              <img src="{{asset('client_user/img/pest_controller.jpg')}}" data-src="{{asset('client_user/img/pest_controller.jpg')}}" alt="" class="owl-lazy">
              <div class="info">
                <h3>Pest Controller</h3>
                <small>Avg price ₹300</small>
              </div>
            </figure>
          </a>
        </div>
        <div class="item_version_2">
          <a href="grid-listing-1.html">
            <figure>
              <span>20</span>
              <img src="{{asset('client_user/img/carpenter.jpg')}}" data-src="{{asset('client_user/img/carpenter.jpg')}}" alt="" class="owl-lazy">
              <div class="info">
                <h3>Carpenter</h3>
                <small>Avg price ₹200</small>
              </div>
            </figure>
          </a>
        </div>
      </div>
      <!-- /carousel -->
      <div class="row">
        <div class="col-12">
          <div class="main_title version_2">
            <span><em></em></span>
            <h2>Weekly Rate Offer</h2>
            <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
            <a href="#0">View All</a>
          </div>
        </div>
        <div class="col-md-6">
          <div class="list_home">
            <ul>
              <li>
                <a href="detail-page.html">
                  <figure>
                    <img src="{{asset('client_user/img/professional_list_placeholder.png')}}" data-src="{{asset('client_user/img/professional_list_1.jpg')}}" alt="" class="lazy">
                  </figure>
                  <div class="score"><strong>9.5</strong></div>
                  <em>Lawyer</em>
                  <h3>Laura Marting</h3>
                  <small>8 Patriot Square E2 9NF</small>
                  <ul>
                    <li><span class="ribbon off">-30%</span></li>
                    <li>Average price $35</li>
                  </ul>
                </a>
              </li>
              <li>
                <a href="detail-page.html">
                  <figure>
                    <img src="{{asset('client_user/img/professional_list_placeholder.png')}}" data-src="{{asset('client_user/img/professional_list_2.jpg')}}" alt="" class="lazy">
                  </figure>
                  <div class="score"><strong>8.0</strong></div>
                  <em>Teacher</em>
                  <h3>Anna Smith</h3>
                  <small>27 Old Gloucester St, 4563</small>
                  <ul>
                    <li><span class="ribbon off">-40%</span></li>
                    <li>Average price $30</li>
                  </ul>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-6">
          <div class="list_home">
            <ul>
              <li>
                <a href="detail-page.html">
                  <figure>
                    <img src="{{asset('client_user/img/professional_list_placeholder.png')}}" data-src="{{asset('client_user/img/professional_list_3.jpg')}}" alt="" class="lazy">
                  </figure>
                  <div class="score"><strong>9.5</strong></div>
                  <em>Pediatrician</em>
                  <h3>Dr. Stefany Lens</h3>
                  <small>27 Old Gloucester St, 4563</small>
                  <ul>
                    <li><span class="ribbon off">-30%</span></li>
                    <li>Average price $20</li>
                  </ul>
                </a>
              </li>
              <li>
                <a href="detail-page.html">
                  <figure>
                    <img src="{{asset('client_user/img/professional_list_placeholder.png')}}" data-src="{{asset('client_user/img/professional_list_4.jpg')}}" alt="" class="lazy">
                  </figure>
                  <div class="score"><strong>8.0</strong></div>
                  <em>Yoga Trainer</em>
                  <h3>Lucy Clarks</h3>
                  <small>22 Hertsmere Rd E14 4ED</small>
                  <ul>
                    <li><span class="ribbon off">-50%</span></li>
                    <li>Average price $35</li>
                  </ul>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- /container -->

    <div class="bg_gray">
      <div class="container margin_60_40">
        <div class="main_title center add_bottom_10">
          <span><em></em></span>
          <h2>How does it works?</h2>
          {{--        <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>--}}
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
                <p>Connect with your professional booking an appointment via chat!</p>
              </li>
            </ul>
            <p class="add_top_30"><a href="grid-listing-1.html" class="btn_1">Start Searching</a></p>
          </div>
          <!-- /row -->
        </div>
      </div>
      <!-- /container -->
    </div>
    <!-- /bg_gray -->

    <div class="call_section version_2 lazy" data-bg="url(img/bg_call_section.jpg)">
      <div class="container clearfix">
        <div class="col-lg-5 col-md-6 float-right wow">
          <div class="box_1">
            <div class="ribbon_promo"><span>Free</span></div>
            <h3>Are you a Professional?</h3>
            <p>Join Us to increase your online visibility. You'll have access to even more customers who are looking to professional service or consultation.</p>
            <a href="/client-register" class="btn_1">Read more</a>
          </div>
        </div>
      </div>
    </div>
    <!--/call_section-->

  </main>

@endsection
