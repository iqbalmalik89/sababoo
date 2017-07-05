<!-- =============== Start of Header 1 Navigation =============== -->
    <header class="header1">
        <nav class="navbar navbar-default navbar-static-top fluid_header centered">
            <div class="container">
                
                <!-- Logo -->
                <div class="col-md-2 col-sm-6 col-xs-8 nopadding">
                    <a class="navbar-brand nomargin" href="{{url('v2')}}"><img src="{{asset('assets/frontend/v2/images/logo-black.png')}}" alt="logo"></a>
                    <!-- INSERT YOUR LOGO HERE -->
                </div>

                <!-- ======== Start of Main Menu ======== -->
                <div class="col-md-10 col-sm-6 col-xs-4 nopadding">
                    <div class="navbar-header page-scroll">
                        <button type="button" class="navbar-toggle toggle-menu menu-right push-body" data-toggle="collapse" data-target="#main-nav" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <!-- Start of Main Nav -->
                    <div class="collapse navbar-collapse cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="main-nav">
                        <ul class="nav navbar-nav pull-right">

                            <!-- Mobile Menu Title -->
                            <li class="mobile-title">
                                <h4>main menu</h4></li>

                            <!-- Simple Menu Item -->
                            <li class="dropdown simple-menu">
                                <a href="{{url('v2/home')}}" role="button">home</a>
                            </li>
                            <li class="dropdown simple-menu">
                                <a href="javascript:;" role="button">users</a>
                            </li>

                            <!-- Simple Menu Item -->
                            <li class="dropdown simple-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">job<i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="javascript:;">job post</a></li>
                                    <li><a href="javascript:;">my jobs</a></li>
                                    <li><a href="javascript:;">browse jobs</a></li>
                                    <li><a href="javascript:;">applied jobs</a></li>
                                    <li><a href="javascript:;">work stream</a></li>
                                </ul>
                            </li>

                            <!-- Simple Menu Item -->
                            <li class="dropdown simple-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">my network<i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="javascript:;">recommendation</a></li>
                                </ul>
                            </li>

                            <!-- Simple Menu Item -->
                            <li class="dropdown simple-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">messages<i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="javascript:;">requests</a></li>
                                    <li><a href="javascript:;">conversation</a></li>
                                </ul>
                            </li>

                            <li class="dropdown simple-menu">
                                <a href="javascript:;" role="button">transaction history</a>
                            </li>

                            <li class="dropdown simple-menu">
                                <a href="javascript:;" role="button">news</a>
                            </li>

                            <!-- Login Menu Item -->
                            <li class="menu-item login-btn">
                                <a href="{{url('v2/logout')}}" role="button"><i class="fa fa-lock"></i> logout</a>
                            </li>

                        </ul>
                    </div>
                    <!-- End of Main Nav -->
                </div>
                <!-- ======== End of Main Menu ======== -->

            </div>
        </nav>
    </header>
    <!-- =============== End of Header 1 Navigation =============== -->