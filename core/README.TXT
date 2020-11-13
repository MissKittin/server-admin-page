server-admin-page v3.1
 - $system_something -> $system['something']
 - css ids and classes
 - themes support
 - custom login forms support
 - router.php command cache
 - menu is module

server-admin-page v3.1u1
 - console tools
 - new multi_bcrypt login method
 - cross-frame scripting prevention
 - csrf prevetion
 - prevent-direct optimization
 - menu & html headers cache
 - system & menu themes as php scripts

Config: first lines in router.php
Users and passwords: lib/login/login-config.php
	Methods:
	- multi -> multiple users (defined in arrays), passwords stored in plain text
	- multi_bcrypt -> the same as multi, but passwords is hashed (use `php ./lib/console/passwdhash.php` to generate hash)
	- pam -> use password from /etc/shadow

Executing trip:
router.php	->index.php	->lib/home.php	->lib/prevent-direct.php	-> include lib/htmlheaders.php, lib/menu/menu.php, home-plugins/* (all enabled)	->exit()
						->lib/login/login.php	->if not logged: lib/login-themes/$system['login_theme'].php	->include lib/htmlheaders.php, login-plugins/* (all enabled)	->exit()
							->include lib/login/login-config.php

Modules:
	Login protection: lib/login
	Menu bar (with own or shared theme): lib/menu/menu.php -> lib/menu/$system['menu']/menu.php
	favicon: lib/favicon
	Direct exec prevention: lib/prevent-direct.php
	Directory enter prevention: lib/prevent-index.php (dependent on prevent-direct.php)
	Theme: lib/htmlheaders.php -> lib/htmlheaders/theme.php -> lib/themes/$system['theme'].css
	Login form: lib/login.php -> lib/login-themes/$system['login_theme'].php
	Plugins on login page: login-plugins
	Plugins on home page: home-plugins
	HTML headers: lib/htmlheaders.php, lib/htmlheaders
	CSRF security library: lib/sec_csrf.php (required)

Samples:
	sample-page is one-menu-entry page
	sample-menu-addon has user-defined menu section
