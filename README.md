# Escape

Please take note of the [known issues](https://github.com/group-algol/escape-2#known-issues)

## Install

Warning: The installation proccess will overwrite many system config files.
Only run it on a pi dedicated for hosting the Escape service!

### 1) Install Raspbian on SD Card
1. Download [Raspbian Jessie Lite](https://www.raspberrypi.org/downloads/raspbian/) (311 MB)
2. `bsdtar -xf 2017-07-05-raspbian-jessie.zip`
3. `dd bs=4M if=2017-07-05-raspbian-jessie.img of=/dev/sdX conv=fsync`
4. Mount the SD card. Create empty file named `ssh` in boot partition `/dev/sdX` (vfat)

### 2) Login and Update OS
1. Login using SSH with the user `pi` and password `raspberry`
2. Provide internet access to the pi
3. It is recommended to update the system using `sudo apt-get update && sudo apt-get upgrade`
4. Install `git` and clone the repo

### 3) Install Escape-2
- Run `install.sh`. This will perform the following operations:
    - Install LAMP
    - Configure apache2 to serve on port 80
    - Configure mysql with username `root` and password `password`
    - Install the systemd service `escape` which will run on startup
    - Create directories required for log files in `/var/log/escape`
    - Install the `config.ini` file to `/usr/opt/escape`
    - Enable the camera interface on the pi
    - Bridge eth0 and wlan0 (Some module devices refuse to use WiFi if they cannot access internet)

## Usage
### General
- On boot a hotspot will be created with the SSID defined in `configs/hostapd.conf`
- Once connected to the hotspot the server can be accessed at `172.24.1.1`
- Use the `172.24.1.1/admin.html` page to manage presenters.
    - Can also tweet the winner and the lucky draw from the admin page

### Twitter
- Twitter credentials are to be stored in `config.ini`
- After updating this file, run `refresh.sh` to copy the config to where the server can read it

### Managing the service
The `escape` service will start on boot, it can also be manually controlled

- Start:
    - `sudo systemctl start escape`
- Stop:
    - `sudo systemctl start escape`

#### Scripts generated on install
- `control/start.sh` and `control/stop.sh` created on install and used by the systemd service
- `/control/<start|stop>.sh` are defined in `install-scripts/install-service.sh`

#### Updates
It may be required to update the software, in this case `install.sh` should be
run to install all files and packages,

`refresh.sh` will only copy the new web files and reinstall the systemd service

## Logs
- `/var/log/escape/php.log` - output from the Apache server
- `/var/log/escape/service.log` - Output from the systemd service and related processes

## Known issues
### Frontend
#### High
- Delete from admin page does not work

### Backend
#### High
- Vulnerable to SQL injection
- No auth protection for admin pages.
- Images are currently disabled (Caused problems on slow internet on day of demo)

#### Low
- Database credentials are scattered across php files: Not all php files use db.php
- Logging not enabled for all php files
- BackgroundWorker can be spawned  multiple times causing problems with Twitter
- No error handling for most pages
- Images are currently saved to a hard coded path (/home/pi/desktop/image.png)

### Setup
#### Low
- Having to run `refresh.sh` to update the config can easily be forgotten

### Service
#### Low
- Scripts and configs generated on installation makes debug challenging. However this was done to make set the directory and script paths on installation. A static path is required by systemd. The ideal would be to copy the config files to `/etc/escape/` and scripts to `/opt/escape/` and store logs in `/var/log/`
    - `constrol/start.sh|stop.sh`
    - `control/accesspoint/accesspoint.sh`
    - `escape.service`
- `/var/log/escape/service.log` is not real-time due to buffering
