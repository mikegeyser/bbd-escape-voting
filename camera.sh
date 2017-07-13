#!/bin/bash
echo "Content-type: text/plain; charset=iso-8859-1"
echo
sudo raspistill -o /home/pi/Desktop/image.jpg
echo "Photo taken"
