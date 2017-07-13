#!/bin/bash

user=http
logDir=/var/log/escape
configDir=/var/opt/escape #Need to change in config.php h as well

sudo mkdir -p $logDir
sudo chown -R $user $logDir

sudo mkdir -p $configDir
sudo cp config.ini $configDir
sudo chown $user $configDir/config.ini
