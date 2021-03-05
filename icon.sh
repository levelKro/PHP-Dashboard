#!/bin/bash
# REQUIRE PNGVIEW for Raspberry Pi.
#
# Usage:
# ./icon.sh [delay] [filename] (position)
# Example;
# ./icon.sh 5000 bell
# ./icon.sh 5000 bell 2
#
# [delay] is the delay to see the picture, in milliseconds
# [filename] is the name of the png view in the folder, without the extension
# (position) is for choose the special position
# 0 or empty; left 10px, top 10px
# 1; left 10px, top 30px
# 2; left 30px, top 10px
# 3; left 10px, top 10px, but over the '0' layer if is used (force visible)
#
# Explaination of the command line in this script
#
# Use screen for no delay exit of the request. Edit path to icons folder.
# -x is the position from the left
# -y is the position from the top
# -b 0 for support transparency
# -l 3 for define at the layer #3
# -n is not a interactive mode
# -t for the timeout in ms
#
case "$3" in
  1)
/usr/bin/screen -h 10 -dmS Icon /home/pi/raspidmx/pngview/pngview -x 10 -y 30 -b 0 -l 3 -n -t $1 /var/www/html/inc/icons/$2.png  > /dev/null 2>&1    
    ;;
  2)
/usr/bin/screen -h 10 -dmS Icon /home/pi/raspidmx/pngview/pngview -x 30 -y 10 -b 0 -l 3 -n -t $1 /var/www/html/inc/icons/$2.png  > /dev/null 2>&1
    ;;
  3)
/usr/bin/screen -h 10 -dmS Icon /home/pi/raspidmx/pngview/pngview -x 10 -y 10 -b 0 -l 3 -n -t $1 /var/www/html/inc/icons/$2.png  > /dev/null 2>&1
    ;;
  *)
/usr/bin/screen -h 10 -dmS Icon /home/pi/raspidmx/pngview/pngview -x 10 -y 10 -b 0 -l 1 -n -t $1 /var/www/html/inc/icons/$2.png  > /dev/null 2>&1  
    ;;
esac