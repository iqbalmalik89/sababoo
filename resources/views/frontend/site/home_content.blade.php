<div class="">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div id="content">
                    <h1> Welcome and Join Us!</h1>
                    <h2>Hire the best | Connect with others | Discover your dream job</h2>
                    <center><hr style="width: 476px"></center>
                    <?php
                        if (Auth::user() == NULL) {
                    ?>
                        <a href="signup.php"></a>
                        <button class="btn btn-default btn-lg homeJoinUsButton"><a href="signup">Join Us!
                        </a> </button>
                    <?php
                        }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
</div>