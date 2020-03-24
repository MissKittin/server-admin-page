<?php
	// fake 404 - you cannot list this dir
	if(!function_exists('prevent_index')) include($system['location_php'] . '/lib/prevent-direct.php');
	prevent_index();
?>