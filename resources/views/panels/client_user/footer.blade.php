<!-- BEGIN: Footer-->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-6">
        <h3 data-target="#collapse_1">Quick Links</h3>
        <div class="collapse dont-collapse-sm links" id="collapse_1">
          <ul>
            <li><a href="{{route('client.register')}}">Join Us</a></li>
            <li><a href="{{route('login-page')}}">Login</a></li>
            <li><a href="{{route('about-us')}}">About Us</a></li>
            <li><a href="{{route('contacts')}}">Contacts</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <h3 data-target="#collapse_2">Categories</h3>
        <div class="collapse dont-collapse-sm links" id="collapse_2">
          <ul>
            <li><a href="{{route('client-listing')}}">Top Categories</a></li>
            <li><a href="{{route('client-listing')}}">Best Rated</a></li>
            <li><a href="{{route('client-listing')}}">Best Price</a></li>
            <li><a href="{{route('client-listing')}}">Latest Submissions</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3 offset-lg-3 col-md-6">
        <h3 data-target="#collapse_4">Keep in touch</h3>
        <div class="collapse dont-collapse-sm" id="collapse_4">
          <div id="newsletter">
            <div id="message-newsletter"></div>
            <form method="post" action="{{asset('client_user/assets/newsletter.php')}}" name="newsletter_form" id="newsletter_form">
              <div class="form-group">
                <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Your email">
                <button type="submit" id="submit-newsletter"><i class="arrow_carrot-right"></i></button>
              </div>
            </form>
          </div>
          <div class="follow_us">
            <ul>
              <li><a href="#0"><img src="{{asset('client_user/img/twitter_icon.svg')}}" data-src="{{asset('client_user/img/twitter_icon.svg')}}" alt="" class="lazy"></a></li>
              <li><a href="#0"><img src="{{asset('client_user/img/facebook_icon.svg')}}" data-src="{{asset('client_user/img/facebook_icon.svg')}}" alt="" class="lazy"></a></li>
              <li><a href="#0"><img src="{{asset('client_user/img/instagram_icon.svg')}}" data-src="{{asset('client_user/img/instagram_icon.svg')}}" alt="" class="lazy"></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- /row-->
    <hr>
    <div class="row">
      <div class="col-lg-12 text-center">
        <ul class="additional_links float-none">
          <li><a href="#0">Terms and conditions</a></li>
          <li><a href="#0">Privacy</a></li>
          <li><span>© 2021 Digyata</span></li>
        </ul>
      </div>
    </div>
  </div>
</footer>
    <!-- END: Footer-->
