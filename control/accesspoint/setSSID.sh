#!/bin/bash

# To be run from root folder
# CONFIGURE IN configs/hostapd.conf

name=$(cat name.txt)
echo "ssid=$name" >> configs/hostapd.conf
