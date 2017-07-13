#!/bin/bash

sudo cp configs/010_pi-nopasswd /etc/sudoers.d/
sudo cp configs/serve-cgi-bin.conf etc/apache2/conf-enabled
sudo cp configs/apache2.conf /etc/apache2
