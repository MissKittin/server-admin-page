<?php
	if($plugin === $plugin_last)
	{ ?>
		<!-- Last item has &#9492;&#9472;&#9472 -->
		&#9500;&#9472;Sample submenu<br>
			&#9500;&#9472;&#9472;<a href="<?php echo $system['location_html']; ?>/sample-menu-addon?do=Thing" onclick="return confirm('Are you sure?');">Thing</a><br>
			&#9492;&#9472;&#9472;<a href="<?php echo $system['location_html']; ?>/sample-menu-addon?do=anotherThing" onclick="return confirm('Are you sure?');">Another Thing</a><br>
	<?php }
	else
	{ ?>
		&#9500;&#9472;Sample submenu<br>
			&#9500;&#9472;&#9472;<a href="<?php echo $system['location_html']; ?>/sample-menu-addon?do=thing" onclick="return confirm('Are you sure?');">Thing</a><br>
			&#9500;&#9472;&#9472;<a href="<?php echo $system['location_html']; ?>/sample-menu-addon?do=anotherThing" onclick="return confirm('Are you sure?');">Another Thing</a><br>
	<?php }
?>

