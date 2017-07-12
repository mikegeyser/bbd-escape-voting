#!/bin/bash
sudo service dnsmasq stop
sudo cp /etc/dhcpcd.conf.orig /etc/dhcpcd.conf
sudo cp /etc/network/interfaces.orig /etc/network/interfaces
sudo service hostapd stop
sudo service dhcpcd restart
sudo ifdown wlan0
sudo ifup wlan0
