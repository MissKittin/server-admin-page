<?php if(!function_exists('prevent_direct')) include($system['location_php'] . '/lib/prevent-direct.php'); prevent_direct('login.php'); ?>
<?php
	$login_method='multi_bcrypt'; // multi || multi_bcrypt

	// multi/multi_bcrypt method config
	$USER=['yourusername'];
	$PASSWORD=['your_plain_password_for_multi__or_password_hash_for_multi_bcrypt'];
?>
