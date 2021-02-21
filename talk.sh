#!/bin/bash
#
# You can adjust eSpeak for your needs
# -p is a pitch (0-100)
# -s number of word per minute (80-200)
# -b 1 for support UTF-8 text
# -l 1 for define this is one line only
# -a for the volume (0-200, normal is 100)
# -v Voice to use
# "" the text to speech
#
/usr/bin/espeak -p 30 -s 100 -l 1 -a 125 -b 1 -v $1 "$2"
