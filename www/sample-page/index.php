<?php include($system_location_php . '/lib/login/login.php'); ?>
<?php chdir($system_location_php); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sample item</title>
		<?php include($system_location_php . '/lib/htmlheaders.php'); ?>
	</head>
	<body>
		<?php include($system_location_php . '/lib/header.php'); ?>
		<div>
			<?php include($system_location_php . '/lib/menu/menu.php'); ?>
			<div id="content">
				<h1>Sample item</h1>
				Sample text
			</div>
		</div>
	</body>
</html>