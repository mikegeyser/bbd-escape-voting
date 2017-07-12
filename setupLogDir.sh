#!/bin/bash

user=http
logDir=/var/log/escape

sudo mkdir -p $logDir
sudo chown -R $user $logDir
