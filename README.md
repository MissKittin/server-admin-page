# server-admin-page
control your server/router from web page  
this is 3rd version of this application  
version 3.1 - see www/README.txt for more info  
modules: https://github.com/MissKittin/server-admin-page-modules  

with my modules it looks like this:  
![default](preview.png?raw=true)  

bright theme:  
![bright](preview_bright.png?raw=true)  

dark theme:  
![dark](preview_dark.png?raw=true)  

setup links - run setup.sh  
panic button - create `DISABLED.MAIN` file in the root dir

### Extras
fadeanimations -> fade in/out animations on body load/unload  
module-compatibility -> run older modules on server-admin-page v3.1  
mobileview -> adjust layout for mobile devices  
bright theme -> default theme with better colors  
dark theme

### How to setup
1) copy directory with modules to the `modules`
2) `chmod 755 ./setup-all.sh`
3) `./setup-all.sh`
4) customize modules if you want
5) `chmod 755 ./merge.sh`
6) `./merge.sh`
7) `tar cvf merged.tar ./merged`
8) send `merged.tar` to your server and deploy

### for developers
if fadeanimations are enabled, window.onload and window.onbeforeunload is reserved only for this.
