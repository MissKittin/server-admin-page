<?php
	// fake 404 - you cannot list this dir
	include($system['location_php'] . '/lib/prevent-direct.php');
	goto_home();
?>