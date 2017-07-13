#!/bin/bash
name=$(cat /home/pi/Desktop/Escape/name.txt)
echo "ssid=$name" >> /home/pi/Desktop/Escape/hostapd.conf
