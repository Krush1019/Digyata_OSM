@extends('layouts/client_user/contentLayoutMaster')

@section('title', 'About Us')

@section('specific-style')
  <link href="{{asset('client_user/css/contacts.css')}}" rel="stylesheet">
@endsection

@section('custom-style')
  <link href="{{asset('client_user/css/custom.css')}}" rel="stylesheet">
@endsection

@section('header-class', 'header header_in shadow element_to_stick clearfix')

@section('content')
  <main>

    <div class="bg_gray">
      <div class="container margin_60_40">
        <div class="main_title center add_bottom_10">
          <span><em></em></span>
          <h2 class="font-weight-bolder">Our Story</h2>
        </div>
        <div class="row  how_2">
          <div class="col-md-7">
            <div class="rich-text m-4 ">
              <p>
                Strong customer relationships are more important than ever, but the scale and nature of online business means it's harder than ever to create personal connections with customers.
              </p>
              <p>
                That's why we created the world's first Conversational Relationship Platform — to help businesses build better customer relationships through personalized, messenger-based experiences.
              </p>
            </div>
          </div>
          <div class="col-md-5 m-auto">
            <div class="text-center">
              <img class="" src="{{asset('client_user/client/img/ser_doc_img/67280673-1614419650.jpg')}}" width="200px" height="200px">
            </div>
          </div>
          <!-- /row -->
        </div>
      </div>
    </div>
    <!-- /container -->

    <div class="">
      <div class="container margin_60_40">
        <div class="main_title center add_bottom_10">
          <span><em></em></span>
          <h2 class="font-weight-bolder">Helping Small Business Owners Run Their Businesses</h2>
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-4 hovering-zoom">
            <div class="box_contacts font-weight-bolder">
              <div class="rich-text">Over</div>
              <strong class="font-large-50">50+</strong>
              <div class="rich-text">Clients joined With Us</div>
            </div>
          </div>
          <div class="col-lg-4 hovering-zoom">
            <div class="box_contacts font-weight-bolder">
              <div class="rich-text">Over</div>
              <strong class="font-large-50">100+</strong>
              <div class="rich-text">People have used Digyata</div>
            </div>
          </div>
          <div class="col-lg-4 hovering-zoom">
            <div class="box_contacts font-weight-bolder">
              <div class="rich-text">We serve customers in</div>
              <strong class="font-large-50">5+</strong>
              <div class="rich-text">cities</div>
            </div>
          </div>
        </div>
        <!-- /row -->
      </div>
      <!-- /container -->
    </div>
    <!-- /container -->



      <div class="bg_gray">
        <div class="container margin_60_40">
          <div class="main_title center add_bottom_10">
            <span><em></em></span>
            <h2 class="font-weight-bolder">Meet Our Team</h2>
          </div>
          <div class="row justify-content-center">
            <div class="col-lg-3">
              <div class="box_contacts font-weight-bolder hovering-zoom">
                <img src="{{asset('client_user/img/about_1.svg')}}" class="img-fluid mb-3" alt="" >
                <h2 class="font-weight-bold">Parth Patel</h2>
                <a href="mailto:parthpm1999@gmail.com" target="_blank">parthpm1999@gmail.com</a>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="box_contacts font-weight-bolder hovering-zoom">
                <img src="{{asset('client_user/img/about_3.svg')}}" class="img-fluid mb-3" alt="">
                <h2 class="font-weight-bold">Rashmin Prajapati </h2>
                <a href="mailto:meetprajapati847@gmail.com" target="_blank">meetprajapati847@gmail.com</a>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="box_contacts font-weight-bolder hovering-zoom">
                <img src="{{asset('client_user/img/about_1.svg')}}" class="img-fluid mb-3" alt="">
                <h2 class="font-weight-bold">Sharad Patel</h2>
                <a href="mailto:sharadpatel158@gmail.com" target="_blank">sharadpatel158@gmail.com</a>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="box_contacts font-weight-bolder hovering-zoom">
                <img src="{{asset('client_user/img/about_2.svg')}}" class="img-fluid mb-3" alt="">
                <h2 class="font-weight-bold">Krushang Prajapati</h2>
                <a href="mailto:pkrushang1910@gmail.com" target="_blank">pkrushang1910@gmail.com</a>
              </div>
            </div>
          </div>
          <!-- /row -->
        </div>
      </div>
      <!-- /container -->


  </main>
  <!-- /main -->
@endsection




