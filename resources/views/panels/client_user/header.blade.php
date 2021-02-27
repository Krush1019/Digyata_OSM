<!-- BEGIN: Header-->
<header class="header clearfix element_to_stick  @yield('header-class')">
  <div class="container-fluid">
    <div id="logo">
      <a href="{{route('index-page')}}">
        <img src="{{asset('client_user/img/logo.png')}}" width="250" height="80" alt="" class="logo_normal">
        <img src="{{asset('client_user/img/logo.png')}}" width="250" height="60" alt="" class="logo_sticky">
      </a>
    </div>
    @yield('top_menu_content')
    <!-- /top_menu -->
    <a href="#0" class="open_close">
      <i class="icon_menu"></i><span>Menu</span>
    </a>
    <nav class="main-menu">
      <div id="header_menu">
        <a href="#0" class="open_close">
          <i class="icon_close"></i><span>Menu</span>
        </a>
        <a href="{{route('index-page')}}"><img src="{{asset('client_user/img/logo.png')}}" width="200" height="70" alt=""></a>
      </div>
      <ul>
        <li><a href="{{route('index-page')}}">Home</a></li>
        <li><a href="{{route('blog')}}">Blog</a></li>
        <li><a href="{{route('contacts')}}">Contact</a></li>
      </ul>
    </nav>
  </div>
</header>
    <!-- END: Header-->
