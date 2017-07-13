#!/bin/bash

# To be run from root folder

name=$(cat name.txt)
echo "ssid=$name" >> configs/hostapd.conf
