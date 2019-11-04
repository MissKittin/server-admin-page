server-admin-page v3.1
 - $system_something -> $system['something']
 - css ids and classes
 - themes support
 - router.php command cache
 - menu is module

Config: first lines in router.php
Users and passwords: lib/login/login-config.php

Executing trip:
router.php	->index.php	->lib/home.php	->lib/prevent-direct.php	-> include lib/htmlheaders.php, lib/menu/menu.php, home-plugins/* (all enabled)	->exit()
						->lib/login/login.php	->if not logged: lib/login/login-form.php	->include lib/htmlheaders.php, login-plugins/* (all enabled)	->exit()
							->include lib/login/login-config.php

Modules:
Login protection: lib/login
Menu bar (with own or shared theme): lib/menu/menu.php -> lib/menu/$system['menu']/menu.php
favicon: lib/favicon
Direct exec prevention: lib/prevent-direct.php
Directory enter prevention: lib/prevent-index.php (dependent on prevent-direct.php)
Theme: lib/htmlheaders.php -> lib/htmlheaders/theme.php -> lib/themes/$system['theme'].css
Plugins on login page: login-plugins
Plugins on home page: home-plugins
HTML headers: lib/htmlheaders.php, lib/htmlheaders

sample-page is one-menu-entry page
sample-menu-addon has user-defined menu section
