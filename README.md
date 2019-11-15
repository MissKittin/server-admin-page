# server-admin-page
control your server/router from web page<br>
this is 3rd version of this application<br>
version 3.1 - see www/README.txt for more info<br>
modules: https://github.com/MissKittin/server-admin-page-modules<br>
whole project: https://github.com/MissKittin/debian-router<br><br>

with my modules it looks like this:<br>
![default](https://raw.githubusercontent.com/MissKittin/server-admin-page/master/preview.png)<br><br>

bright theme:<br>
![bright](https://raw.githubusercontent.com/MissKittin/server-admin-page/master/preview_bright.png)<br><br>

dark theme:<br>
![dark](https://github.com/MissKittin/server-admin-page/blob/master/preview_dark.png)<br><br>

setup links - run setup.sh<br>
panic button - create 'DISABLED.MAIN' file in the root dir
<br><br>

# webadmin
make new directory `www` in `debian-router/usr/local/share/router/webadmin`, put content from `server-admin-page/www` to `debian-router/usr/local/share/router/webadmin/www` and run `debian-router/usr/local/share/router/webadmin/www/setup.sh`<br>
clone modules, and merge content in `debian-router/usr/local/share/router/webadmin/www`, setup<br>
you can now setup debian-router
