var express = require('express');
var app     = express();
var server  = require('http').createServer(app);

var socket  = require( 'socket.io' );
var io      = socket.listen( server );
var port    = process.env.PORT || 3000;
 users={};
 emails={};
connections =[];
var connectedUsers = 0;
var userDetails = {};





var server = app.listen(3000);
var io = require('socket.io').listen(server);


server.listen(port, function () {
    console.log('Server listening at port %d', port);
});


io.on('connection', function (socket) {

    connectedUsers++;
    //console.log( "New client !" );
    socket.userID = connectedUsers;
    socket.userName = 'User ' + socket.userName;
    userDetails[socket.id] = socket.userID;


    socket.on('new user', function (data,callback) {

        if(data in users){
            callback(false);
        }else{
            callback(true);
            socket.email=data;
            console.log("connected to user :"+socket.email);
            users[socket.email]=socket;
            userDetails[socket.email];
            //users.push(socket.email);
            updateEmails();
        }
        // console.log(users[socket.email]);
    });


    //console.log('User Connected!!',connections.length);
    //socket.on(socket.id).emit('userData', {username: socket.userName});

    /*socket.on( 'userData', function( data ) {
       socket.emit( 'userData', { username: socket.userName, } );

        //io.sockets.emit( 'new message', {msg: data });
    });*/
//    io.sockets.emit( 'allUsers', { userDetails: userDetails } );
    function updateEmails(){
        io.sockets.emit('username',Object.keys(users));

    }

    /**
     * Helper function for escaping input strings
     */
    function htmlEntities(str) {
        return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;')
            .replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }


    /*On Disconnet User*/
    socket.on('disconnect', function() {
        //console.log(userDetails[socket.id] + ' user disconnedted');
        console.log(socket.email+ ' user disconnedted');
        console.log(socket.id+ ' user disconnedted');

        //delete(userDetails[socket.id]);

        //if(!socket.email) return ;
        delete(socket.id);
        delete users[socket.email];

           // users.splice(users.indexOf(socket.email),1);
        updateEmails();
    })


    /* Disconnet*/
   /* socket.on('disconnect',function(data){
        connections.splice(connections.indexof(socket),1);
        console.log('Disconnected:  %s socket connected',connections.length);

    });*/




    socket.on( 'new_message', function( data ) {
        console.log(data);
        console.log('User email',data.email);
        //io.sockets.emit( 'new_message', {email: data.email,msg: data.msg,});
        //sockets[data.email].emit( 'new_message', {email: data.email,msg: data.msg,});
        users[data.email].emit("new_message",{message:data.msg,from:data.from,rec_name:data.sender_name,sender_id:data.sender_id,sender_image:data.sender_image});


    });






    /*Send new message*/

    socket.on( 'send message', function( data,recvr_email,callback ) {
        var msg = data.trim();
       // console.log( 'Message received from  ' + data.sender_id + ":" + data.message+": receiver:"+ data.recepient );
       // console.log(socket.userName,socket.id);

       // socket.emit( 'send message', data);
       /* if(userDetails[data.recepient]) {
            io.sockets.socket(data.recepient).emit( 'send messag', { name: socket.id, message: data.message } );
        }*/

        //TEST CODE
       //'skamrani2002@gmail.com'.emit('whisper', {msg: 'hello'});


        //End of TEST CODE
       // console.log(users);
        //io.sockets.emit( 'new message', {msg:msg,email:socket.email});
       // console.log("object keys : "+Object.keys(users));
       //if(email in users) {
          // console.log('to send'+email);

        console.log("recver detail "+recvr_email);
           //users[recvr_email].emit('whisper', {msg: msg, email: socket.email});
          // users[recvr_email].emit('whisper', {msg: msg, email: socket.email});
        //sockets(recvr_email).emit('whisper', { msg: msg, email: socket.email} );


        //}
       // }else{
         //  callback('Enter the valid name');
       //}

        io.sockets.emit( 'new message', {msg:msg,email:socket.email});
    });


    /*New Message Count */
    socket.on( 'new_count_message', function( data ) {
        io.sockets.emit( 'new_count_message', {
            new_count_message: data.new_count_message

        });
    });


    socket.on( 'typing', function( data ) {
        console.log( 'User is typing ' + socket.name );
        io.sockets.emit( 'typing', { name: data.name} );
    });

    socket.on('notifyUser', function(user){
        io.emit('notifyUser', user);
    });




});
