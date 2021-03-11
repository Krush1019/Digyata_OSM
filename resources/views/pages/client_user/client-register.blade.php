@extends('layouts/client_user/contentLayoutMaster')

@section('title', 'client-register')

@section('specific-style')
  <link href="{{asset('client_user/css/submit.css')}}" rel="stylesheet">
@endsection

@section('custom-style')
  <link href="{{asset('client_user/css/custom.css')}}" rel="stylesheet">
@endsection

@section('header-class', 'header clearfix element_to_stick')

@section('content')
  <main>
    <div class="hero_single inner_pages background-image" data-background="url({{asset('client_user/img/hero_general.jpg')}})">
      <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.7)">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xl-9 col-lg-10 col-md-8">
              <h1>Next Generation Consulting</h1>
              <p>Join to Digyata to get more customers</p>
            </div>
          </div>
          <!-- /row -->
        </div>
      </div>
    </div>
    <!-- /hero_single -->

    <div class="bg_gray">
      <div class="container margin_60_40">
        <div class="main_title center">
          <span><em></em></span>
          <h2>Why Digyata</h2>
{{--          <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>--}}
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="box_why">
              <figure><img src="{{asset('client_user/img/why_1.svg')}}" alt="" width="200" height="200" class="img-fluid"></figure>
              <h3>Boost your Visibility</h3>
              <p class="lead"> Illum suavitate ad has, inani salutatus sit et, error reprehendunt id eam.</p>
              <p>Eu quem patrioque delicatissimi est. Eos delectus perpetua posidonium ei. Ad debitis accusamus eam. Nec ea esse nulla aperiam, pri at decore numquam, no detracto cotidieque his. Invenire facilisis ex ius.</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="box_why">
              <figure><img src="{{asset('client_user/img/why_2.svg')}}" alt="" width="200" height="200" class="img-fluid"></figure>
              <h3>Manage Easily</h3>
              <p class="lead">Est falli invenire interpretaris id, magna libris sensibus mel id.</p>
              <p>Per eu nostrud feugiat. Et quo molestiae persecuti neglegentur. At zril definitionem mei, vel ei choro volumus. An tota nulla soluta has, ei nec essent audiam, te nisl dignissim vel. Ex velit audire perfecto pro, ei mei doming vivendo legendos.</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="box_why">
              <figure><img src="{{asset('client_user/img/why_3.svg')}}" alt="" width="200" height="200" class="img-fluid"></figure>
              <h3>Reach New Customers</h3>
              <p class="lead">Laoreet inimicus vulputate est. Sea in voluptatibus comprehensam vituperatoribus.</p>
              <p>Movet iriure dolores nec ea, per ei dicat audire signiferumque. Illum porro gubergren vis in, affert graecis an eos, qui quem facilis vulputate cu. Ei commodo prompta eum, et eum vide appareat euripidis.</p>
            </div>
          </div>
        </div>
        <!-- /row -->
      </div>
      <!-- /container -->
    </div>
    <!-- /bg_gray -->

    <div class="container margin_60_40">
      <div class="main_title center">
        <span><em></em></span>
        <h2>Our Pricing Plans</h2>
{{--        <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>--}}
      </div>
      <div class="row plans">
        <div class="plan col-md-4">
          <div class="plan-title">
            <h3>1 Month</h3>
            <p>Free of charge one standard listing</p>
          </div>
          <p class="plan-price">Free</p>
          <ul class="plan-features">
            <li><strong>Check and go</strong> included</li>
            <li><strong>1 month</strong> valid</li>
            <li><strong>Unsubscribe</strong> anytime</li>
          </ul>
          <a href="#submit" class="btn_1 gray btn_scroll">Submit</a>
        </div> <!-- End col-md-4 -->

        <div class="plan plan-tall col-md-4">
          <div class="plan-title">
            <h3>6 Months</h3>
            <p>One time fee for one listing, highlighted in search results</p>
          </div>
          <p class="plan-price">$199</p>
          <ul class="plan-features">
            <li><strong>Premium</strong> support</li>
            <li><strong>Check and go</strong> included</li>
{{--            <li><strong>APP</strong> included</li>--}}
            <li><strong>6 months</strong> valid</li>
            <li><strong>Unsubscribe</strong> anytime</li>
          </ul>
          <a href="#submit" class="btn_1 btn_scroll">Submit</a>
        </div><!-- End col-md-4 -->

        <div class="plan col-md-4">
          <div class="plan-title">
            <h3>12 Months</h3>
            <p>Monthly subscription for unlimited listings</p>
          </div>
          <p class="plan-price">$299</p>
          <ul class="plan-features">
            <li><strong>Premium</strong> support</li>
            <li><strong>Check and go</strong> included</li>
            <li><strong>12 months</strong> valid</li>
            <li><strong>Unsubscribe</strong> anytime</li>
          </ul>
          <a href="#submit" class="btn_1 gray btn_scroll">Submit</a>
        </div><!-- End col-md-4 -->
      </div><!-- End row plans-->
    </div>
    <!-- /container -->

    <div class="bg_gray pattern_mail" id="submit">
      <div class="container margin_60_40">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="box_general padding">
              <div class="text-center add_bottom_15">
                <h4>Please fill the form below</h4>
{{--                <p>Id persius indoctum sed, audiam verear his in, te eum quot comprehensam. Sed impetus vocibus repudiare et.</p>--}}
              </div>
              <div id="message-register"></div>
              <form id="Client-register">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="First Name and Last Name" name="name_register" id="name_register">
                    </div>
                  </div>
                </div>
                <!-- /row -->
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <input type="email" class="form-control" placeholder="Email Address" name="email_register" id="email_register">
                    </div>
                  </div>
                </div>
                <!-- /row -->
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Mobile No." name="mobile_register" id="mobile_register">
                    </div>
                  </div>
                </div>
                <!-- /row -->
                <div class="row">
                  <div class="col-lg-12 form-group">
                      <span class="mr-3">
                          <label for="gender_register" class="">Gender:</label>
                      </span>
                      <span class="mr-2">
                          <input type="radio" name="gender_register"  value="male" checked>
                          <label> Male</label>
                      </span>
                      <span class="mr-2">
                        <input type="radio" name="gender_register" value="female">
                        <label> Female</label>
                      </span>
                  </div>
                </div>
                <!-- /row -->
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <input type="password" class="form-control" placeholder="Password" name="password_register" id="password_register">
                    </div>
                  </div>
                </div>
                <!-- /row -->
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <input type="password" class="form-control" placeholder="Confirm Password" name="Cnf_password_register" id="cnf_name_register">
                    </div>
                  </div>
                </div>
                <!-- /row -->
                <div class="row add_bottom_15">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="location" name="location_register" id="location_register">
                    </div>
                  </div>
                </div>
                <div class="row add_bottom_25">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <input type="text" id="captcha_register" class="form-control" placeholder="Enter Captcha" name="captcha_register">
                    </div>
                  </div>
                  <div class="captcha col-lg-6">
                    <span>{!! captcha_img() !!}</span>
                    <button type="button" class="btn btn-danger" class="reload" id="reload">&#x21bb;</button>
                  </div>
                </div>
                <!-- /row -->
                <div class="text-center form-group"><input type="submit" class="btn_1" id="submit-register"></div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- /container -->
    </div>
    <!-- /bg_gray -->

  </main>
  <!-- /main -->
@endsection
