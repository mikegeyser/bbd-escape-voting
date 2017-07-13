#!/bin/bash

sudo mkdir -p /var/www
sudo cp -fr ../web/* /var/www/html/

sudo cp -fr ../cgi-bin /var/www

sudo chmod 755 -R /var/www/cgi-bin

sudo a2enmod cgi
sudo service apache2 restart
