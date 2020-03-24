<?php if(!function_exists('prevent_direct')) include($system['location_php'] . '/lib/prevent-direct.php'); prevent_direct('menu.php'); ?>
<?php
	// Menu module - select module by $system['menu'] or read cached content
	// 03.11.2019, 20.03.2020

	if(!@include($system['location_php'] . '/cache_menu.php'))
	{
		if(!isset($system['menu']))
			echo '<!-- menu: no menu module defined -->' . "\n";
		else
			include $system['location_php'] . '/lib/menu/' . $system['menu'] . '/menu.php';
	}
?>