<?php
/**
 * Created by PhpStorm.
 * User: Suresh Kumar
 */
?>

<p>Hello {{$firstname}} {{$lastname}},</p>

<p>Thank You for creating your new Sababoo  Account:</p>

Username  : {{$email}}<br>

<p>To fully activate your account, please click the link below
 which will verify your email address.<p>
 {{$SERVER_PATH}}/activate?e={{$verifycode}}
<p>If link is not clickable, copy and paste it into the browser’s address bar.</p>

<p>Thank you for choosing Sababoo!</p>