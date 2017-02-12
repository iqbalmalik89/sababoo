<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Title Of Site -->
        <title>@yield('title')</title>
        <meta name="description" content="@yield('description')">
        <meta name="keywords" content="@yield('keywords')">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        
        <!-- Fav and Touch Icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('assets/frontend/images/ico/apple-touch-icon-144-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('assets/frontend/images/ico/apple-touch-icon-114-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('assets/frontend/images/ico/apple-touch-icon-72-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" href="{{asset('assets/frontend/images/ico/apple-touch-icon-57-precomposed.png')}}">
        <link rel="shortcut icon" href="{{asset('assets/frontend/images/ico/favicon.png')}}">

        <!-- CSS Plugins -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/bootstrap/css/bootstrap.min.css')}}" media="screen">   
        <link href="{{asset('assets/frontend/css/animate.css')}}" rel="stylesheet">
        <link href="{{asset('assets/frontend/css/main.css')}}" rel="stylesheet">
        <link href="{{asset('assets/frontend/css/component.css')}}" rel="stylesheet">
        <!-- CSS Font Icons -->
        <link rel="stylesheet" href="{{asset('assets/frontend/icons/linearicons/style.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/icons/font-awesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/icons/simple-line-icons/css/simple-line-icons.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/icons/ionicons/css/ionicons.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/icons/pe-icon-7-stroke/css/pe-icon-7-stroke.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/icons/rivolicons/style.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/icons/flaticon-line-icon-set/flaticon-line-icon-set.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/icons/flaticon-streamline-outline/flaticon-streamline-outline.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/icons/flaticon-thick-icons/flaticon-thick.css')}}">
        <link rel="stylesheet" href="{{asset('assets/frontend/icons/flaticon-ventures/flaticon-ventures.css')}}">

        <!-- CSS Custom -->
        <link href="{{asset('assets/frontend/css/style.css')}}" rel="stylesheet">


         <script type="text/javascript" src="{{asset('assets/frontend/js/jquery-1.11.3.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/jquery-migrate-1.2.1.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/bootstrap/js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/bootstrap-modalmanager.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/bootstrap-modal.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/smoothscroll.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/jquery.easing.1.3.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/jquery.waypoints.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/wow.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/jquery.slicknav.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/jquery.placeholder.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/bootstrap-tokenfield.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/typeahead.bundle.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/bootstrap3-wysihtml5.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/bootstrap-select.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/jquery-filestyle.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/bootstrap-select.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/ion.rangeSlider.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/handlebars.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/jquery.countimator.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/jquery.countimator.wheel.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/slick.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/easy-ticker.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/jquery.introLoader.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/jquery.responsivegrid.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/customs.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/global.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/frontend/js/events.js')}}"></script>
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="not-transparent-header">

        <!-- start Container Wrapper -->
        <div class="container-wrapper @yield('container_class')">

            @include('frontend.layouts.unauth_header')

            <div class="main-wrapper">    

                <!-- start hero-header -->
    <!--             <div class="breadcrumb-wrapper">
                
                    <div class="container">
                    
                        <ol class="breadcrumb-list">
                            <li><a href="index.html">Home</a></li>
                            <li><span>Register</span></li>
                        </ol>
                        
                    </div>
                    
                </div> -->
                <!-- end hero-header -->

                <div class="login-container-wrapper">   
        
                    <div class="container">
                        @yield('content')
                    </div>
                
                </div>

                @include('frontend.layouts.unauth_footer')


            </div>
            <!-- end Main Wrapper -->

        </div> <!-- / .wrapper -->
        <!-- end Container Wrapper -->





        <!-- start Back To Top -->
        <div id="back-to-top">
           <a href="#"><i class="ion-ios-arrow-up"></i></a>
        </div>
        <!-- end Back To Top -->

        </body>
</html>