<!-- ===== Start of Testimonial Section ===== -->
    <section class="ptb80" id="testimonials">
        <div class="container">

            <!-- Section Title -->
            <div class="section-title">
                <h1 class="text-white">Welcome and Join Us!</h1>
                <h2 class="text-white">Hire the best | Connect with others | Discover your dream job</h2>
                    <center><hr style="width: 476px"></center>
                    <?php
                        if (Auth::user() == NULL) {
                    ?>
                        <a class="btn btn-purple btn-effect mt20" href="{{url('v2/signup')}}">Join Us!
                        </a>
                    <?php
                        }
                    ?>
            </div>

        </div>
    </section>
    <!-- ===== End of Testimonial Section ===== -->

