<?php include($system_location_php . '/lib/prevent-direct.php'); prevent_direct('sample-widget.php');?>
<div>
	<h1>Sample widget</h1>
	Sample text
	<?php echo shell_exec($system_location_php . '/home-plugins/' . $plugin . '/shell.sh sample-command'; ?>
</div>