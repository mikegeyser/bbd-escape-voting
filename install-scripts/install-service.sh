#!/bin/bash

# TO BE EXECUTED FROM ROOT FOLDER!

controlDir=$PWD/control/accesspoint
webControlDir=$PWD/control/web

echo "[Unit]
Description=BBD Escape Hotspot and PHP loop

[Service]
Type=oneshot
RemainAfterExit=yes
ExecStart=$webControlDir/initPHPLoop.sh
ExecStart=$webControlDir/startPHPLoop.sh
ExecStart=$controlDir/accesspoint.sh
ExecStart=$controlDir/startAP.sh
ExecStop=$controlDir/stopAP.sh
ExecStop=$controlDir/stopAP.sh
ExecStop=$webControlDir/stopPHPLoop.sh
ExecStop=killall -9 apache2
ExecStop=systemctl restart appache2

[Install]
WantedBy=multi-user.target" > escape.service

sudo cp escape.service /etc/systemd/system/
sudo systemctl enable escape.service
echo 'Escape.service has been enabled'
