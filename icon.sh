#!/bin/bash
#
# Use screen for no delay exit of the request. Edit path to icons folder.
# -x is the position from the left
# -y is the position from the top
# -b 0 for support transparency
# -l 3 for define at the layer #3
# -n is not a interactive mode
# -t for the timeout in ms
#
/usr/bin/screen -h 10 -dmS Icon /home/pi/raspidmx/pngview/pngview -x 10 -y 10 -b 0 -l 3 -n -t $1 /var/www/html/inc/icons/$2.png  > /dev/null 2>&1