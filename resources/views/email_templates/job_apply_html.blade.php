<?php
/**
 * Created by PhpStorm.
 * User: Suresh Kumar
 */
?>

<p>Hello</p>
<br>

<p>You receive an application on your job</p>

<p>From {{$sender_email}}</p>
<p>{{(isset($post_data['cover_message']) && $post_data['cover_message'] != '')?$post_data['cover_message']:''}}</p>

<p>Thank you for choosing Sababoo!</p>