<?php
/**
 * Created by PhpStorm.
 * User: Suresh Kumar
 */
?>

Hello {{$firstname}} {{$lastname}},

Thank You for creating your new Sababoo Account:

Username  : {{$email}}


To fully activate your account, please click the link below
which will verify your email address.
{{$SERVER_PATH}}/activate?e={{$verifycode}}

If link is not clickable, copy and paste it into the browser’s address bar.

Thank you for choosing Sababoo!