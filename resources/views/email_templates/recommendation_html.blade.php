<?php
/**
 * Created by PhpStorm.
 * User: Suresh Kumar
 */
?>

<p>Hello ,</p>

<p>We receive recommendation want to read please click below link</p>

From    : {{$sender_first_name}}  {{$sender_last_name}}
<br>
Email: {{$from}}
<br>

<p>.<p>
    {{$SERVER_PATH}}/network/get_recommendation/{{$rec_id}}
<p>If link is not clickable, copy and paste it into the browser's address bar.</p>

<p> Once verified, one of our account managers will reach out to you during our normal
    business hours, which are Mon - Fri 9am - 6pm EST.</p>

<p>Thank you for choosing Sababoo!</p>