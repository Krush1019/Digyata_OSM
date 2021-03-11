<!-- BEGIN: Footer-->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-6">
        <h3 data-target="#collapse_1">Quick Links</h3>
        <div class="collapse dont-collapse-sm links" id="collapse_1">
          <ul>
            <li><a href="{{route('client-register')}}">Join Us</a></li>
            <li><a data-toggle="modal" href="#user-login-modal">Login</a></li>
            <li><a href="{{route('blog')}}">Blog</a></li>
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
              <li><a href="#0"><img src="{{asset('client_user/img/youtube_icon.svg')}}" data-src="{{asset('client_user/img/youtube_icon.svg')}}" alt="" class="lazy"></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- /row-->
    <hr>
    <div class="row add_bottom_25">
      <div class="col-lg-6">
        <ul class="footer-selector clearfix">
          <li>
            <div class="styled-select lang-selector">
              <select>
                <option value="English" selected>English</option>
                <option value="French">French</option>
                <option value="Spanish">Spanish</option>
                <option value="Russian">Russian</option>
              </select>
            </div>
          </li>
          <li>
            <div class="styled-select currency-selector">
              <select>
                <option value="US Dollars" selected>US Dollars</option>
                <option value="Euro">Euro</option>
              </select>
            </div>
          </li>
          <li><img src="{{asset('client_user/img/cards_all.svg')}}" data-src="{{asset('client_user/img/cards_all.svg')}}" alt="" width="230" height="35" class="lazy"></li>
        </ul>
      </div>
      <div class="col-lg-6">
        <ul class="additional_links">
          <li><a href="#0">Terms and conditions</a></li>
          <li><a href="#0">Privacy</a></li>
          <li><span>© 2021 Digyata</span></li>
        </ul>
      </div>
    </div>
  </div>
</footer>
    <!-- END: Footer-->
