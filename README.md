# PHP Dashboard
 This PHP script is for create a very simple dashboard for home and IT usage. You can make your own menu and you can create your module for your requirement. Great solution for dashboard with a Raspberry Pi, I use it with a Raspberry Pi Zero on the latest Raspbian with Chronium in Kiosk mode without problem.
 
# Requirement
- Apache or compatible Web server
- PHP 5.4 or newer, support PHP 7.x (with cURL, imap, xml support)

# Features
- Playlist configurable; duration, module, order, background, values, etc...
- Can be used in your language
- Very light, minimum JavaScript and image usage, CSS styling and animations
- Optimized for 800x600 screen
- Write your own script for your usage
- Can edit CSS for color and others changes
- Support translate of dates
- Elements animations 
- Date translation (limited lang support)

# Modules (in order of addition)
- `list` : Reading list elements from a text file
- `message` : Reading message from a text file
- `weather` : Weather of your location and forecast (require free API key from https://openweathermap.org/api (optional) )
- `computers` : List of computers and device on network (static IP only)
- `servers` : List servers and services status
- `camera` : Show preview/live capture of MJpeg/Jpeg IP camera
- `rss` : Simple RSS reader (last 10 entries)
- `mailbox` : Read the number of unread/total emails in the inbox of your mailbox
- `calendar` : Add your schedules and important days into this calendar easy to use and read
- `radio` : Radio Player, support only Shoutcast v2.x stream

# Next
- Admin UI for change config file
- Admin UI : Manage text files.

# Usage
- Upload/copy file into your web directory,
- Rename `config.php.dist` to `config.php`;
 - You can edit the file
 - Text files and randoms images must be copied into the `configs` directory,
- Customs backgrounds and picture for Image module must be copied into the `configs/bg` directory,

# Copyrights
- Images : From google images
- Codes : Mathieu Légaré, levelkro at yahoo dot com, https://levelkro.com
- Animations librairies in CSS only : https://animate.style
