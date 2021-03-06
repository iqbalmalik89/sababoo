<?php
    if (Auth::user() != NULL) {
        $sectionClass = 'section sm';
        $sectionWidth = '';
?>
<!-- start breadcrumb -->
<div class="breadcrumb-wrapper">

    <div class="container">

        <ol class="breadcrumb-list booking-step">
            
            <li><a href="/home">Home</a></li>
            <li><span>Companies</span></li>
        </ol>

    </div>

</div>
<!-- end breadcrumb -->
<?php
    } else {
        $sectionClass = '';
        $sectionWidth = 'width:104%';
    }
?>


<div class="{{$sectionClass}}">
<?php
    if (Auth::user() != NULL) {
?>
    <div class="second-search-result-wrapper">

        <div class="container">

            <form action="/companies" method="post">

                <div class="second-search-result-inner">
                    <span class="labeling">Search company</span>
                    <div class="row" style="margin-left: 80px;">

                        <div class="col-xss-12 col-xs-6 col-sm-6 col-md-5">
                            <div class="form-group form-lg">
                                <input id="title" name="title" type="text" class="form-control" placeholder="Company name">
                            </div>
                        </div>
                
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">


                        <div class="col-xss-12 col-xs-6 col-sm-4 col-md-2">
                            <button class="btn btn-block" id="search_it">Search</button>
                        </div>

                    </div>
                </div>

            </form>



        </div>

    </div>
<?php
}
?>
    
    <div class="bg-light pt-80 pb-80" style="{{$sectionWidth}}">


        <div class="container">


            <div class="row">

                <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">

                    <div class="section-title">

                        <h2>Associate Companies</h2>

                    </div>

                </div>

            </div>

            <div class="">

                <div class="GridLex-gap-15-wrappper">

                    <div class="GridLex-grid-noGutter-equalHeight">


                        <?php

                            if(count($companies)<=0){
                                echo "<div class='content' align='center'>Record Not Found</div>";

                            }else{
                            foreach($companies as $company){
                        ?>

                        <div class="GridLex-col-3_sm-4_xs-6_xss-12 margin-bottom-15px" >

                            <div class="employee-grid-item" style="background-color: #FFF;">

                                <div class="clearfix">

                                    <div class="image-non-circle clearfix">

                                    <?php
                                        if (strstr($company->url, 'http') || strstr($company->url, 'https')) {
                                            $companyUrl = $company->url;
                                        } else {
                                            $companyUrl = 'http://'.$company->url;
                                        }
                                    ?>

                                    <?php
                                        if (Auth::user() != NULL) {
                                    ?>
                                        <a href="{{$companyUrl}}" target="_blank"><img class="" alt="image" src="{{url('files/company/'.$company->image)}}"></a>
                                    <?php
                                        } else {
                                    ?>
                                        <a href="{{\URL::to('/signup')}}"><img class="" alt="image" src="{{url('files/company/'.$company->image)}}"></a>
                                    <?php
                                        }
                                    ?>
                                    </div>

                                    <div class="content">

                                        <?php
                                            if (Auth::user() != NULL) {
                                        ?>
                                            <h4><a href="{{$companyUrl}}"><?php echo $company->name;?> </a></h4>
                                        <?php
                                            } else {
                                        ?>
                                            <h4><a href="{{\URL::to('/signup')}}"><?php echo $company->name;?> </a></h4>
                                        <?php
                                            }
                                        ?>
                                        <!-- <p class="location">
                                        
                                            <a href="{{$companyUrl}}" target="_blank"> <?php echo $company->url;?></a>
                                        </p> -->
                                        <h6 class="text-primary"><?php echo "Created at ".date('Y-m-d',strtotime($company->created_at));?></h6>


                                    </div>

                                </div>

                            </div>

                        </div>

                        <?php }}?>


                           
                    </div>
                        <div style="float:right"> @include('pagination.limit_links', ['paginator' => $companies])</div>
                </div>

            </div>

        </div>

    </div>

</div>