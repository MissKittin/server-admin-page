<?php
	// Scripts settings
	$system_location_html=''; // none if in root directory, for browser
	$system_location_php=$_SERVER['DOCUMENT_ROOT'] . ''; // for php scripts
	$system_title='Title';

	// router script
	// shell.sh absolute denied
	// readme texts also
	// menu.html in address bar denied


	/* Router script - filter */

	// hide this script - fake 404
	if(strtok($_SERVER['REQUEST_URI'], '?') === '/router.php')
	{
		echo '<!DOCTYPE html>
			<html>
				<head>
					<title>'.$system_title.'</title>
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
		if(substr(strtok($_SERVER['REQUEST_URI'], '?'), -1) === '/')
			$url='..';
		else
			$url='.';

		echo '<!DOCTYPE html>
			<html>
				<head>
					<title>'.$system_title.'</title>
					<meta http-equiv="refresh" content="0; url=' . $url . '">
				</head>
			</html>
		';
		exit();
	}

	// denied file types
	if(preg_match('/\.(?:sh|txt)$/', $_SERVER['REQUEST_URI'])) // if type ****.xxx in url
	{
		echo '<html>
			<head>
				<title>'.$system_title.'</title>
				<meta http-equiv="refresh" content="0; url=.">
			</head>
		</html>';
		exit();
	}

	// abort script - load destination file
	return false;
?>