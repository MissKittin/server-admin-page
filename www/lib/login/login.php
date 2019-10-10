<?php include($system_location_php . '/lib/prevent-direct.php'); prevent_direct('login.php'); ?>
<?php
	//functions
	function reload()
	{
		global $system_location_html; // this must be!

		global $system_title;
		echo '
			<!DOCTYPE html>
			<html>
				<head>
					<title>'.$system_title.'</title>
					<meta charset="utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<meta http-equiv="refresh" content="0">
					<link rel="stylesheet" type="text/css" href="' . $system_location_html . '/lib/theme.css">
				</head>
				<body>
					<h1>Loading...</h1>
				</body>
			</html>
		';
	}

	//header
	include($system_location_php . '/lib/login/login-config.php');
	session_name('SESSID');
	session_start();
	if(!isset($_SESSION['logged']))
		$_SESSION['logged']=false;

	//logout
	if(isset($_POST['logout']))
		if($_POST['logout'] == 'logout')
		{
			error_log('i Logout from ' . $_SERVER['REMOTE_ADDR'], 0);
			$_SESSION['logged']=false;
			session_destroy();
			reload();
			exit();
		}

	//logged
	if(isset($_SESSION['logged']) && $_SESSION['logged'])
	{
		$login_method='script_already_logged';
		// detect cookie attack
		if(($_SESSION['logged_ip'] != $_SERVER['REMOTE_ADDR']) || ($_SESSION['user_agent'] != $_SERVER['HTTP_USER_AGENT']))
		{
			error_log('! Cookie attack from ' . $_SERVER['REMOTE_ADDR'], 0);
			$_SESSION['logged']=false;
			session_destroy();
			session_regenerate_id(false); // reset session
			reload();
			exit();
		}
	}

	//login
	switch($login_method)
	{
		case 'multi':
			if(isset($_POST['user']) && isset($_POST['password']))
				for($i=0, $cnt=count($USER); $i<$cnt; $i++)
				{
					if($_POST['user'] === $USER[$i]) // find user
						if($_POST['password'] === $PASSWORD[$i]) // check passwd
						{
							error_log('i Successfully logged from ' . $_SERVER['REMOTE_ADDR'], 0);
							$_SESSION['logged_user']=$USER[$i];
							$_SESSION['logged']=true; // success!!!
							$_SESSION['logged_ip']=$_SERVER['REMOTE_ADDR']; // log for cookie attack detection
							$_SESSION['user_agent']=$_SERVER['HTTP_USER_AGENT']; // log for cookie attack detection
							reload();
							exit();
						}
				}
		break;
		case 'script_already_logged':
			if(!isset($session_regenerate)) // disable session regenerating (set it in script before include)
				session_regenerate_id(true); // cookie attack prevention
		break;
	}
	unset($login_method);
	unset($USER); unset($PASSWORD); // clear environment (protect database)

	if(!$_SESSION['logged']) // login form
	{
		include($system_location_php . '/lib/login/login-form.php');
		exit();
	}
?>