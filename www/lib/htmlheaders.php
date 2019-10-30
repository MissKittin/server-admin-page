<?php include($system['location_php'] . '/lib/prevent-direct.php'); prevent_direct('htmlheaders.php'); ?>
<?php
	// include defined html headers

	$htmlheaders_location='/lib/htmlheaders'; // path
	$htmlheaders=scandir($system['location_php'] . $htmlheaders_location);
	foreach($htmlheaders as $htmlheader)
		if(($htmlheader != '.') && ($htmlheader != '..') && ($htmlheader != 'index.php')) // exclude unwanted files
			include $system['location_php'] . '/lib/htmlheaders/' . $htmlheader;
	unset($htmlheaders_location); unset($htmlheaders); unset($htmlheader); // clear environment
?>