<?php
	// generate password hash

	if(isset($_SERVER['REQUEST_URI'])){ include($system['location_php'] . '/lib/prevent-index.php'); exit(); }

	function stdin($hide=false)
	{
		// usage: echo 'Type something: '; $output=stdin(); echo PHP_EOL;
		// or: echo 'Type something: '; $output=stdin(true); echo PHP_EOL;
		if($hide) shell_exec('stty -echo');
		$stdin=fopen('php://stdin', 'r');
		$output=fgets($stdin);
		fclose($stdin);
		if($hide) shell_exec('stty echo');
		return trim($output);
	}

	echo 'Enter password: '; $password=stdin(true); echo PHP_EOL . PHP_EOL;
	echo 'Password hash: ' . PHP_EOL . password_hash($password, PASSWORD_BCRYPT) . PHP_EOL;
?>