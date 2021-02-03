<?php
	// DASHBOARD
	if(!isset($cfg) || !is_array($cfg)) die("");
	
	echo '<div class="dashLinks">';
	foreach($cfg['links'] as $id=>$item){
		echo '<div class="dashLink" onclick="goView('.$id.');"><i class="fas fa-'.$item['icon'].'"></i><span class="text">'.$item['title'].'</span></div>';
	}
	echo '</div>
	<div class="dashTopLeft" onclick="goView(\'calendar\');">
		<div id="time" class="dashTime"></div>
		<div id="date" class="dashDate"></div>
	</div>
	<div id="weather" class="dashWeather" onclick="goView(\'weather\');"></div>
	<div id="mailbox" class="dashMailbox" onclick="goView(\'mailbox\');"></div>
	<div id="controls" class="dashControls"><i class="fas fa-power-off" onclick="getApi(\'controls\',\'poweroff\',\'\');"></i> <i class="fas fa-sync" onclick="getApi(\'controls\',\'reboot\',\'\');"></i></div>';
?>
<script>
getApi("time","time","");
getApi("date","date","");
getApi("weather","currentWeather","");
getApi("mailbox","mail","");
var myTime=setInterval("getApi('time','time','');",30000);
var myDate=setInterval("getApi('date','date','');",30000);
var myWeather=setInterval("getApi('weather','currentWeather','');",900000);
var myMailbox=setInterval("getApi('mailbox','mail','');",300000);
document.getElementById("buttonBack").style.display="none";
</script>