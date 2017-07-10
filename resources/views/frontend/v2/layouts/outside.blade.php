<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">

    <!-- Mobile viewport optimized -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">

    <!-- Meta Tags - Description for Search Engine purposes -->
    <meta name="description" content="'Share your jobs with sababo,Sababoo is a job portal','Create a job and post with Sababoo'">
    <meta name="keywords" content="Sababoo,  Sababoo Tradesman, Sababoo Job Recuritment,Sababoo Employer,Sababoo Employee','Sababoo employee view','sababoo tradesman ','job','job post','apply job','job browse','job search','job view','job listing">
    <meta name="author" content="GnoDesign">

    <!-- Website Title -->
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{asset('assets/frontend/images/ico/favicon.png?v=1')}}" type="image/x-icon">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('assets/frontend/v2/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('assets/frontend/v2/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('assets/frontend/v2/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('assets/frontend/v2/images/ico/apple-touch-icon-57-precomposed.png')}}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,400i,700,800|Varela+Round" rel="stylesheet">

    <!-- CSS links -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/v2/css/bootstrap.min.css')}}" media="screen">  
    <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/v2/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/v2/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/v2/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/frontend/v2/css/responsive.css')}}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
    <body>

        @include('frontend.v2.layouts.outside-header')
        @include('frontend.v2.common.popup')
        
        @yield('content')
                   
        @include('frontend.v2.layouts.outside-footer')

        <input type="hidden" id="isLoggedIn" value="{{Auth::user()}}">
        <!-- ===== Start of Back to Top Button ===== -->
        <a href="#" class="back-top"><i class="fa fa-chevron-up"></i></a>
        <!-- ===== End of Back to Top Button ===== -->

        <!-- ===== All Javascript at the bottom of the page for faster page loading ===== -->
        <script src="{{asset('assets/frontend/v2/js/jquery-3.1.1.min.js')}}"></script>
        <script src="{{asset('assets/frontend/v2/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/frontend/v2/js/bootstrap-select.min.js')}}"></script>
        <script src="{{asset('assets/frontend/v2/js/swiper.min.js')}}"></script>
        <script src="{{asset('assets/frontend/v2/js/jquery.ajaxchimp.js')}}"></script>
        <script src="{{asset('assets/frontend/v2/js/query.countTo.js')}}"></script>
        <script src="{{asset('assets/frontend/v2/js/jquery.inview.min.js')}}"></script>
        <script src="{{asset('assets/frontend/v2/js/jquery.magnific-popup.min.js')}}"></script>
        <script src="{{asset('assets/frontend/v2/js/jquery.easypiechart.min.js')}}"></script>
        <script src="{{asset('assets/frontend/v2/js/jquery-ui.min.js')}}"></script>
        <script src="{{asset('assets/frontend/v2/js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('assets/frontend/v2/js/tinymce/tinymce.min.js')}}"></script>
        <script src="{{asset('assets/frontend/v2/js/countdown.js')}}"></script>
        <script src="{{asset('assets/frontend/v2/js/isotope.min.js')}}"></script>
        <script src="{{asset('assets/frontend/v2/js/custom.js')}}"></script>
        @yield('scripts')
    </body>
</html>