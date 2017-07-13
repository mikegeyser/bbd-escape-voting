#!/bin/bash

# Install Web files
sudo mkdir -p /var/www
sudo cp -fr web/* /var/www/html/

sudo cp -fr cgi-bin /var/www

sudo cp configs/010_pi-nopasswd /etc/sudoers.d/
sudo cp configs/serve-cgi-bin.conf etc/apache2/conf-enabled
sudo cp configs/apache2.conf /etc/apache2

sudo chmod 755 -R /var/www/cgi-bin

sudo a2enmod cgi
sudo service apache2 restart
