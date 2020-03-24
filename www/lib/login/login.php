<?php if(!function_exists('prevent_direct')) include($system['location_php'] . '/lib/prevent-direct.php'); prevent_direct('login.php'); ?>
<?php
	//import sec_csrf library
	include($system['location_php'] . '/lib/sec_csrf.php');

	//functions
	$reload=function()
	{
		global $system;
		echo '
			<!DOCTYPE html>
			<html>
				<head>
					<title>'.$system['title'].'</title>
					'; include($system['location_php'] . '/lib/htmlheaders.php'); echo '
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<meta http-equiv="refresh" content="0">
				</head>
				<body>
					<h1>Loading...</h1>
				</body>
			</html>
		';
	};

	//header
	include($system['location_php'] . '/lib/login/login-config.php');
	session_name('SESSID');
	session_start();
	$csrf_generateToken(); unset($csrf_generateToken); // sec_csrf.php
	if(!isset($_SESSION['logged']))
		$_SESSION['logged']=false;

	//logout
	if(isset($_POST['logout']))
		if(($_POST['logout'] === 'logout') || ($_POST['logout'] === 'Logout'))
		{
			error_log('i Logout from ' . $_SERVER['REMOTE_ADDR'], 0);
			$_SESSION['logged']=false;
			session_destroy();
			$reload();
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
			$reload();
			exit();
		}
	}

	//login
	switch($login_method)
	{
		case 'multi':
			if(isset($_POST['user']) && isset($_POST['password']) && csrf_checkToken('post'))
				for($i=0, $cnt=count($USER); $i<$cnt; $i++)
					if($_POST['user'] === $USER[$i]) // find user
						if($_POST['password'] === $PASSWORD[$i]) // check passwd
						{
							error_log('i Successfully logged from ' . $_SERVER['REMOTE_ADDR'] . ' by multi method', 0);
							$_SESSION['logged_user']=$USER[$i];
							$_SESSION['logged']=true; // success!!!
							$_SESSION['logged_ip']=$_SERVER['REMOTE_ADDR']; // log for cookie attack detection
							$_SESSION['user_agent']=$_SERVER['HTTP_USER_AGENT']; // log for cookie attack detection
							$reload();
							exit();
						}
		break;
		case 'multi_bcrypt':
			if(isset($_POST['user']) && isset($_POST['password']) && csrf_checkToken('post'))
				for($i=0, $cnt=count($USER); $i<$cnt; $i++)
					if($_POST['user'] === $USER[$i]) // find user
						if(password_verify($_POST['password'], $PASSWORD[$i])) // check passwd, bcrypt mod here
						{
							error_log('i Successfully logged from ' . $_SERVER['REMOTE_ADDR'] . ' by multi_bcrypt method', 0);
							$_SESSION['logged_user']=$USER[$i];
							$_SESSION['logged']=true; // success!!!
							$_SESSION['logged_ip']=$_SERVER['REMOTE_ADDR']; // log for cookie attack detection
							$_SESSION['user_agent']=$_SERVER['HTTP_USER_AGENT']; // log for cookie attack detection
							$reload();
							exit();
						}
		break;
		case 'pam':
			// unix auth
			if(isset($_POST['user']) && isset($_POST['password']) && csrf_checkToken('post'))
			{
				$login_userName=$_POST['user'];
				$login_userPasswd=$_POST['password'];
				$login_passwdFile='/etc/shadow';
			
				for($i=0, $cnt=count($login_allowed_users); $i<$cnt; $i++)
					if($_POST['user'] === $login_allowed_users[$i]) // allowed
					{
						$login_users=file($login_passwdFile);
						if($login_user=preg_grep("/^$login_userName/",$login_users))
						{
							list(,$login_passwdInDB)=explode(':',array_pop($login_user));
							if(crypt($login_userPasswd,$login_passwdInDB) == $login_passwdInDB)
							{
								error_log('i Successfully logged from ' . $_SERVER['REMOTE_ADDR'] . ' by pam method', 0);
								$_SESSION['logged_user']=$login_allowed_users[$i];
								$_SESSION['logged']=true; // success!!!
								$_SESSION['logged_ip']=$_SERVER['REMOTE_ADDR']; // log for cookie attack detection
								$_SESSION['user_agent']=$_SERVER['HTTP_USER_AGENT']; // log for cookie attack detection
								$reload();
								exit();
							}
						}
					}
			}
		break;
		case 'script_already_logged':
			if(!isset($session_regenerate)) // disable session regenerating (set it in script before include)
				session_regenerate_id(true); // cookie attack prevention
		break;
	}
	unset($login_method);
	unset($USER); unset($PASSWORD); unset($login_allowed_users); // clear environment (protect database)

	if(!$_SESSION['logged']) // login form
	{
		include($system['location_php'] . '/lib/login-themes/' . $system['login_theme'] . '.php');
		exit();
	}

	// remove reload function
	unset($reload);
?>