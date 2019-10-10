Config: first lines in router.php
Users and passwords: lib/login/login-config.php

Executing trip:
router.php	->index.php	->lib/home.php	->lib/prevent-direct.php	-> include lib/theme.css, lib/favicon/favicon.php, lib/header.php, lib/menu/menu.php, home-plugins/* (all enabled)	->exit()
						->lib/login/login.php	->if not logged: lib/login/login-form.php	->include login-plugins/* (all enabled)	->exit()
							->include lib/login/login-config.php

Modules:
Login protection (theme included from main): lib/login
Menu bar (with own theme): lib/menu
favicon: lib/favicon
Direct exec prevention: lib/prevent-direct.php
Directory enter prevention: lib/prevent-index.php (dependent on prevent-direct.php)
Theme: lib/theme.css, lib/header.php
Plugins on login page: login-plugins
Plugins on home page: home-plugins

sample-page is one-menu-entry page
sample-menu-addon has user-defined menu section
