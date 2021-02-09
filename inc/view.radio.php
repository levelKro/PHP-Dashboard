<?php
	// DASHBOARD
	if(!isset($cfg) || !is_array($cfg)) die("");
	
	echo '
	<div class="dashRadio">
		<audio id="koreplayer">
			<source src="http://'.$view["host"].':'.$view["port"].'/'.$view["id"].'" type="audio/mpeg">
			Your browser does not support the audio element.
		</audio>
		<h2 id="lvk_title">Connecting to radio...</h2>
		<marquee behavior="scroll" direction="left" id="lvk_song">loading...</marquee><div class="submarquee"><span id="lvk_listen_now">0</span>/<span id="lvk_listen_max">0</span> (<span id="lvk_listen_peak">0</span>) onlines</div>
		<div id="koreRadioPlayer">
			<div class="playerDetails"><span id="playerTime">00:00:00</span></div>
			<button class="Start" id="StartkoreRadio"><i class="fas fa-play"></i></button>
			<button class="Pause" id="PausekoreRadio"><i class="fas fa-pause"></i></button> 
			<button class="Stop" id="StopkoreRadio"><i class="fas fa-stop"></i></button> 
		</div>	
			<input id="radioID" type="hidden" value="'.$view["id"].'"/>
			<input id="radioHost" type="hidden" value="'.$view["host"].'"/>
			<input id="radioPort" type="hidden" value="'.$view["port"].'"/>
	</div>
	<div class="dashTopLeft" onclick="goView(\'calendar\');">
		<div id="time" class="dashTime"></div>
		<div id="date" class="dashDate"></div>
	</div>
	<div id="weather" class="dashWeather" onclick="goView(\'weather\');"></div>
	<div id="mailbox" class="dashMailbox" onclick="goView(\'mailbox\');"></div>
	';
?>
	<link rel="stylesheet" href="inc/radio.css">
	<script src="inc/radio.js"></script>
	<script>
		getApi("time","time","");
		getApi("date","date","");
		getApi("weather","currentWeather","");
		getApi("mailbox","mail","");
		var myTime=setInterval("getApi('time','time','');",30000);
		var myDate=setInterval("getApi('date','date','');",30000);
		var myWeather=setInterval("getApi('weather','currentWeather','');",900000);
		var myMailbox=setInterval("getApi('mailbox','mail','');",300000);
		document.getElementById("buttonBack").style.bottom="5px";
		document.getElementById("buttonBack").style.top="unset";
	</script>