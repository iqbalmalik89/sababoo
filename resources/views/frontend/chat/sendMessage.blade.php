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
<body>
<div id="load">Please wait ...</div>



<center><a href="/user_view_message">View Your Messages</a></center><br />
<div class="container">
<div class="row">
    <div id="notif"></div>
    <div class="col-md-6 col-md-offset-3">
        <div class="well well-sm">
            <form class="form-horizontal">
                <span id="error" class="msg_error"></span>
                <fieldset>
                    <legend class="text-center">Write message</legend>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Name</label>
                        <div class="col-md-9">
                            <input  readonly id="name" type="text" placeholder="Your name" class="form-control" autofocus value="<?php echo $send_to_user->first_name;?>  <?php echo $send_to_user->last_name;?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="subject">Subject</label>
                        <div class="col-md-9">
                            <input id="subject" type="text" placeholder="Your subject" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="message">Your message</label>
                        <div class="col-md-9">
                            <textarea class="form-control" id="message" name="message" placeholder="Please enter your message here..." rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            <input id="send_to_user_id" type="hidden"  name="send_to_user_id" value="<?php echo $send_to_user->id;?>  ">
                            <button type="button" id="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                    <input type="hidden" name="email" id="email" value=" <?php echo $send_to_user->email;?> ">
                    <input type="hidden" name="sender_email" id="sender_email" value=" <?php echo $logged_user->email;?> ">
                    <input type="hidden" name="sender_name" id="sender_name" value=" <?php echo $logged_user->first_name;?> ">
                </fieldset>
            </form>
        </div>
    </div>
</div>
</div>

<script type="text/javascript" src="{{asset('assets/frontend/node_modules/socket.io/node_modules/socket.io-client/socket.io.js')}}"></script>

<script>
    $(document).ready(function(){
        $("#load").hide();

        var socket = new io.connect('http://sababoo.local:3000', {
            'reconnection': true,
            'reconnectionDelay': 1000,
            'reconnectionDelayMax' : 5000,
            'reconnectionAttempts': 5
        });
        $("#submit").click(function(){
            $( "#load" ).show();
            var dataString = {
                name : $("#name").val(),
                send_to_user_id : $("#send_to_user_id").val(),
                subject : $("#subject").val(),
                message : $("#message").val()
            };

            var msg = $.trim($("#message").val());
            if($("#message").val() == ""){
                $( "#load" ).hide();
                $('#error').html('Enter your  message');
                $('#error').show()
                $('#error').delay(1500).fadeOut();

                return false;
            }
            $.ajax({
                type: "POST",
                url: "/user_send_message",
                data: dataString,
                dataType: "json",
                cache : false,
                success: function(data){
                  //  console.log(data);
                    $( "#load" ).hide();
                  //  $("#name").val('');
                  //  $("#email").val('');
                    $("#subject").val('');
                    $("#message").val('');
                    if(data.code == 200){
                      //  alert(window.location.hostname);
                      //  $("#notif").html(data.notif);
                        //var socket = io.connect( 'http://'+window.location.hostname+':3000' );
                       /* socket.emit('new_count_message', {
                            new_count_message: data.new_count_message
                        });*/
                     socket.emit('new_message', {email: $.trim($('#email').val()),msg:msg,from: $.trim($('#sender_email').val()),sender_name: $.trim($('#sender_name').val())});
                        window.location = "/user_view_message";

                       /* socket.emit('new_message', {
                            name: data.name,
                           // email: data.email,
                            send_to_user_id: data.send_to_user_id,
                            subject: data.subject,
                            created_at: data.created_at,
                            id: data.id
                        });*/
                    } else if(data.success == false){
                        $("#name").val(data.name);
                       // $("#email").val(data.email);
                        $("#subject").val(data.subject);
                        $("#message").val(data.message);
                        $("#notif").html(data.notif);
                    }

                } ,error: function(xhr, status, error) {
                    alert(error);
                },
            });
        });
    });
</script>
@endsection
