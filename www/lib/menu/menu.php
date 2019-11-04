<?php include($system['location_php'] . '/lib/prevent-direct.php'); prevent_direct('menu.php'); ?>
<?php
	// Menu module - select module by $system['menu']
	// 03.11.2019

	if(!isset($system['menu']))
		echo '<!-- menu: no menu module defined -->' . "\n";
	else
		include $system['location_php'] . '/lib/menu/' . $system['menu'] . '/menu.php';
?>