<?php if(!function_exists('prevent_direct')) include($system['location_php'] . '/lib/prevent-direct.php'); prevent_direct('check-cookies.php'); ?>
<div>
	<span id="cookiesy" style="display: none;" class="content_warning">&#9760; This application will not work until you enable cookies</span>
	<script>
		function getCookie(name)
		{
			var value="; "+document.cookie;
			var parts=value.split("; " + name + "=");
			if(parts.length == 2)
			return parts.pop().split(";").shift();
		}

		if(getCookie("SESSID") == null)
		{
			document.getElementsByName("user")[0].disabled=true;
			document.getElementsByName("password")[0].disabled=true;
			document.getElementsByTagName("INPUT")[2].style.display="none";
			document.getElementById("cookiesy").style.display="";
		}
	</script>
</div>
