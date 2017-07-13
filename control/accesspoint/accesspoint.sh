#!/bin/bash
# TO BE RUN FROM ROOT FOLDER!

sudo mv /etc/dhcpcd.conf /etc/dhcpcd.conf.orig
sudo cp configs/dhcpcd.conf /etc/
sudo cp configs/dhcpcd.conf /etc/dhcpcd.conf.AP
sudo mv /etc/network/interfaces /etc/network/interfaces.orig
sudo cp configs/interfaces /etc/network/
sudo cp configs/interfaces /etc/network/interfaces.AP
sudo cp configs/hostapd.conf /etc/hostapd/
sudo cp configs/hostapd.conf /etc/hostapd/hostapd.conf.AP
sudo mv /etc/default/hostapd /etc/default/hostapd.orig
sudo cp configs/hostapd /etc/default/
sudo mv /etc/dnsmasq.conf /etc/dnsmasq.conf.orig
sudo cp configs/dnsmasq.conf /etc/
sudo cp configs/dnsmasq.conf /etc/dnsmasq.conf.AP
sudo mv /etc/sysctl.conf /etc/sysctl.conf.orig
sudo cp configs/sysctl.conf /etc/
sudo mv /etc/rc.local /etc/rc.local.orig
sudo cp configs/rc.local /etc/
sudo iptables -t nat -A POSTROUTING -o eth0 -j MASQUERADE
sudo iptables -A FORWARD -i eth0 -o wlan0 -m state --state RELATED,ESTABLISHED -j ACCEPT
sudo iptables -A FORWARD -i wlan0 -o eth0 -j ACCEPT
sudo sh -c "iptables-save > /etc/iptables/rules.v4"
