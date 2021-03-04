<?php
	// DASHBOARD
	if(!isset($cfg) || !is_array($cfg)) die("");
	
	echo '
	<input id="radioID" type="hidden" value="'.$view["id"].'"/>
	<input id="radioHost" type="hidden" value="'.$view["host"].'"/>
	<input id="radioPort" type="hidden" value="'.$view["port"].'"/>
		<table cellspacing=3 cellpadding=0 class="dashMedia" id="fix0">
			<tr>
				<td rowspan=3 width=15%>
					<div class="dashMediaLinks">
						<div class="links" id="links"></div>
						<div class="controls">
							<i class="fas fa-power-off" onclick="getApi(\'controls\',\'poweroff\',\'\');"></i>
							<i class="fas fa-sync" onclick="getApi(\'controls\',\'reboot\',\'\');"></i>
						</div>
					</div>
				</td>
				<td colspan=4 onclick="goView(\'calendar\');" class="timeDate">
					<div id="time"></div>
					<div id="date"></div>
				</td>
				<td onclick="goView(\'calendar\');" class="today">
					<div id="today"></div>
				</td>
			</tr>
			<tr>
				<td width=25% height=20% onclick="goView(\'weather\');" class="weatherImage">
					<div id="weatherImage"></div>
					<div id="weatherDetails"></div>
				</td>
				<td width=15% height=20% onclick="goView(\'weather\');" class="weatherTemp">
					<div id="weatherTemp"></div>
					<div id="weatherFeel"></div>
				</td>
				<td width=15% height=20% onclick="goView(\'weather\');" class="weatherInfos">
					<div id="weatherCloud"></div>
					<div id="weatherTempMin"></div>
					<div id="weatherTempMax"></div>
					<div id="weatherRainSnow"></div>
				</td>
				<td width=25% height=20% colspan=2 class="radioPlayer">
					<a id="radioPlayerPlay"><i class="fas fa-play"></i></a>
					<a id="radioPlayerPause" style="display:none;"><i class="fas fa-pause"></i></a>
					<span id="radioTime">00:00:00</span>
					<marquee behavior="alternate" direction="right" scrollamount=1 scrolldelay=300 id="radioTitle">loading...</marquee>					
					<marquee behavior="alternate" direction="left" scrollamount=2 scrolldelay=100 id="radioSong"></marquee>
				</td>
			</tr>
			<tr>
				<td height=50% onclick="goView(\'mailbox\');" class="mailBoxIcons">
					<div id="mailUnread"></div>
					<div id="mailRead"></div>
				</td>
				<td height=50% colspan=4 onclick="goView(\'mailbox\');" class="mailBoxLatest" id="mailbox">
					<dl id="mailUnreadList"></dl>
				</td>
			</tr>
		</table>
		
		<audio id="radioPlayer">
			<source src="http://'.$view["host"].':'.$view["port"].'/'.$view["id"].'" type="audio/mpeg">
		</audio>
	';

?>
<script src="inc/dashmedia.js"></script>
<script>

</script>
<link rel="stylesheet" href="inc/dashmedia.css">