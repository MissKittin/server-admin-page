<?php
	if(!function_exists('goto_home'))
	{
		function goto_home()
		{
			global $system_title;
			echo '
				<!DOCTYPE html>
				<html>
					<head>
						<title>'.$system_title.'</title>
						<meta http-equiv="refresh" content="0; url=' . $system_location_html . '/">
					</head>
				</html>
			';
		}

		function prevent_direct($name)
		{
			if(substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/')) === "/$name")
			{
				goto_home();
				exit();
			}
		}
	}

	prevent_direct('prevent-direct.php');
?>