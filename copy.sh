#!/bin/bash

sudo rm -rf /var/www/html

sudo mkdir -p /var/www/html
sudo cp -ar http/* /var/www/html/
