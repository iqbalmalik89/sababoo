<?php
/**
 * Created by PhpStorm.
 * User: Suresh Kumar
 */
?>

<p>Hello</p>
<br>

<p>You receive comments on your job</p>

<p>From {{$sender_email}}</p>
<p>{{$comments}}</p>

<p>To view the comment please click url link.</p>

{{$SERVER_PATH}}/job/view/{{$jobid}}
<p>If link is not clickable, copy and paste it into the browser's address bar.</p>

<p>Thank you for choosing Sababoo!</p>