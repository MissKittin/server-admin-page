<?php header('Content-Type: text/css; X-Content-Type-Options: nosniff;'); ?>
<?php header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT'); header('Pragma: cache'); header('Cache-Control: max-age=3600'); ?>
/* default theme */
/* 11-13.08.2019 */

/* variables */
:root {
	--content_border-color: #000000; /* border color */
	--content_background-color: #cccccc; /* default background color */
}

/* menu */
#system_body #system_menu a, #system_body #system_menu a:hover, #system_body #system_menu a:visited {
	text-decoration: none;
	color: #0000ff;
}

/* page */
html, body {
	/* height: 100%; */
}
body {
	background-color: var(--content_background-color);
	background-color: #cccccc;  /* for older browsers */
}
#system_body {}
#system_body #system_content {
	margin-left: 201px; /* comment this if you use default menu module */
}

/* links without decorations */
#system_body #system_content .content_noDecorations, #system_login_content .content_noDecorations {
	text-decoration: none;
	color: #0000ff !important;
}

/* warning messages */
#system_body #system_content .content_warning, #system_login_content .content_warning {
	color: #ff0000;
}

/* buttons */
#login_body .system_button, #system_body .system_button {}

/* text fields */
#system_body input[type=text], #login_body input[type=text] {}

/* password fields */
#system_body input[type=password], #login_body input[type=password] {}

/* dropdown lists */
#system_body select, #login_body select {}

/* checkboxes */
#system_body input[type=checkbox], #login_body input[type=checkbox] {}