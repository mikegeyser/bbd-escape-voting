# Escape

## Install
1. Install NOOBS (Raspbian)
2. Provide internet access via Ethernet
3. Clone this repo to the pi
4. Run `install.sh`. This will do the following:
    - Install LAMP
    - Configure apache2 to serve on port 777
    - Configure mysql with username `root` and password `password`
    - Install the systemd service `escape` which will run on startup
    - Create directories required for log files in `/var/log/escape`
    - Install the `config.ini` file to `/usr/opt/escape`
    - Enable the camera interface on the pi
    - Reboot

## Managing the service
- The `escape` service will start on boot, it can also be manually controlled

### Start
- `sudo systemctl start escape`

### Stop
- `sudo systemctl start escape`

## Updating
It may be required to update the software, in this case `install.sh` should update
all required files.

`refresh.sh` will only copy the new web files and reinstall the systemd service

## Config
- Execute `refresh.sh` after changing the `config.ini`

#### SSID
- `configs/hostapd.conf`

#### Twitter Tokens
- 'config.ini'

#### MySql
- `install-scripts/install-lamp.sh`

## Logs
### Escape
- '/var/log/escape/php.log'
