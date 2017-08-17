#!/bin/bash

# TO BE EXECUTED FROM ROOT FOLDER!

webControlDir=$PWD/control/web

logFile=/var/log/escape/service.log
sudo mkdir -p /var/log/escape

# Start.sh
echo "#!/bin/bash
sudo systemctl restart apache2 >> ${logFile} 2>&1
sudo systemctl start mysql >> ${logFile} 2>&1
$webControlDir/initPHPLoop.sh &
$webControlDir/startPHPLoop.sh &
" > $PWD/control/start.sh
sudo chmod 774 $PWD/control/start.sh

# Stop.sh
echo "#!/bin/bash
$webControlDir/stopPHPLoop.sh &
sudo /usr/bin/killall -9 apache2 >> ${logFile} 2>&1
sudo /bin/systemctl stop apache2 >> ${logFile} 2>&1
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
