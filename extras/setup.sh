#!/bin/sh
cd "$(dirname "$(readlink -f "${0}")")"

ln -s ../prevent-index.php ./lib/favicon/index.php
ln -s ../../../prevent-index.php ./lib/login/login-themes/material/index.php
ln -s index.min.php ./lib/login/login-themes/material/css/index.php
ln -s index.min.php ./lib/themes/bright/index.php
ln -s index.min.php ./lib/themes/dark/index.php

rm ./setup.sh
exit 0
