<?php if(!function_exists('prevent_direct')) include($system['location_php'] . '/lib/prevent-direct.php'); prevent_direct('login.php'); ?>
<?php
	//import sec_csrf library
	include($system['location_php'] . '/lib/sec_csrf.php');

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
			include($system['location_php'] . '/lib/login/login-themes/' . $system['login_theme'] . '/reload.php');
			exit();
		}

	//logged
	if(isset($_SESSION['logged']) && $_SESSION['logged'])
	{
		$login_method='already_logged';
		// detect cookie attack
		if(($_SESSION['logged_ip'] != $_SERVER['REMOTE_ADDR']) || ($_SESSION['user_agent'] != $_SERVER['HTTP_USER_AGENT']))
		{
			error_log('! Cookie attack from ' . $_SERVER['REMOTE_ADDR'], 0);
			$_SESSION['logged']=false;
			session_destroy();
			session_regenerate_id(false); // reset session
			include($system['location_php'] . '/lib/login/login-themes/' . $system['login_theme'] . '/reload.php');
			exit();
		}
	}

	//login
	$login_failed=false;
	switch($login_method)
	{
		case 'multi':
			if(isset($_POST['user']) && isset($_POST['password']) && csrf_checkToken('post'))
			{
				$login_failed=true;
				for($i=0, $cnt=count($USER); $i<$cnt; $i++)
					if($_POST['user'] === $USER[$i]) // find user
						if($_POST['password'] === $PASSWORD[$i]) // check passwd
						{
							error_log('i Successfully logged from ' . $_SERVER['REMOTE_ADDR'] . ' by multi method', 0);
							$login_failed=false;
							$_SESSION['logged_user']=$USER[$i];
							$_SESSION['logged']=true; // success!!!
							$_SESSION['logged_ip']=$_SERVER['REMOTE_ADDR']; // log for cookie attack detection
							$_SESSION['user_agent']=$_SERVER['HTTP_USER_AGENT']; // log for cookie attack detection
							include($system['location_php'] . '/lib/login/login-themes/' . $system['login_theme'] . '/reload.php');
							exit();
						}
			}
		break;
		case 'multi_bcrypt':
			if(isset($_POST['user']) && isset($_POST['password']) && csrf_checkToken('post'))
			{
				$login_failed=true;
				for($i=0, $cnt=count($USER); $i<$cnt; $i++)
					if($_POST['user'] === $USER[$i]) // find user
						if(password_verify($_POST['password'], $PASSWORD[$i])) // check passwd, bcrypt mod here
						{
							error_log('i Successfully logged from ' . $_SERVER['REMOTE_ADDR'] . ' by multi_bcrypt method', 0);
							$login_failed=false;
							$_SESSION['logged_user']=$USER[$i];
							$_SESSION['logged']=true; // success!!!
							$_SESSION['logged_ip']=$_SERVER['REMOTE_ADDR']; // log for cookie attack detection
							$_SESSION['user_agent']=$_SERVER['HTTP_USER_AGENT']; // log for cookie attack detection
							include($system['location_php'] . '/lib/login/login-themes/' . $system['login_theme'] . '/reload.php');
							exit();
						}
			}
		break;
		case 'already_logged':
			if(!isset($session_regenerate)) // disable session regenerating (set it in script before include)
				session_regenerate_id(true); // cookie attack prevention
		break;
	}
	if($login_failed) error_log('! Login attempt failed from ' . $_SERVER['REMOTE_ADDR'] . ' by ' . $login_method . ' method', 0); unset($login_failed);
	unset($login_method);
	unset($USER); unset($PASSWORD); unset($login_allowed_users); // clear environment (protect database)

	if(!$_SESSION['logged']) // login form
	{
		include($system['location_php'] . '/lib/login/login-themes/' . $system['login_theme'] . '/form.php');
		exit();
	}
?>