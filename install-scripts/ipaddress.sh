#!/bin/bash

echo "interface eth0" >> /etc/dhcpcd.conf
echo "static ip_address=1.1.1.1/22" >> /etc/dhcpcd.conf
