<?php
	// Scripts settings
	$system['location_html']=''; // none if in root directory, for browser
	$system['location_php']=$_SERVER['DOCUMENT_ROOT'] . ''; // for php scripts
	$system['title']='Server'; // <title>
	$system['theme']='default'; // see lib/htmlheaders/theme.php
	$system['login_theme']='default'; // form, see lib/login-themes
	$system['menu']='default'; // see lib/menu/menu.php

	/* This script:
		- exports system settings
		- deny access to all scripts if 'DISABLED.MAIN' exists
		- hides itself
		- handles 404 file not found error
		- deny access to *.sh, *.rc and *.txt files
		- preventing access to module if index.php is in URI
		- deny access to files: 'disabled', 'description.php' and 'menu-addon.php'
		- deny access to disabled modules
		- deny access to lib/htmlheaders.php and lib/htmlheaders/*
	*/

	// disable switch
	if((file_exists($system['location_php'] . '/DISABLED.MAIN')) && ($_SERVER['REMOTE_ADDR'] != '127.0.0.1'))
	{
		echo '<!DOCTYPE html>
			<html>
				<head>
					<title>'.$system['title'].'</title>
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

	// now cache some commands to quick exec
	$router_cache['strtok']=strtok($_SERVER['REQUEST_URI'], '?');
	$router_cache['substr']=substr($router_cache['strtok'], strrpos($router_cache['strtok'], '/') + 1);

	// hide this script - fake 404
	if($router_cache['strtok'] === $system['location_html'] . '/router.php')
	{
		http_response_code(404);
		echo '<!DOCTYPE html>
			<html>
				<head>
					<title>'.$system['title'].'</title>
					'; include($system['location_php'] . '/lib/htmlheaders.php'); echo '
					<meta http-equiv="refresh" content="0; url=.">
				</head>
			</html>
		';
		exit();
	}

	// 404 handle- for files
	if(!file_exists($_SERVER['DOCUMENT_ROOT'] . $router_cache['strtok']))
	{
		http_response_code(404);
		if(substr($router_cache['strtok'], -1) === '/')
			$url='..';
		else
			$url='.';

		echo '<!DOCTYPE html>
			<html>
				<head>
					<title>'.$system['title'].'</title>
					'; include($system['location_php'] . '/lib/htmlheaders.php'); echo '
					<meta http-equiv="refresh" content="0; url=' . $url . '">
				</head>
			</html>
		';
		exit();
	}

	// 404 handle - for dirs
	if(is_dir($_SERVER['DOCUMENT_ROOT'] . $router_cache['strtok']))
		if((file_exists($_SERVER['DOCUMENT_ROOT'] . $router_cache['strtok'] . '/index.php')) || (file_exists($_SERVER['DOCUMENT_ROOT'] . $router_cache['strtok'] . '/index.html')))
		{ /* everything is ok */ }
		else
		{
			http_response_code(404);
			if(substr($router_cache['strtok'], -1) === '/')
				$url='..';
			else
				$url='.';

			echo '<!DOCTYPE html>
				<html>
					<head>
						<title>'.$system['title'].'</title>
						'; include($system['location_php'] . '/lib/htmlheaders.php'); echo '
						<meta http-equiv="refresh" content="0; url=' . $url . '">
					</head>
				</html>
			';
			exit();
		}

	// denied file types
	if(preg_match('/\.(?:sh|rc|txt)$/', $router_cache['strtok'])) // if type ****.xxx in url
	{
		http_response_code(404);
		echo '<html>
			<head>
				<title>'.$system['title'].'</title>
				'; include($system['location_php'] . '/lib/htmlheaders.php'); echo '
				<meta http-equiv="refresh" content="0; url=.">
			</head>
		</html>';
		exit();
	}

	// url with index.php destroys application - prevent this
	if($router_cache['substr'] === 'index.php')
	{
		http_response_code(404);
		echo '<html>
			<head>
				<title>'.$system['title'].'</title>
				'; include($system['location_php'] . '/lib/htmlheaders.php'); echo '
				<meta http-equiv="refresh" content="0; url=.">
			</head>
		</html>';
		exit();
	}

	// fake 404 if path point to file 'disabled', 'description.php' and 'menu-addon.php'
	if(($router_cache['substr'] === 'disabled') || ($router_cache['substr'] === 'description.php') || ($router_cache['substr'] === 'menu-addon.php'))
	{
		http_response_code(404);
		echo '<html>
			<head>
				<title>'.$system['title'].'</title>
				'; include($system['location_php'] . '/lib/htmlheaders.php'); echo '
				<meta http-equiv="refresh" content="0; url=..">
			</head>
		</html>';
		exit();
	}

	// deny access to disabled modules
	if(file_exists($system['location_php'] . $router_cache['strtok'] . '/disabled'))
	{
		http_response_code(404);
		echo '<html>
			<head>
				<title>'.$system['title'].'</title>
				'; include($system['location_php'] . '/lib/htmlheaders.php'); echo '
				<meta http-equiv="refresh" content="0; url=..">
			</head>
		</html>';
		exit();
	}

	// deny access to lib/htmlheaders.php
	if($router_cache['substr'] === 'htmlheaders.php')
	{
		http_response_code(404);
		echo '<html>
			<head>
				<title>'.$system['title'].'</title>
				'; include($system['location_php'] . '/lib/htmlheaders.php'); echo '
				<meta http-equiv="refresh" content="0; url=..">
			</head>
		</html>';
		exit();
	}

	// deny access to lib/htmlheaders/*
	if(explode('/', substr($router_cache['strtok'], strlen($system['location_html'])))[2] === 'htmlheaders')
	{
		http_response_code(404);
		echo '<html>
			<head>
				<title>'.$system['title'].'</title>
				'; include($system['location_php'] . '/lib/htmlheaders.php'); echo '
				<meta http-equiv="refresh" content="0; url=..">
			</head>
		</html>';
		exit();
	}


	// drop router cache
	unset($router_cache);

	// abort script - load destination file
	return false;
?>