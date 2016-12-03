<!DOCTYPE html>
<html>
<head>

</head>
<body>
Hi, <?php echo $user->first_name; ?>
<br/>
<br/>
Congratulations! Your account has been successfully created.
<br/>
<br/>
Please click the link below to activate your account:
<br/>
<br/>
<a href="<?php echo URL::to('/admin/activation?code='.$user->activation_token);?>">Click Here</a>
<br/>
<br/>
Regards,
Administrator

</body>
</html>
