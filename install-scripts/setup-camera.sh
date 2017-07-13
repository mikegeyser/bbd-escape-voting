#!/bin/bash

# https://raspberrypi.stackexchange.com/a/14419
grep "start_x=1" /boot/config.txt
if grep "start_x=1" /boot/config.txt
then
        exit
else
        sed -i "s/start_x=0/start_x=1/g" /boot/config.txt
fi
exit
