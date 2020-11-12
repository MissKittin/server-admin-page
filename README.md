# server-admin-page
control your server/router from web page  
this is 3rd version of this application  
version 3.1 - see www/README.txt for more info  
modules: https://github.com/MissKittin/server-admin-page-modules  
whole project: https://github.com/MissKittin/debian-router  

with my modules it looks like this:  
![default](preview.png?raw=true)  

bright theme:  
![bright](preview_bright.png?raw=true)  

dark theme:  
![dark](preview_dark.png?raw=true)  

setup links - run setup.sh  
panic button - create 'DISABLED.MAIN' file in the root dir

# webadmin
make new directory `www` in `debian-router/usr/local/share/router/webadmin`, put content from `server-admin-page/www` to `debian-router/usr/local/share/router/webadmin/www` and run `debian-router/usr/local/share/router/webadmin/www/setup.sh`  
clone modules, and merge content in `debian-router/usr/local/share/router/webadmin/www`, setup  
you can now setup debian-router  
**run `chown root:YOUR_UNPRIVILEGED_USER /usr/local/share/www/lib/login/login-config.php` and `chown root:YOUR_UNPRIVILEGED_USER /usr/local/share/www/lib/shell/superuser.sh` after deployment**
