#!/bin/bash
sudo service dnsmasq start
sudo cp /etc/dhcpcd.conf.AP /etc/dhcpcd.conf
sudo cp /etc/network/interfaces.AP /etc/network/interfaces
sudo service dhcpcd restart
sudo service hostapd start
sudo ifdown wlan0
sudo ifup wlan0
sudo /usr/sbin/hostapd /etc/hostapd/hostapd.conf

