#!/bin/bash
# TO BE RUN FROM ROOT FOLDER!

sudo cp configs/010_pi-nopasswd /etc/sudoers.d/
sudo cp configs/serve-cgi-bin.conf /etc/apache2/conf-enabled
sudo cp configs/apache2.conf /etc/apache2

sudo iptables -t nat -A POSTROUTING -o wlan0 -j MASQUERADE
sudo iptables -t nat -A PREROUTING -p tcp -m tcp --dport 80 -j DNAT --to-destination 172.24.1.1
