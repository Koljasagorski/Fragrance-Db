# FragranceDb

This is a simple but usefull tracer to keep an eye out for all releases being uploaded on your favorite private trackers. easy to use and easy to maintain.
This is tested and works on Ubuntu 14.04 and 16.04.

## Demo
https://dev.swetracker.org/


# Installation

 1. Upload all files to your servers root-folder.
 2. Edit /xtra/broken_dreams.php with your credentials and hashes.
 3. Edit /xtra/processor.php (for Rartrackers), /xtra/processor_nb.php (for u232-trackers), /xtra/processor_gnu.php (Gazelle-trackers).
 4. install  `apache2 mariadb-server php5 memcached php5-memcached php5-mysql`
 5. Add the database.sql to MySQL.
 6. Run a2enmod rewrite
 7. Go back to folder /var/www and create a file called startup.sh
 8. Edit startup.php with																																	
`#!/bin/bash
while [ true ]; do
wget -O /dev/null http://127.0.0.1:8880/xtra/processor.php?q=tracker1
wget -O /dev/null http://127.0.0.1:8880/xtra/processor.php?q=tracker2
wget -O /dev/null http://127.0.0.1:8880/xtra/processor.php?q=tracker3
wget -O /dev/null http://127.0.0.1:8880/xtra/processor.php?q=tracker4
wget -O /dev/null http://127.0.0.1:8880/xtra/processor_nb.php?q=tracker1
wget -O /dev/null http://127.0.0.1:8880/xtra/processor_nb.php?q=tracker2
wget -O /dev/null http://127.0.0.1:8880/xtra/processor_nb.php?q=tracker3
wget -O /dev/null http://127.0.0.1:8880/xtra/processor_nb.php?q=tracker4
wget -O /dev/null http://127.0.0.1:8880/xtra/processor_gnu.php?q=tracker1
wget -O /dev/null http://127.0.0.1:8880/xtra/processor_gnu.php?q=tracker2
wget -O /dev/null http://127.0.0.1:8880/xtra/processor_gnu.php?q=tracker3
wget -O /dev/null http://127.0.0.1:8880/xtra/processor_gnu.php?q=tracker4
sleep 10
wget -O /dev/null http://127.0.0.1:8880/xtra/processor.php?q=tracker1
wget -O /dev/null http://127.0.0.1:8880/xtra/processor.php?q=tracker2
wget -O /dev/null http://127.0.0.1:8880/xtra/processor.php?q=tracker3
wget -O /dev/null http://127.0.0.1:8880/xtra/processor.php?q=tracker4
wget -O /dev/null http://127.0.0.1:8880/xtra/processor_nb.php?q=tracker1
wget -O /dev/null http://127.0.0.1:8880/xtra/processor_nb.php?q=tracker2
wget -O /dev/null http://127.0.0.1:8880/xtra/processor_nb.php?q=tracker3
wget -O /dev/null http://127.0.0.1:8880/xtra/processor_nb.php?q=tracker4
wget -O /dev/null http://127.0.0.1:8880/xtra/processor_gnu.php?q=tracker1
wget -O /dev/null http://127.0.0.1:8880/xtra/processor_gnu.php?q=tracker2
wget -O /dev/null http://127.0.0.1:8880/xtra/processor_gnu.php?q=tracker3
wget -O /dev/null http://127.0.0.1:8880/xtra/processor_gnu.php?q=tracker4
sleep 10
done`
### Alter this to what trackers you use and sources the trackers are using!
9. make the startup.sh executable
10. still in /var/www create a file called  startup_non.sh  and proceed like before. **This is if you're going to run non-nordic trackers or if you like to just use one single TbDev-based tracker**
11. Visit yourdomain.tld/xtra/processor.php(or whatever processor you're running) to check for errors or if something missbehaves.
12. Run the startup.sh from /var/www/ with`nohup ./startup.sh >/dev/null 2>&1 &`


## NOTE:
This is a basic version of https://swetracker.org/ 
It've been modified to be usefull for others and more simple to use.
IT IS IN EARLY ALPHA-STATE!
Feel free to use as you'd like.

License: WTFPL
