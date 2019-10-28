<?php
	if(!function_exists('goto_home'))
	{
		function goto_home()
		{
			global $system_title;
			global $system_location_php;
			global $system_location_html;

			http_response_code(404);
			echo '
				<!DOCTYPE html>
				<html>
					<head>
						<title>'.$system_title.'</title>
						'; include($system_location_php . '/lib/htmlheaders.php'); echo '
						<meta http-equiv="refresh" content="0; url=' . $system_location_html . '/">
					</head>
				</html>
			';
		}

		function prevent_direct($name)
		{
			if(substr(strtok($_SERVER['REQUEST_URI'], '?'), strrpos(strtok($_SERVER['REQUEST_URI'], '?'), '/')) === "/$name")
			{
				goto_home();
				exit();
			}
		}
	}

	prevent_direct('prevent-direct.php');
?>
