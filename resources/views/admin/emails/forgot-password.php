<!DOCTYPE html>
<html>
<head>

</head>
<body>
Hi, <?php echo $user->first_name; ?>
<br/>
<br/>
To reset your password please click the following link.
<br/>
<br/>

<a href="<?php echo URL::to('/admin/recover-password?code='.$user->recover_password_key);?>">Recover Link</a>

?>
<br/>
<br/>
Regards,
<br/>
Administrator

</body>
</html>
