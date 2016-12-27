@extends('frontend.layouts.master')
@section('title', 'User Chat')
@section('description', 'Share your jobs with sababo,Sababoo is a job portal')
@section('keywords', 'Sababoo,  Sababoo Tradesman, Sababoo Job Recuritment,Sababoo Employer,Sababoo Employee','Sababoo Employee Edit Profile')


@section('content')
    <style>
        #load { height: 100%; width: 100%; }
        #load {
            position    : fixed;
            z-index     : 99999; /* or higher if necessary */
            top         : 0;
            left        : 0;
            overflow    : hidden;
            text-indent : 100%;
            font-size   : 0;
            opacity     : 0.6;
            background  : #E0E0E0 url(../assets/frontend/images/load.gif) center no-repeat;
        }

        .RbtnMargin { margin-left: 5px; }


    </style>

    <div id="load">Please wait ...</div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav nav-pills pull-right" role="tablist">
            <li role="presentation" style="display: none;"><a href="/user_view_message">New messages <span class="badge" id="new_count_message"><?php echo $update_count_message;?></span></a></li>
        </ul>
    </div>




    <div id="new-message-notif"></div>
    <div class="container">


        <!--//// chat section ///-->
        <div class="section " style="padding: 24px 0;">
            <div class="container">
                <div class="row">
                    <div id="notif"></div>

                    <div class="col-sm-4 col-md-4 no-magin no-padding">
                        <div class="employee-detail-sidebar sidebar-message">
                            <div class="all-messages-div">
                                <div class="message-text">All Messages</div>
                                <div  STYLE="display: none;" class="message-add"><a href="#"><i class="fa fa-edit" aria-hidden="true"></i></a></div>
                            </div>
                            <div class="search-div" > <span><i class="fa fa-search" style="color:#1896cd; font-size:18px;" ></i></span>
                                <input name="" type="text" placeholder="Search " id="search_msg_input" value="">
                                <span id="search_cross" style="display: none;"><i class="fa fa-times-circle-o" ></i></span> 
                            </div>
                            <div class="listing-online-div">
                                <ul id="user_side_bar_list">

                                    <?php foreach($sender_data as $single_user){
                                           // dd($single_user);
                                    ?>
                                        <li id="user_side_bar_<?php echo $single_user->userid;?>" class="send_user_list" tab="<?php echo $single_user->userid;?>" tab2="<?php echo  $single_user->email;;?>"  tab3="<?php echo  $single_user->first_name;;?>" tab4="<?php echo  $single_user->msg_id;?>" tab5="<?php echo  $single_user->image;?>">
                                        <div class="blue-circle"></div>
                                        <div class="listing-pic">

                                            <?php
                                            if(isset($single_user->image) && $single_user->image!=''){
                                                $user_image = "user_images/".$single_user->image;
                                            }
                                            ?>

                                            <?php if(empty($user_image)) {?>
                                            <img id="employee_image_1" class="img-circle" alt="image" src="{{asset('assets/frontend/images/site/dummy-user.jpg')}}" onerror="imgError(this);">
                                            <?php
                                            }else {
                                            ?>
                                            <img id="employee_image_1" class="img-circle" alt="image" src="<?php echo $user_image;?>" onerror="imgError(this);">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <h3><?php echo $single_user->first_name;?>..
                                            <span>
                                                <p class="summary" id="summary"> </p>
                                            </span>
                                        </h3>
                                        <a href="#"></a> </li>

                                    <?php  }?>
                                     </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-7 col-md-5 no-magin no-padding">
                        <div class="chat-box">
                            <div class="chating-people">
                                <div class="chat-pic" >
                                    <img src="{{asset('assets/frontend/images/site/dummy-user.jpg')}}" onerror="imgError(this);" id="sender_image" class="img-circle">
                                </div>
                                <h3 id="sender_username"><span></span></h3>

                            </div>
                            <div class="chating-section" id="message_app">

                                <?php
                                    $class_hide = "";
                                 if(count($all_messages)<=0){
                                     $class_hide="display:none;";

                                     echo "<h4>Sorry. We havn't found any conservation..<h4>";
                                 }
                                 //foreach($all_messages as $single_message){
                                    //echo //$single_message->message ."<br>";
                               // }?>

                            </div>
                            <div id="userForm">

                                <input type="hidden" name="username" id="username" value="<?php echo $userinfo->first_name;?>">
                                <input type="hidden" name="email" id="email" value="<?php echo $userinfo->email;?>">
                                <input type="hidden" name="userid" id="userid" value="<?php echo $userinfo->id;?>">
                                <input type="hidden" name="messageRecepient" id="messageRecepient" value="1">
                                <input type="hidden" name="reciever_email" id="reciever_email" value="1">
                                <input type="hidden" name="reciever_name" id="reciever_name" value="1">

                            </div>
                            <form class="form-horizontal" id="messageForm" >

                                <div class="text-area-div">
                                    <textarea id ="message" name="message" cols="" rows="" style="width:100%; height:100%; border:none; padding:10px;" placeholder="Write your message…"></textarea>
                                    <div><i id="typing_text" style="color:green;"></i></div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 text-right">
                                        <button type="submit" id="submit" class="btn btn-primary">Reply</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--//// chat section end ///-->

    </div>

    <script type="text/javascript" src="{{asset('assets/frontend/node_modules/socket.io/node_modules/socket.io-client/socket.io.js')}}"></script>
    <script>

        $('#search_msg_input').keyup(function(){
            var search_input = $(this).val();
            if (search_input.length > 0) {
                $('#search_cross').show();
            } else {
                $('#search_cross').hide();
            }
        });
        var currentTime = new Date()
        var hours = currentTime.getHours()
        var minutes = currentTime.getMinutes()
        var format ="AM";
        if(hours>11)
        {format="PM";}


        $("#load").hide();


           // var socket = io.connect( );
            var url = '<?php echo env('URL');?>:3000'
            //alert(url);

          /*  var socket = new io.connect(url, {
                'reconnection': true,
                'reconnectionDelay': 1000,
                'reconnectionDelayMax' : 5000,
                'reconnectionAttempts': 5
            });*/


       /* socket.emit('new user',$('#email').val() ,function(data){

               // $('.send_user_list').trigger('click');
              // $( ".send_user_list" ).first().trigger('click');
            });*/



            var $messageForm=$('#messageForm');
            var $message = $('#message');
            var $chat = $('#message_app');
            var userForm =$('#userForm');
            var username =$('#username');
            var sender_email =$('#email');
            var receive_name =$('#email');
            var userid =$('#userid');
            var userid_log =$('#userid').val();

            var userData = {
                userID: $('#userid').val(),
                userName: $('#username').val(),
                clientID: Math.floor(Math.random() * 10) + 1,
            };


            $messageForm.submit(function(e){
                e.preventDefault();

                var nameVal = $( "#nameInput" ).val();
                var msg = $message.val();
                var messageRecepient = $('#reciever_email').val();
                var recp_id =$('#messageRecepient').val();
                //socket.emit( 'send message', { sender_id: userid.val(), message: msg, recepient: messageRecepient } );
               // socket.emit( 'send message', msg ,messageRecepient,function(data){
                    // add stuff later
               // });

               socket.emit('new_message', {email: messageRecepient,msg:msg,from:sender_email.val(),sender_name:username.val(),sender_id:userid_log});

              // $chat.append('<b>'+username.val()+':</b>'+msg+ "<br/>");
               $("#message_app_"+recp_id).append('<div class="your"> <div class="blue-chat">'+msg+'</div> <div class="time f-right">'+hours+':'+minutes+ format+'</div> </div>');
                $("#message_app_"+recp_id).scrollTop($("#message_app_"+recp_id)[0].scrollHeight);
               //alert(recp_id);

                //$('.chating-section').scrollTop($(".chating-section")[0].scrollHeight);


                pageURI = '/chat/save_user_messages';
                request_data = {userid:userid.val(),send_to_user_id:$('#messageRecepient').val(),message:msg}
                mainAjax('', request_data, 'POST',callUsersSendMessages);
                $("#message").val('').focus();

                return false;


               // socket.emit('send message',$message.val());
               // $message.val('');


            });


            socket.on('whisper',function(data){
                $chat.append('<b>'+data.email+':</b>'+data.msg+ "<br/>");

            });


            socket.on( 'userData', function( data ) {
                //console.log('userData at clientside');
                $( "#myName" ).html('Hello! You are <b style="color:red">' + data.username + '</b>');
            });

           /* socket.on( 'allUsers', function( data ) {
                var userDetails = data.userDetails;
                $( "#all_users" ).html('');
                $('#messageRecepient').html('');
                for(var key in userDetails) {
                    $( "#all_users" ).append('<li>' +  userDetails[key]  + '</li>');
                    $( "#messageRecepient" ).append('<option value="'+key+'">' +  userDetails[key]  + '</option>');
                }
            });*/



            //OnClick user list



        function notifyTyping() {
            var user = $('#username').val();
            socket.emit('notifyUser', user);
        }
        socket.on('notifyUser', function(user){
            var me = $('#username').val();
            if(user != me) {
                $('#typing_text').text(user + ' is typing ...');
            }
            setTimeout(function(){ $('#typing_text').text(''); }, 3000);;
        });

            // On msg typing
            $( "#message" ).keyup( function(event) {
                //console.log('clientside keyup');
                var nameVal = $('#reciever_name').val();
               // var msg = $( "#message" ).val();

              // socket.emit( 'typing', { name: $('#reciever_name').val()} );
                notifyTyping();

                if (event.which == 13) {
                    event.preventDefault();
                    $messageForm.submit();
                }


            });

           /*var typingClear = false;
            socket.on( 'typing', function( data ) {
                console.log(data,$('#username').val());
                    if(data==$('#username').val()){
                        $( "#typing_text" ).html( data.name + ' is typing...' );
                    }
                clearTimeout(typingClear);
                typingClear = setTimeout(function() {
                    $( "#typing_text" ).html( '' );
                }, 3000);
            });
*/


            //NEW MESSAGE COUNT

            socket.on( 'new_count_message', function( data ) {
                alert(data.new_count_message)

                $( "#new_count_message" ).html( data.new_count_message );
                $('#notif_audio')[0].play();
            });



       // });

            $(document).ready(function(){
               // var loged_userid=  $('#userid').val();
                $('#msg_notification').html('');

                $(document).on("click", '.send_user_list', function(e) {

                    e.preventDefault();


                    $(this).prevAll().removeClass('selected');
                    $(this).nextAll().removeClass('selected');
                    $(this).addClass('selected');

                    // $(this).addClass('selected');
                    $('#messageRecepient').val($(this).attr('tab'));
                    $('#reciever_email').val($(this).attr('tab2'));
                    $('#reciever_name').val($(this).attr('tab3'));
                    var sender_id = $(this).attr('tab');
                    $('#sender_username').html($(this).attr('tab3')+'..');

                    $('#user_side_bar_'+sender_id).find('#summary').html('');

                     $('.chating-section').removeAttr('id');
                    $('.chating-section').attr('id', 'message_app_'+sender_id);


                    $('#sender_image').attr('src','user_images/'+$(this).attr('tab5'));
                    pageURI = '/chat/get_users_message';
                    request_data = {sender_id:sender_id}
                    //mainAjax('', request_data, 'POST',callUsersMessages);
                    mainAjax('', request_data, 'POST',function(data){
                        if(data)
                        {
                            var str = '';
                            var userid= 0;
                            $.each(data.data, function(k,v) {
                                userid= v.userid;
                              //  console.log(v.userid,userid_log);
                                if(v.userid==userid_log){
                                    //str+='<span class="left" style="float:left">'+v.message+"</span><br>";
                                    str+='<div class="your"> <div class="blue-chat">'+v.message+'</div> <div class="time f-right">'+v.create_msg+'</div> </div>';
                                }else{
                                    // alert(v.message);
                                    //str+='<span class="right"  style="float:right">'+v.message+"</span><br>";
                                    str+='<div class="me"> <div class="gry-chat">'+ v.message+'</div> <div class="time f-left">'+v.create_msg+'</div> </div>';
                                }


                            });
                            // $('.chating-section').attr('id', 'message_app_'+userid);
                            $('#message_app_'+ sender_id).html(str);
                            $("#message_app_"+sender_id).scrollTop($("#message_app_"+sender_id)[0].scrollHeight);
                            //$("html, body").animate({ scrollTop: $('#message_app_'+ sender_id).scrollTop() }, 1000);

                            //alert(userid);

                            //$('.chating-section').scrollTop = $('.chating-section').scrollHeight;
                        }


                    });

                });

                $('.send_user_list').first().trigger("click");



                /* $('.send_user_list').click(function(e){

                 });*/

            });

        function callUsersMessages(data){
            //var message_app
            //$('#message_app').scrollDown = $('#message_app').scrollHeight;
             //  var mssg =  $('.chating-section');
               //  mssg.scrollTop(mssg[0].scrollHeight);
            console.log(data);
            var str = '';
            var userid= 0;
            $.each(data.data, function(k,v) {
                userid= v.userid;
               console.log(v.userid,userid_log);
                if(v.userid==userid_log){
                    //str+='<span class="left" style="float:left">'+v.message+"</span><br>";
                    str+='<div class="your"> <div class="blue-chat">'+v.message+'</div> <div class="time f-right">'+v.create_msg+'</div> </div>';
                }else{
                   // alert(v.message);
                    //str+='<span class="right"  style="float:right">'+v.message+"</span><br>";
                    str+='<div class="me"> <div class="gry-chat">'+ v.message+'</div> <div class="time f-left">'+v.create_msg+'</div> </div>';
                }


            });
           // $('.chating-section').attr('id', 'message_app_'+userid);
            $('#message_app_'+ userid).html(str);
            alert(userid);

           //$('.chating-section').scrollTop = $('.chating-section').scrollHeight;
          $("#message_app_"+userid).scrollTop($("#message_app_"+userid)[0].scrollHeight);


        }

       function callUsersSendMessages(data){
            console.log(data);
       }

          // End of Document ready


    </script>
@endsection
