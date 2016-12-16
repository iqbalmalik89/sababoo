<?php
/**
 * Created by PhpStorm.
 * User: Suresh Kumar
 */
?>

<p>Hello</p>
<br>

<p>Your job {{$job_name}} has been updated by sababo admin.</p>

<p>From {{$sender_email}}</p>

<p>To view the job please click url link.</p>

{{$SERVER_PATH}}/job/view/{{$job_id}}
<p>If link is not clickable, copy and paste it into the browser's address bar.</p>