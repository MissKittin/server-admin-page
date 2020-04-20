<?php
	// cache generator
	$system['location_php']=realpath(str_replace('generate-cache.php', '', $_SERVER['SCRIPT_NAME']) . '../..');
	chdir($system['location_php']);
	if(isset($_SERVER['REQUEST_URI'])){ include($system['location_php'] . '/lib/prevent-index.php'); exit(); }

	// fake prevent_direct
	function prevent_direct($a){}

	// fake session logged
	$_SESSION['logged']=true;

	// sec_csrf library injection
	function csrf_printToken($parameter)
	{
		echo '<?php echo csrf_printToken(\'' . $parameter . '\'); ?>';
	}

	// restore $system['menu'], $system['location_html'] and $system['location_htmlheaders']
	foreach(explode(PHP_EOL, file_get_contents($system['location_php'] . '/router.php')) as $line)
	{
		$line=trim($line);
		$lineVarname=strstr($line, '=', true);
		if(($lineVarname == '$system[\'menu\']') || ($lineVarname == '$system[\'location_html\']') || ($lineVarname == '$system[\'location_htmlheaders\']'))
			eval($line);
	}

	// generate menu cache
	echo 'Generating menu cache...';
	ob_start();
	echo '<?php if(!function_exists(\'prevent_direct\')) include($system[\'location_php\'] . \'/lib/prevent-direct.php\'); prevent_direct(\'cache_menu.php\'); ?>';
	include($system['location_php'] . '/lib/menu/' . $system['menu'] . '/menu.php');
	file_put_contents($system['location_php'] . '/cache_menu.php', ob_get_contents());
	ob_end_clean(); @ob_end_flush();
	echo ' [ OK ]' . PHP_EOL;

	// generate htmlheaders cache
	echo 'Generating html headers cache...';
	file_put_contents($system['location_php'] . '/cache_htmlheaders.php', ''); // clear
	foreach(scandir($system['location_htmlheaders']) as $htmlheader)
		if(($htmlheader !== '.') || ($htmlheader !== '..'))
			if(!@file_put_contents($system['location_php'] . '/cache_htmlheaders.php', file_get_contents($system['location_htmlheaders'] . '_min/' . $htmlheader), FILE_APPEND)) // try import minified version
				file_put_contents($system['location_php'] . '/cache_htmlheaders.php', file_get_contents($system['location_htmlheaders'] . '/' . $htmlheader), FILE_APPEND); // failed, import full version
	echo ' [ OK ]' . PHP_EOL;
?>
