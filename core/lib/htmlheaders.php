<?php
	// include defined html headers or read cached content

	if(!@include($system['location_php'] . '/cache_htmlheaders.php'))
	{
		$minified_htmlheaders=$system['location_htmlheaders'] . '_min';
		$htmlheaders=scandir($system['location_htmlheaders']);
		foreach($htmlheaders as $htmlheader)
			if(($htmlheader != '.') && ($htmlheader != '..') && ($htmlheader != 'index.php')) // exclude unwanted files
				if(!@include($minified_htmlheaders . '/' . $htmlheader)) // try import minified version
					include($system['location_htmlheaders'] . '/' . $htmlheader); // failed, import full version
		unset($system['location_htmlheaders']); unset($minified_htmlheaders); unset($htmlheaders); unset($htmlheader); // clear environment
	}
?>