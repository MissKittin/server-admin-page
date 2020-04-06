<?php if(!function_exists('prevent_direct')) include($system['location_php'] . '/lib/prevent-direct.php'); prevent_direct('sec_csrf.php'); ?>
<?php
	// CSRF prevention for adminpanel v1.2u1, mod for Server admin page v3.1u1
	// 17,19.02.2020
	// 28.02.2020 token regeneration and disable flag
	// included by login subsystem (lib/login/login.php)

	// csrf_generateToken() for login.php eg:
	//	$csrf_generateToken(); unset($csrf_generateToken);
	// csrf_checkToken('get'|'post') for php code eg:
	//	if(csrf_checkToken('post')) echo 'do_action';
	// csrf_printToken('parameter'|'value') for custom GET links eg:
	//	'<a href="action.php?' . csrf_printToken('parameter') . '=' . csrf_printToken('value') . '">Delete</a>'
	// csrf_injectToken() for html forms eg:
	//	echo csrf_injectToken();

	// disable library - for debugging only!
	$csrf_disableLibrary=false;
	if($csrf_disableLibrary)
	{
		// define empty functions
		$csrf_generateToken=function(){};
		function csrf_checkToken($method){ return true; }
		function csrf_printToken($parameter)
		{
			switch($parameter)
			{
				case 'parameter':
					return 'csrf_parameter';
				break;
				case 'value':
					return 'csrf_value';
				break;
			}
				
		}
		function csrf_injectToken(){ return "\n"; }
	}
	else
	{
		// define
		$csrf_generateToken=function()
		{
			// use one token per session
			//if(!isset($_SESSION['csrf_token']))
			//	$_SESSION['csrf_token']=substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 32);

			// (re)generate token if is not send/set
			if((!csrf_checkToken('get')) && (!csrf_checkToken('post')))
				$_SESSION['csrf_token']=substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 32);
		};
		function csrf_checkToken($method)
		{
			if(isset($_SESSION['csrf_token']))
				switch($method)
				{
					case 'get':
						if(isset($_GET['csrf_token']))
							if($_SESSION['csrf_token'] === $_GET['csrf_token'])
								return true;
					break;
					case 'post':
						if(isset($_POST['csrf_token']))
							if($_SESSION['csrf_token'] === $_POST['csrf_token'])
								return true;
					break;
				}
			return false;
		}
		function csrf_printToken($parameter)
		{
			switch($parameter)
			{
				case 'parameter':
					return 'csrf_token';
				break;
				case 'value':
					return $_SESSION['csrf_token'];
				break;
			}
			return false;
		}
		function csrf_injectToken()
		{
			return '<input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">' . "\n";
		}
	}
	unset($csrf_disableLibrary); // remove debug flag from memory
?>
