<?php
/**
 * Created by PhpStorm.
 * User: Suresh Kumar
 */
?>

Hello
You receive an application on your job

From {{$sender_email}}
{{(isset($post_data['cover_message']) && $post_data['cover_message'] != '')?$post_data['cover_message']:''}}

Thank you for choosing Sababoo!