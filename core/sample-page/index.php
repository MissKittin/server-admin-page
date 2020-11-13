<?php include($system['location_php'] . '/lib/login/login.php'); ?>
<?php chdir($system['location_php']); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sample item</title>
		<?php include($system['location_php'] . '/lib/htmlheaders.php'); ?>
	</head>
	<body>
		<?php include($system['location_php'] . '/lib/header.php'); ?>
		<div id="system_body">
			<?php include($system['location_php'] . '/lib/menu/menu.php'); ?>
			<div id="system_content">
				<h1>Sample item</h1>
				Sample text
			</div>
		</div>
	</body>
</html>