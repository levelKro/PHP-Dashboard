<?php
	// DASHBOARD
	if(!isset($cfg) || !is_array($cfg)) die("");
	
	echo '
	<input id="radioID" type="hidden" value="'.$view["id"].'"/>
	<input id="radioHost" type="hidden" value="'.$view["host"].'"/>
	<input id="radioPort" type="hidden" value="'.$view["port"].'"/>
		<table cellspacing=3 cellpadding=0 class="dashMedia" id="fix0">
			<tr>
				<td rowspan=4 width=20%>
					<div class="dashMediaLinks">
						<div class="links" id="fix1">';
							foreach($cfg['links'] as $id=>$item){
								echo '<div class="link" onclick="goView('.$id.');"><i class="fas fa-'.$item['icon'].'"></i><span class="text">'.$item['title'].'</span></div>';
							}
							echo '</div>
						<div class="controls">
							<i class="fas fa-power-off" onclick="getApi(\'controls\',\'poweroff\',\'\');"></i>
							<i class="fas fa-sync" onclick="getApi(\'controls\',\'reboot\',\'\');"></i>
						</div>
					</div>
				</td>
				<td width=20% height=20% class="radioPlayer">
					<a id="radioPlayerPlay"><i class="fas fa-play"></i></a>
					<a id="radioPlayerPause" style="display:none;"><i class="fas fa-pause"></i></a>
					<span id="radioTime">00:00:00</span>
					<marquee behavior="scroll" direction="left" id="radioTitle">loading...</marquee>
				</td>
				<td colspan=2 width=60% height=25% onclick="goView(\'calendar\');" class="timeDate">
					<div id="time"></div>
					<div id="date"></div>
				</td>
			</tr>
			<tr>
				<td colspan=3 width=80% height=10% class="radioSong">
					<marquee behavior="scroll" direction="left" id="radioSong"></marquee>
				</td>
			</tr>			
			<tr>
				<td width=20% height=20% onclick="goView(\'weather\');" class="weatherImage"><div id="weatherImage"></div></td>
				<td width=30% height=20% onclick="goView(\'weather\');" class="weatherTemp">
					<div id="weatherTemp"></div>
					<div id="weatherFeel"></div>
					<div id="weatherDetails"></div>
				</td>
				<td width=30% height=20% onclick="goView(\'weather\');" class="weatherInfos">
					<div id="weatherCloud"></div>
					<div id="weatherTempMin"></div>
					<div id="weatherTempMax"></div>
					<div id="weatherRainSnow"></div>
				</td>
			</tr>
			<tr>
				<td width=20% onclick="goView(\'mailbox\');" class="mailBoxIcons">
					<div id="mailUnread"></div>
					<div id="mailRead"></div>
				</td>
				<td width=60% colspan=2 onclick="goView(\'mailbox\');" class="mailBoxLatest">
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