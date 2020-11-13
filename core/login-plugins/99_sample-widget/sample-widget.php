<?php if(!function_exists('prevent_direct')) include($system['location_php'] . '/lib/prevent-direct.php'); prevent_direct('sample-widget.php'); ?>
<div>
	<h1>Sample widget</h1>
	Sample text
	<?php echo shell_exec($system['location_php'] . '/login-plugins/' . $plugin . '/shell.sh sample-command'); ?>
</div>
