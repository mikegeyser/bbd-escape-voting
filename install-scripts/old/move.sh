#!/bin/bash
sudo mkdir /var/www/html/scripts
sudo cp /home/pi/Desktop/Escape/{autotweet.php,commentsList.php,currentPresenter.php,deletePresenter.php,insertPresenter.php,name.txt,newComment.php,presenterList.php,tweetImage.php,tweetWinner.php,updatePresenter.php,winners.php} /var/www/html/scripts/
sudo cp -R /home/pi/Desktop/Escape/codebird-php-develop /var/www/html/scripts
sudo mkdir /var/www/cgi-bin
sudo cp /home/pi/Desktop/Escape/{camera.sh,createDB.sh} /var/www/cgi-bin
sudo cp /home/pi/Desktop/Escape/010_pi-nopasswd /etc/sudoers.d/
sudo cp /home/pi/Desktop/Escape/serve-cgi-bin.conf /etc/apache2/conf-enabled
sudo cp /home/pi/Desktop/Escape/apache2.conf /etc/apache2/
sudo chmod 755 -R /var/www/cgi-bin
sudo a2enmod cgi
sudo service apache2 restart
