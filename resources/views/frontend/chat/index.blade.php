@extends('frontend.layouts.master')

@section('title', 'User Chat')
@section('description', 'Share your jobs with sababo,Sababoo is a job portal')
@section('keywords', 'Sababoo,  Sababoo Tradesman, Sababoo Job Recuritment,Sababoo Employer,Sababoo Employee','Sababoo Employee Edit Profile')


@section('content')
    <script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>
    <script>
        var socket = io();
        $('form').submit(function(){
            socket.emit('chat message', $('#msg').val());
            $('#msg').val('');
            return false;
        });
        socket.on('chat message', function(msg){
            $('#messages').append($('<li>').text(msg));
        });
    </script>
    <!-- start Main Wrapper -->
<div class="main-wrapper">

    <!-- start breadcrumb -->
    <div class="breadcrumb-wrapper">

        <div class="container">

            <ol class="breadcrumb-list booking-step">
                <li><a href="">Home</a></li>
                <li><a href="">Your Admin</a></li>
                <li><span>Chat</span></li>
            </ol>

        </div>

    </div>
    <!-- end breadcrumb -->

    <div class="section sm">

        <div class="container">

            <div class="row">
                    <style type="text/css">
                        #messages{
                            border: 1px solid black;
                            height: 300px;
                            margin-bottom: 8px;
                            overflow: scroll;
                            padding: 5px;
                        }
                    </style>
                    <div class="container spark-screen">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Chat Message Module</div>
                                    <div class="panel-body">
                                        <ul id="msg">

                                        </ul>

                                        <div class="row">
                                            <div class="col-lg-8" >
                                                <div id="messages" ></div>
                                            </div>
                                            <div class="col-lg-8" >
                                                <form action="sendmessage" method="POST">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                                                    <input type="hidden" name="user" value="{{ Auth::user()->name }}" >
                                                    <textarea id="msg" class="form-control msg"></textarea>
                                                    <br/>
                                                    <input type="button" value="Send" class="btn btn-success send-msg">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


             </div>
         </div>

        </div>

    </div>

@endsection

