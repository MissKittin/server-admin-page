<?php include($system['location_php'] . '/lib/prevent-direct.php'); prevent_direct('default.php'); ?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $system['title']; ?> Login</title>
		<?php include($system['location_php'] . '/lib/htmlheaders.php'); ?>
	</head>
	<body>
		<div id="login_body">
			<h1><?php echo $system['title']; ?> Login</h1>
			<form action="." method="post">
				Username: <input type="text" name="user"><span id="login_hostname">@<?php echo $_SERVER['HTTP_HOST']; ?></span><br>
				Password: <input type="password" name="password"><br>
				<input type="submit" value="Login" class="system_button">
			</form>
			<br>
			<div id="system_login_content">
				<?php
					// Widgets render part
					$plugins=scandir($system['location_php'] . '/login-plugins');

					foreach($plugins as $plugin)
						if(($plugin != '.') && ($plugin != '..') && (is_dir($system['location_php'] . '/login-plugins/' . $plugin))) // directory filter
							if(!file_exists($system['location_php'] . '/login-plugins/' . $plugin . '/disabled')) // check if widget is not disabled
								include($system['location_php'] . '/login-plugins/' . $plugin . '/' . str_replace('_', '', strstr($plugin, '_')) . '.php');
					unset($plugins); unset($plugin) // clear environment
				?>
			</div>
		</div>
	</body>
</html>