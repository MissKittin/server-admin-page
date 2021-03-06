#!/bin/sh
echo 'home'
ln -s ./lib/home.php ./index.php

echo 'home-plugins'
cd home-plugins
[ -e index.php ] && rm index.php
ln -s ../lib/prevent-index.php index.php

echo '99_sample-widget'
cd 99_sample-widget
[ -e index.php ] && rm index.php
ln -s ../../lib/prevent-index.php index.php
echo -n '' > disabled

echo 'lib'
cd ../../lib
[ -e index.php ] && rm index.php
ln -s prevent-index.php index.php

echo 'console'
cd ./console
[ -e index.php ] && rm index.php
ln -s ../prevent-index.php index.php

echo 'login'
cd ../login
[ -e index.php ] && rm index.php
ln -s ../prevent-index.php index.php

echo 'login-themes'
cd ./login-themes
[ -e index.php ] && rm index.php
ln -s ../../prevent-index.php index.php

echo 'login-themes/default'
cd ./default
[ -e index.php ] && rm index.php
ln -s ../../../prevent-index.php index.php

echo 'menu'
cd ../../../menu
[ -e index.php ] && rm index.php
ln -s ../prevent-index.php index.php

echo 'menu/default'
cd default
[ -e index.php ] && rm index.php
ln -s ../../prevent-index.php index.php

echo 'menu/default/theme'
cd theme
[ -e index.php ] && rm index.php
ln -s index.min.php index.php
cd ../..

#echo 'htmlheaders'
#cd ../htmlheaders
#[ -e index.php ] && rm index.php
#ln -s ../prevent-index.php index.php

echo 'themes'
cd ../themes
[ -e index.php ] && rm index.php
ln -s ../prevent-index.php index.php

echo 'themes/default'
cd ./default
[ -e index.php ] && rm index.php
ln -s index.min.php index.php

echo 'login-plugins'
cd ../../../login-plugins
[ -e index.php ] && rm index.php
ln -s ../lib/prevent-index.php index.php

echo '10_check-cookies'
cd 10_check-cookies
[ -e index.php ] && rm index.php
ln -s ../../lib/prevent-index.php index.php

echo '99_sample-widget'
cd ../99_sample-widget
[ -e index.php ] && rm index.php
ln -s ../../lib/prevent-index.php index.php
echo -n '' > disabled

echo 'login-database'
cd ../../lib/login
chmod 640 login-config.php

echo 'sample-menu-addon'
cd ../../sample-menu-addon
echo -n '' > disabled

echo 'sample-page'
cd ../sample-page
echo -n '' > disabled

echo 'setup.sh'
cd ..
rm setup.sh

echo; echo 'OK'
exit 0
