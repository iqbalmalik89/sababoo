<!-- =============== Start of Header 1 Navigation =============== -->
    <header class="header1">
        <nav class="navbar navbar-default navbar-static-top fluid_header centered">
            <div class="container">
                
                <!-- Logo -->
                <div class="col-md-2 col-sm-6 col-xs-8 nopadding">
                    <a class="navbar-brand nomargin" href="{{url('/v2')}}"><img src="{{asset('assets/frontend/v2/images/logo-black.png')}}" alt="logo"></a>
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
                                <a href="{{url('v2/login')}}" role="button">home</a>
                            </li>

                            <!-- Login Menu Item -->
                            <li class="menu-item login-btn">
                                <a href="{{url('v2/login')}}" role="button"><i class="fa fa-lock"></i> login</a>
                            </li>

                            <li class="menu-item login-btn">
                                <a href="{{url('v2/signup')}}" role="button"><i class="fa fa-lock"></i>register</a>
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