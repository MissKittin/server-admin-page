<?php include($system_location_php . '/lib/prevent-direct.php'); prevent_direct('home.php'); ?>
<?php include($system_location_php . '/lib/login/login.php'); ?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $system_title; ?></title>
		<?php include($system_location_php . '/lib/htmlheaders.php'); ?>
	</head>
	<body>
		<?php include($system_location_php . '/lib/header.php'); ?>
		<div>
			<?php include($system_location_php . '/lib/menu/menu.php'); ?>
			<div id="content">
				<?php
					// Widgets render part
					$plugins=scandir($system_location_php . '/home-plugins');

					foreach($plugins as $plugin)
						if(($plugin != '.') && ($plugin != '..') && (is_dir($system_location_php . '/home-plugins/' . $plugin))) // directory filter
							if(!file_exists($system_location_php . '/home-plugins/' . $plugin . '/disabled')) // check if widget is not disabled
								include($system_location_php . '/home-plugins/' . $plugin . '/' . str_replace('_', '', strstr($plugin, '_')) . '.php');
					unset($plugins); unset($plugin) // clear environment
				?>
			</div>
		</div>
	</body>
</html>
