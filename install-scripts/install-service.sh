#!/bin/bash

# TO BE EXECUTED FROM ROOT FOLDER!

controlDir=$PWD/control/accesspoint
webControlDir=$PWD/control/web

echo "#!/bin/bash
sudo systemctl restart apache2
sudo systemctl start mysql
$webControlDir/initPHPLoop.sh &
$webControlDir/startPHPLoop.sh &
$controlDir/accesspoint.sh &
$controlDir/startAP.sh &" > $PWD/control/start.sh
sudo chmod 774 $PWD/control/start.sh

echo "#!/bin/bash
$controlDir/stopAP.sh &
$controlDir/stopAP.sh &
$webControlDir/stopPHPLoop.sh &
sudo /usr/bin/killall -9 apache2
sudo /bin/systemctl stop apache2
" > $PWD/control/stop.sh
sudo chmod 774 $PWD/control/stop.sh

echo "[Unit]
Description=BBD Escape Hotspot and PHP loop
Wants=network-online.target
After=network-online.target

[Service]
Type=oneshot
RemainAfterExit=yes
ExecStart=$PWD/control/start.sh
ExecStop=$PWD/control/stop.sh

[Install]
WantedBy=multi-user.target" > escape.service

sudo cp escape.service /etc/systemd/system/
sudo systemctl daemon-reload
sudo systemctl enable escape.service
echo 'Escape.service has been enabled'
