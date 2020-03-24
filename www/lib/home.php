<?php if(!function_exists('prevent_direct')) include($system['location_php'] . '/lib/prevent-direct.php'); prevent_direct('home.php'); ?>
<?php include($system['location_php'] . '/lib/login/login.php'); ?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $system['title']; ?></title>
		<?php include($system['location_php'] . '/lib/htmlheaders.php'); ?>
	</head>
	<body>
		<?php include($system['location_php'] . '/lib/header.php'); ?>
		<div id="system_body">
			<?php include($system['location_php'] . '/lib/menu/menu.php'); ?>
			<div id="system_content">
				<?php
					// Widgets render part
					$plugins=scandir($system['location_php'] . '/home-plugins');

					foreach($plugins as $plugin)
						if(($plugin != '.') && ($plugin != '..') && (is_dir($system['location_php'] . '/home-plugins/' . $plugin))) // directory filter
							if(!file_exists($system['location_php'] . '/home-plugins/' . $plugin . '/disabled')) // check if widget is not disabled
								include($system['location_php'] . '/home-plugins/' . $plugin . '/' . str_replace('_', '', strstr($plugin, '_')) . '.php');
					unset($plugins); unset($plugin) // clear environment
				?>
			</div>
		</div>
	</body>
</html>