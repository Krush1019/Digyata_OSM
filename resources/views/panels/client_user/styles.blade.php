        <!-- BASE CSS -->
        <link href="{{asset('client_user/css/bootstrap_customized.min.css')}}" rel="stylesheet">
        <link href="{{asset('client_user/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('client_user/css/style.css')}}" rel="stylesheet">
        <link href="{{asset('fonts/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

        <!-- SPECIFIC CSS -->
        @yield('specific-style')

        <!-- YOUR CUSTOM CSS -->
        @yield('custom-style')
