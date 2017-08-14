#!/bin/bash
# TO BE RUN FROM ROOT FOLDER!

sudo cp configs/010_pi-nopasswd /etc/sudoers.d/
sudo cp configs/serve-cgi-bin.conf /etc/apache2/conf-enabled
sudo cp configs/apache2.conf /etc/apache2

sudo iptables -P INPUT ACCEPT
sudo iptables -P FORWARD ACCEPT
sudo iptables -P OUTPUT ACCEPT

sudo iptables -t nat -F
sudo iptables -t mangle -F
sudo iptables -F
sudo iptables -X

sudo iptables -t nat -A POSTROUTING -o wlan0 -j MASQUERADE
