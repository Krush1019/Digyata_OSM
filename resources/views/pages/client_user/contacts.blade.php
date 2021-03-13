@extends('layouts/client_user/contentLayoutMaster')

@section('title', 'contacts')

@section('specific-style')
  <link href="{{asset('client_user/css/contacts.css')}}" rel="stylesheet">
@endsection

@section('custom-style')
  <link href="{{asset('client_user/css/custom.css')}}" rel="stylesheet">
@endsection

@section('header-class', 'header clearfix element_to_stick')

@section('content')
  <main>
    <div class="hero_single inner_pages background-image" data-background="url(img/home_section_1.jpg)">
      <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xl-9 col-lg-10 col-md-8">
              <h1>Contact Prozim</h1>
              <p>A successful restaurant experience</p>
            </div>
          </div>
          <!-- /row -->
        </div>
      </div>
    </div>
    <!-- /hero_single -->

    <div class="bg_gray">
      <div class="container margin_60_40">
        <div class="row justify-content-center">
          <div class="col-lg-4">
            <div class="box_contacts">
              <i class="icon_lifesaver"></i>
              <h2>Help Center</h2>
              <a href="#0">+94 423-23-221</a> - <a href="#0">help@prozim.com</a>
              <small>MON to FRI 9am-6pm SAT 9am-2pm</small>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="box_contacts">
              <i class="icon_pin_alt"></i>
              <h2>Address</h2>
              <div>6th Forrest Ray, London - 10001 UK</div>
              <small>MON to FRI 9am-6pm SAT 9am-2pm</small>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="box_contacts">
              <i class="icon_cloud-upload_alt"></i>
              <h2>Submissions</h2>
              <a href="#0">+94 423-23-221</a> - <a href="#0">info@prozim.com</a>
              <small>MON to FRI 9am-6pm SAT 9am-2pm</small>
            </div>
          </div>
        </div>
        <!-- /row -->
      </div>
      <!-- /container -->
    </div>
    <!-- /bg_gray -->

    <div class="container margin_60_40">
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <div class="box_general padding">
            <div class="text-center add_bottom_15">
              <h4 class="mb_5">Drop Us a Line</h4>
            </div>
            <div class="col-12">
              <form id="contactform">
                <div class="form-group">
                  <input class="form-control" type="text" placeholder="Name" id="name_contact" name="name_contact">
                </div>
                <div class="form-group">
                  <input class="form-control" type="email" placeholder="Email" id="email_contact" name="email_contact">
                </div>
                <div class="form-group">
                  <textarea class="form-control" style="height: 150px;" placeholder="Message" id="message_contact" name="message_contact"></textarea>
                </div>
                <div class="form-group">
                  <input class="btn_1 full-width" type="submit" value="Submit" id="submit-contact">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /container -->

  </main>
  <!-- /main -->
@endsection
