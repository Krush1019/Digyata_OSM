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

    <div class="">
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

    <div class="bg_gray">
    <div class="container margin_60_40">
      <div class="main_title center">
        <span><em></em></span>
        <h2>Why Digyata</h2>

      </div>
      <div class="row">
        <div class="col-lg-4">
          <div class="box_why">
            <figure><img src="{{asset('client_user/img/why_1.svg')}}" alt="" width="200" height="200" class="img-fluid">
            </figure>
            <h3>Boost your Visibility</h3>
            <p class="lead"> Illum suavitate ad has, inani salutatus sit et, error reprehendunt id eam.</p>
            <p>Eu quem patrioque delicatissimi est. Eos delectus perpetua posidonium ei. Ad debitis accusamus eam. Nec
              ea esse nulla aperiam, pri at decore numquam, no detracto cotidieque his. Invenire facilisis ex ius.</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="box_why">
            <figure><img src="{{asset('client_user/img/why_2.svg')}}" alt="" width="200" height="200" class="img-fluid">
            </figure>
            <h3>Manage Easily</h3>
            <p class="lead">Est falli invenire interpretaris id, magna libris sensibus mel id.</p>
            <p>Per eu nostrud feugiat. Et quo molestiae persecuti neglegentur. At zril definitionem mei, vel ei choro
              volumus. An tota nulla soluta has, ei nec essent audiam, te nisl dignissim vel. Ex velit audire perfecto
              pro, ei mei doming vivendo legendos.</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="box_why">
            <figure><img src="{{asset('client_user/img/why_3.svg')}}" alt="" width="200" height="200" class="img-fluid">
            </figure>
            <h3>Reach New Customers</h3>
            <p class="lead">Laoreet inimicus vulputate est. Sea in voluptatibus comprehensam vituperatoribus.</p>
            <p>Movet iriure dolores nec ea, per ei dicat audire signiferumque. Illum porro gubergren vis in, affert
              graecis an eos, qui quem facilis vulputate cu. Ei commodo prompta eum, et eum vide appareat euripidis.</p>
          </div>
        </div>
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /bg_gray -->

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




