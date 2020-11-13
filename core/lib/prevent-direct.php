<?php
	// deny direct access library - fake 404
	// usage: if(!function_exists('prevent_direct')) include($system['location_php'] . '/lib/prevent-direct.php'); prevent_direct('put-filename-here.php');

	// function_exists() not needed here
	function prevent_index()
	{
		global $system;
		http_response_code(404);
		echo '
			<!DOCTYPE html>
			<html>
				<head>
					<title>'.$system['title'].'</title>
					'; include($system['location_php'] . '/lib/htmlheaders.php'); echo '
					<meta http-equiv="refresh" content="0; url=' . $system['location_html'] . '/">
				</head>
			</html>
		';
	}
	function prevent_direct($name)
	{
		if(substr(strtok($_SERVER['REQUEST_URI'], '?'), strrpos(strtok($_SERVER['REQUEST_URI'], '?'), '/')) === "/$name")
		{ prevent_index(); exit(); }
	}

	prevent_direct('prevent-direct.php');
?>