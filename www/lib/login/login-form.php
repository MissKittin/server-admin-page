<?php include($system_location_php . '/lib/prevent-direct.php'); prevent_direct('login-form.php'); ?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $system_title; ?> Login</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="<?php echo $system_location_html;?>/lib/theme.css">
		<?php include($system_location_php . '/lib/favicon/favicon.php'); ?>
	</head>
	<body>
		<div>
			<h1><?php echo $system_title; ?> Login</h1>
			<form action="." method="post">
				Username: <input type="text" name="user"><span id="hostname">@<?php echo $_SERVER['HTTP_HOST']; ?></span><br>
				Password: <input type="password" name="password"><br>
				<input type="submit" value="Login">
			</form>
			<br>
			<?php
				// Widgets render part
				$plugins=scandir($system_location_php . '/login-plugins');

				foreach($plugins as $plugin)
					if(($plugin != '.') && ($plugin != '..') && (is_dir($system_location_php . '/login-plugins/' . $plugin))) // directory filter
						if(!file_exists($system_location_php . '/login-plugins/' . $plugin . '/disabled')) // check if widget is not disabled
							include($system_location_php . '/login-plugins/' . $plugin . '/' . str_replace('_', '', strstr($plugin, '_')) . '.php');
				unset($plugins); unset($plugin) // clear environment
			?>
		</div>
	</body>
</html>