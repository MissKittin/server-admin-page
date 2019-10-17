<?php include($system_location_php . '/lib/prevent-direct.php'); prevent_direct('menu.php'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo $system_location_html; ?>/lib/menu/menu.css">

<div id="menu">
	<?php /* fancy characters:
		&#9484; - flipped 'L'
		&#9500; - '|-'
		&#9472; - long '-'
		&#9492; - 'L'
		&#127968; - Home
	*/ ?>
	<a href="<?php echo $system_location_html; ?>/" style="font-size: 20pt;">&#127968;</a><br><!-- home -->

	<?php
		// Menu render part
		/* Code map:
			get plugins list
			create categories list:
				filter directories, filter plugin directories, filter disabled plugins
				include descriptions
				calculate how many categories is
			find last plugin name:
				filter directories, filter plugin directories, filter disabled plugins
				include descriptions
				if category is not defined yet, add to list and iterate categories indicator
			render menu:
				if category isn't none, and is first category print &#9484; else &#9500;
				filter directories
				filter plugin directories, filter disabled plugins, decide if it's plugin or addon
				include descriptions
				for plugins:
					if category is ok, check if plugin is last, print link
				for addons:
					if category is ok, include menu part
		*/

		$plugins=scandir($system_location_php);

		// Get categories list
		$categories=array(); # declare to avoid annoying warnings
		$categories_ind=0;
		foreach($plugins as $plugin)
			if(($plugin != '.') && ($plugin != '..') && (is_dir('./' . $plugin)))
				if((file_exists($system_location_php . '/' . $plugin . '/description.php')) && !file_exists($system_location_php . '/' . $plugin . '/disabled'))
				{
					include './' . $plugin . '/description.php';
					if(!in_array($category, $categories))
					{
						$categories[$categories_ind]=$category;
						$categories_ind++;
					}
				}			

		// Get last plugin (simulate render)
		for($i=0; $i<$categories_ind; $i++)
			foreach($plugins as $plugin)
				if(($plugin != '.') && ($plugin != '..') && (is_dir('./' . $plugin))) // directory filter
				{
					if((file_exists($system_location_php . '/' . $plugin . '/description.php')) && (!file_exists($system_location_php . '/' . $plugin . '/menu-addon.php')) && (!file_exists($system_location_php . '/' . $plugin . '/disabled'))) // check if dir is plugin
					{
						include './' . $plugin . '/description.php';
						if($category === $categories[$i]) // check if category is correct
							$plugin_last=$plugin; // save new result
					}
					if(file_exists($system_location_php . '/' . $plugin . '/description.php') && (file_exists($system_location_php . '/' . $plugin . '/menu-addon.php')) && (!file_exists($system_location_php . '/' . $plugin . '/disabled'))) // if it's menu addon
					{
						include './' . $plugin . '/description.php';
						if($category === $categories[$i])
							$plugin_last=$plugin;
					}
				}

		// Render menu
		for($i=0; $i<$categories_ind; $i++)
		{
			// Create category
			if($categories[$i] != 'none') // none category is omitted
				if($i == 0) // if first category
					echo '&#9484;' . $categories[$i] . '<br>' . "\n";
				else // is in the middle
					echo '&#9500;' . $categories[$i] . '<br>' . "\n";

			foreach($plugins as $plugin)
				if(($plugin != '.') && ($plugin != '..') && (is_dir('./' . $plugin))) // directory filter
				{
					if((file_exists($system_location_php . '/' . $plugin . '/description.php')) && (!file_exists($system_location_php . '/' . $plugin . '/menu-addon.php')) && (!file_exists($system_location_php . '/' . $plugin . '/disabled'))) // check if dir is plugin
					{
						include './' . $plugin . '/description.php';
						if($category === $categories[$i]) // check if category is correct
							if($plugin === $plugin_last)
								echo '&#9492;&#9472;<a href="' . $system_location_html . '/' . $plugin . '">' . $name . '</a><br>' . "\n";
							else
								echo '&#9500;&#9472;<a href="' . $system_location_html . '/' . $plugin . '">' . $name . '</a><br>' . "\n";
					}
					if(file_exists($system_location_php . '/' . $plugin . '/description.php') && (file_exists($system_location_php . '/' . $plugin . '/menu-addon.php')) && (!file_exists($system_location_php . '/' . $plugin . '/disabled'))) // if it's menu addon
					{
						include './' . $plugin . '/description.php';
						if($category === $categories[$i])
							include './' . $plugin . '/menu-addon.php';
					}
				}
		}

		// Clear environment
		unset($categories); unset($categories_ind); unset($category); unset($i); unset($plugins); unset($plugin); unset($plugin_last); unset($name);
	?>

	<form action='.' method="post"><button type="submit" name="logout" value="logout">Logout</button></form>
</div>
