<!-- BEGIN: Header-->
<header class="@yield('header-class')">
  <div class="container-fluid">
    <div id="logo">
      <a href="{{route('index-page')}}">
        <img src="{{asset('client_user/img/logo.png')}}" width="200" height="45" alt="" class="logo_normal">
        <img src="{{asset('client_user/img/logo.png')}}" width="200" height="45" alt="" class="logo_sticky">
      </a>
    </div>

    @if ( ! str_contains(Request::fullUrl(), 'loginpage'))
      @if (Auth::guard('customer')->check())
    <ul id="top_menu" class="drop_user">
      <li>
        <div class="dropdown user clearfix min-width-100px">
          <a href="#" data-toggle="dropdown">
            <figure><img src="{{Auth::guard('customer')->user()->sUserImgURL}}" alt=""></figure>{{Auth::guard('customer')->user()->sUserName}}
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-end width-max-content">
            <div class="dropdown-menu-content">
              <ul>
                <li><a href="{{ route('user.profile') }}"><i class="icon_cog"></i>Profile</a></li>
                <li><a href="{{ route('user.myorders') }}"><i class="icon_document"></i>Bookings</a></li>

                {{-- Comming Soon in Update --}}
                {{-- <li><a href="#0"><i class="icon_mail"></i>Messages</a></li> --}}
                <li><a href="{{ route('logout') }}"><i class="icon_key"></i>Log out</a></li>
              </ul>
            </div>
          </div>
        </div>
        <!-- /dropdown -->
      </li>
    </ul>
    @else
    <ul id="top_menu">
      <li><a id="sign-in" class="btn_access" href="{{route('login-page')}}">Sign In</a></li>
      <li><a href="{{route('client.register')}}" class="btn_access green">Join Free</a></li>
    </ul>
    @endif
    @endif

    @yield('top_menu_content')

    <!-- /top_menu -->
    <!-- /top_menu -->
    <a href="#0" class="open_close">
      <i class="icon_menu"></i><span>Menu</span>
    </a>
    <nav class="main-menu">
      <div id="header_menu">
        <a href="#0" class="open_close">
          <i class="icon_close"></i><span>Menu</span>
        </a>
        <a href="{{route('index-page')}}"><img src="{{asset('client_user/img/logo.png')}}" width="200" height="45"
            alt=""></a>
      </div>
      <ul>
        <li><a href="{{route('index-page')}}">Home</a></li>
        <li><a href="{{route('about-us')}}">About Us</a></li>
        <li><a href="{{route('contacts')}}">Contact</a></li>
      </ul>
    </nav>
  </div>
</header>
<!-- END: Header-->