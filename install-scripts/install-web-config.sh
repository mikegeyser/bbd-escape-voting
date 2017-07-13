#!/bin/bash

source ../utils/bash-ini-parser
cfg_parser '../config.ini'
cfg_section_logging

sudo mkdir -p $logDir
sudo chown -R $user $logDir

sudo mkdir -p $configDir
sudo cp '../config.ini' $configDir
sudo chown $user $configDir/config.ini
