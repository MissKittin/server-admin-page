<?php include($system['location_php'] . '/lib/prevent-direct.php'); prevent_direct('login.php'); ?>
<?php
	$login_method='multi';

	// multi method config
	$USER=['yourusername'];
	$PASSWORD=['yourpassword'];

	// pam method config
	$login_allowed_users=['yourlogintolinux'];
?>
