#!/bin/bash
sudo apt-get -y update && sudo apt-get -y upgrade --force-yes
sudo apt-get -y install apache2 apache2-utils --force-yes
sudo apt-get -y install libapache2-mod-php5 php5 php-pear php5-xcache php5-mysql php5-curl php5-gd --force-yes
sudo echo "<?php phpinfo(); ?>" | sudo tee /var/www/html/index.php
sudo apt-get -y install mysql-server --force-yes
sudo apt-get -y install mysql-client --force-yes
sudo apt-get -y install dnsmasq --force-yes
sudo apt-get -y install hostapd --force-yes
sudo apt-get -y install iptables-persistent --force-yes
