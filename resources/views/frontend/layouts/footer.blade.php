            
<?php 
    if (isset($sticky_footer) && $sticky_footer != '') {
        $sticky_footer = $sticky_footer;
    } else {
        $sticky_footer = '';
    }
?>
            <footer class="footer-wrapper">
            
                <!-- <div class="main-footer">
                
                    <div class="container">
                    
                        <div class="row">
                        
                            <div class="col-sm-12 col-md-9">
                            
                                <div class="row">
                                
                                    <div class="col-sm-6 col-md-4">
                                    
                                        <div class="footer-about-us">
                                            <h5 class="footer-title">about HaNgan</h5>
                                            <p>Sudden looked elinor off gay estate nor silent. Son read such next see the rest two. Was use extent old entire sussex...</p>
                                            <a href="#">read more</a>
                                        </div>

                                    </div>
                                    
                                    <div class="col-sm-6 col-md-5 mt-30-xs">
                                        <h5 class="footer-title">quick links</h5>
                                        <ul class="footer-menu clearfix">
                                            <li><a href="#">Local Jobs</a></li>
                                            <li><a href="#">Company Directory</a></li>
                                            <li><a href="#">Browse Jobs</a></li>
                                            <li><a href="#">Salary Estimator</a></li>
                                            <li><a href="#">Success Stories</a></li>
                                            <li><a href="#">Help</a></li>
                                            <li><a href="#">Post a Job</a></li>
                                            <li><a href="#">Employer Login</a></li>
                                            <li><a href="#">Publisher</a></li>
                                            <li><a href="#">Include My Jobs</a></li>
                                        </ul>
                                    
                                    </div>

                                </div>

                            </div>
                            
                            <div class="col-sm-12 col-md-3 mt-30-sm">
                            
                                <h5 class="footer-title">newsletter</h5>
                                
                                <p>Subsribe to get our latest updates and oeffers</p>
                                
                                <div class="footer-newsletter">
                                    
                                    <div class="form-group">
                                        <input class="form-control" placeholder="enter your email " />
                                        <button class="btn btn-primary">subsribe</button>
                                    </div>
                                    
                                    <p class="font-italic font13">*** Don't worry, we wont spam you!</p>
                                
                                </div>

                            </div>

                            
                        </div>
                        
                    </div>
                    
                </div> -->
                
                <div class="bottom-footer {{$sticky_footer}}">
                
                    <div class="container">
                    
                        <div class="row">
                        
                            <div class="col-sm-3 col-md-3">
                    
                                <p class="copy-right">&#169; Copyright 2017 Sababoo</p>
                                
                            </div>
                            
                            <div class="col-sm-5 col-md-5">
                            
                                <ul class="bottom-footer-menu">
                                    <li><a href="{{url('/user/list_users')}}">Users</a></li>
                                    <li><a href="{{url('/job/user_job_list')}}">Jobs</a></li>
                                    <li><a href="{{url('/network/connection')}}">Network</a></li>
                                    <li><a href="{{url('/user_view_message')}}">Messages</a></li>
                                    <li><a href="{{url('/transactions')}}">Transactions</a></li>
                                    <li><a href="{{url('/job/news/0')}}">News</a></li>
                                    <li><a href="{{url('/companies')}}">Companies</a></li>
                                    <li><a href="{{url('/about-us')}}">About Us</a></li>
                                    <li><a href="{{url('/contact-us')}}">Contact Us</a></li>
                                </ul>
                            
                            </div>
                            
                            <div class="col-sm-4 col-md-4">
                                <ul class="bottom-footer-menu for-social">
                                    <li><a href="#"><i class="ri ri-twitter" data-toggle="tooltip" data-placement="top" title="twitter"></i></a></li>
                                    <li><a href="#"><i class="ri ri-facebook" data-toggle="tooltip" data-placement="top" title="facebook"></i></a></li>
                                    <li><a href="#"><i class="ri ri-google-plus" data-toggle="tooltip" data-placement="top" title="google plus"></i></a></li>
                                    <li><a href="#"><i class="ri ri-youtube-play" data-toggle="tooltip" data-placement="top" title="youtube"></i></a></li>
                                </ul>
                            </div>
                        
                        </div>

                    </div>
                    
                </div>
            
            </footer>

            <script>

                socket.on('new_message',function(data){
                    //alert(data);
                    //$chat.append('<b>'+data.rec_name+':</b>'+data.message+ "<br/>");
                    //$chat.append('<b>'+data.rec_name+':</b>'+data.message+ "<br/>");
                 //   console.log(data);
                    $('#msg_notification').html('*');
                    $('#notif_audio')[0].play();
                    $("#message_app_"+data.sender_id).scrollTop($("#message_app_"+data.sender_id)[0].scrollHeight);
                    $("#message_app_"+data.sender_id).animate({ scrollTop: $("#message_app_"+data.sender_id).scrollTop() }, 1000);


                    //console.log($('#user_side_bar_'+from_email).length);

                    if(data.sender_id!=undefined){
                        if($('#user_side_bar_list #user_side_bar_'+data.sender_id).length==0){

                            var str_li = '';
                            str_li= '<li class="send_user_list" id="user_side_bar_'+data.sender_id+'" class="send_user_list" tab="'+data.sender_id+'" tab2="'+data.from+'"  tab3="'+data.rec_name+'" tab4="msg_id" tab5="'+data.sender_image+'">';
                            str_li+='<div class="blue-circle"></div>';
                            str_li+='<div class="listing-pic">';
                            str_li+='<img id="employee_image_1" class="img-circle" alt="image" src="/user_images/'+data.sender_image+'">';
                            str_li+='</div>';
                            str_li+='<h3>'+data.rec_name+'..';
                            str_li+='<span>';
                            str_li+='<p class="summary" id="summary">'+data.message+'</p></span></h3>';
                            str_li+='<a href="#"><i class="fa fa-times-circle-o"></i></a> </li>';
                            $('#user_side_bar_list').append(str_li);
                        }

                        $('#user_side_bar_'+data.sender_id).find('#summary').html(data.message);

                    }
                    // user_side_bar_list
                    //$('.chating-section').attr('id', 'message_app_'+data.sender_id);

                    $('#message_app_'+data.sender_id).append('<div class="me"> <div class="gry-chat">'+data.message+'</div> <div class="time f-left">'+hours+':'+minutes+ format+'</div> </div>');
                    //$(".chating-section").scrollTop($("#message_app_"+data.sender_id).scrollHeight);
                   // $(".chating-section").animate({ scrollTop: $(".chating-section").scrollTop() }, 1000);
                  //  $('#message_app_'+data.sender_id).animate({ scrollTop: $("#message_app_"+data.sender_id).scrollTop() }, 1000);
                    //$chat.append('<div class="me"> <div class="gry-chat">'+data.message+'</div> <div class="time f-left">'+hours+':'+minutes+ format+'</div> </div>');

                    // Check users first message if yes than reload page
                    pageURI = '/chat/get_logged_user_message';
                    request_data = {userid:userid_log}
                    mainAjax('', request_data, 'POST',CallLoggedUser);



                    //$chat.append('<div class="your"> <div class="blue-chat">'+data.message+'</div> <div class="time f-left">11:00pm</div> </div>');


                });

                function CallLoggedUser(data){
                    $('#new_count_message').html(data.data);
                    if(data.data<=1){
                        location.reload();
                    }

                }

            </script>