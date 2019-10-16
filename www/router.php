<?php
	// Scripts settings
	$system_location_html=''; // none if in root directory, for browser
	$system_location_php=$_SERVER['DOCUMENT_ROOT'] . ''; // for php scripts
	$system_title='Router';

	/* This script:
		- deny access to all scripts if 'DISABLED.MAIN' exists
		- hides itself
		- handles 404 file not found error
		- deny access to *.sh, *.rc and *.txt files
		- preventing access to module if index.php is in URI
		- deny access to files: 'disabled', 'description.php' and 'menu-addon.php'
		- deny access to disabled modules
	*/

	// disable switch
	if((file_exists($system_location_php . '/DISABLED.MAIN')) && ($_SERVER['REMOTE_ADDR'] != '127.0.0.1'))
	{
		echo '<!DOCTYPE html>
			<html>
				<head>
					<title>'.$system_title.'</title>
					<meta charset="utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<style>
						body {
							color: #ffffff;
							background-color: #000000;
						}
						h1 {
							position: fixed;
							top: 45%;
							left: 45%;
							text-align: center;
						}
						@media only screen and (max-width: 850px) {
							h1 {
								left: 35%;
							}
						}
					</style>
				</head>
				<body>
					<h1>Disabled</h1>
				</body>
			</html>
		';
		exit();
	}

	// hide this script - fake 404
	if(strtok($_SERVER['REQUEST_URI'], '?') === $system_location_html . '/router.php')
	{
		http_response_code(404);
		echo '<!DOCTYPE html>
			<html>
				<head>
					<title>'.$system_title.'</title>
					'; include($system_location_php . '/lib/htmlheaders.php'); echo '
					<meta http-equiv="refresh" content="0; url=.">
				</head>
			</html>
		';
		exit();
	}

	// 404 handle
	/*not file exist cut after $CHAR absolute path                           $CHAR */
	if(!file_exists(strtok($_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI'], '?')))
	{
		http_response_code(404);
		if(substr(strtok($_SERVER['REQUEST_URI'], '?'), -1) === '/')
			$url='..';
		else
			$url='.';

		echo '<!DOCTYPE html>
			<html>
				<head>
					<title>'.$system_title.'</title>
					'; include($system_location_php . '/lib/htmlheaders.php'); echo '
					<meta http-equiv="refresh" content="0; url=' . $url . '">
				</head>
			</html>
		';
		exit();
	}

	// denied file types
	if(preg_match('/\.(?:sh|rc|txt)$/', $_SERVER['REQUEST_URI'])) // if type ****.xxx in url
	{
		http_response_code(404);
		echo '<html>
			<head>
				<title>'.$system_title.'</title>
				'; include($system_location_php . '/lib/htmlheaders.php'); echo '
				<meta http-equiv="refresh" content="0; url=.">
			</head>
		</html>';
		exit();
	}

	// url with index.php destroys application - prevent this
	if(strtok(substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1), '?') === 'index.php')
	{
		http_response_code(404);
		echo '<html>
			<head>
				<title>'.$system_title.'</title>
				'; include($system_location_php . '/lib/htmlheaders.php'); echo '
				<meta http-equiv="refresh" content="0; url=.">
			</head>
		</html>';
		exit();
	}

	// fake 404 if path point to file 'disabled', 'description.php' and 'menu-addon.php'
	if((strtok(substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1), '?') === 'disabled') || (strtok(substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1), '?') === 'description.php') || (strtok(substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1), '?') === 'menu-addon.php'))
	{
		http_response_code(404);
		echo '<html>
			<head>
				<title>'.$system_title.'</title>
				'; include($system_location_php . '/lib/htmlheaders.php'); echo '
				<meta http-equiv="refresh" content="0; url=..">
			</head>
		</html>';
		exit();
	}

	// deny access to disabled modules
	if(file_exists($system_location_php . strtok($_SERVER['REQUEST_URI'], '?') . '/disabled'))
	{
		http_response_code(404);
		echo '<html>
			<head>
				<title>'.$system_title.'</title>
				'; include($system_location_php . '/lib/htmlheaders.php'); echo '
				<meta http-equiv="refresh" content="0; url=..">
			</head>
		</html>';
		exit();
	}

	// abort script - load destination file
	return false;
?>
