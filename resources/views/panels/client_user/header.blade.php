<!-- BEGIN: Header-->
<header class="@yield('header-class')">
  <div class="container-fluid">
    <div id="logo">
      <a href="{{route('index-page')}}">
        <img src="{{asset('client_user/img/logo.png')}}" width="250" height="80" alt="" class="logo_normal">
        <img src="{{asset('client_user/img/logo.png')}}" width="250" height="60" alt="" class="logo_sticky">
      </a>
    </div>
    {{-- <ul id="top_menu">
      <li><a id="sign-in" class="btn_access" data-toggle="modal" href="#user-login-modal">Log In</a></li>
      <li><a href="{{route('client-register')}}" class="btn_access green">Join Free</a></li>
    </ul> --}}

    <ul id="top_menu" class="drop_user">
			<li>
				<div class="dropdown user clearfix">
				    <a href="#" data-toggle="dropdown">
				        <figure><img src="img/avatar1.jpg" alt=""></figure>Jhon Doe
				    </a>
				    <div class="dropdown-menu">
				        <div class="dropdown-menu-content">
				            <ul>
				            	<li><a href=""><i class="icon_cog"></i>Profile</a></li>
				            	<li><a href="#0"><i class="icon_document"></i>Bookings</a></li>

                      {{-- Comming Soon in Update --}}
				            	{{-- <li><a href="#0"><i class="icon_mail"></i>Messages</a></li> --}}
				            	<li><a href="#0"><i class="icon_key"></i>Log out</a></li>
				            </ul>
				        </div>
				    </div>
				</div>
				<!-- /dropdown -->
			</li>
		</ul>


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
