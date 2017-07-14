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

## Updating
It may be required to update the software, in thsi case `install.sh` should update
files in the required places.

## Config
#### SSID
- `configs/hostapd.conf`

#### Twitter Tokens
- 'config.ini'
