<?php
	// API FILE
	error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_STRICT & ~E_DEPRECATED);
	ini_set("display_errors", 1);
	date_default_timezone_set("America/Montreal");
	setlocale(LC_MONETARY, 'en_US');
	
	require_once("configs/config.php");
	require_once("inc/libs.php");
	if(file_exists("configs/".$cfg['lang'].".lang.php")) require_once("configs/".$cfg['lang'].".lang.php");
	else require_once("configs/en.lang.php");	
	switch($_GET['a']){
		case "currentWeather";
			$jsonurl = "http://api.openweathermap.org/data/2.5/weather?q=".$cfg['weather']['city']."&appid=".$cfg['weather']['api']."&lang=".$cfg['lang']."&units=metric";
			$json = file_get_contents($jsonurl);
			$weather = json_decode($json);
			$return['temp'] = round($weather->main->temp,0)."°C";
			$return['feel'] = round($weather->main->feels_like,0)."°C";
			$return['min'] = round($weather->main->temp_min,0)."°C";
			$return['max'] = round($weather->main->temp_max,0)."°C";
			$return['name'] = $weather->weather[0]->description;
			echo '<span class="icon"><i class="fas fa-'.getWeatherIcon($weather->weather[0]->id).' '.getWeatherColor($weather->weather[0]->id).'"></i></span>';
			echo '<span class="title">'.$return['temp'].' <small>('.$return['feel'].')</small></span>';
			echo '<span class="details">'.$return['name'].'</span>';
			echo '<span class="more"><i class="fas fa-temperature-low blue"></i> '.$return['min'].' <i class="fas fa-temperature-high red"></i> '.$return['max'].'</span>';
			exit;
		break;
		case "nextWeather":
			$jsonurl = "http://api.openweathermap.org/data/2.5/forecast?q=".$cfg['weather']['city']."&appid=".$cfg['weather']['api']."&lang=".$cfg['lang']."&units=metric";
			$json = file_get_contents($jsonurl);
			$weather = (array) json_decode($json);
			$list=$weather['list'];
			$i=0;
			$today=date("j",time());
			
			$output=array();
			foreach($list as $item){
				$item = (array) $item;
				if($item["snow"]) $item["snow"]=(array) $item["snow"];
				else $item["snow"]="";
				if($item["rain"]) $item["rain"]=(array) $item["rain"];
				else $item["rain"]="";
				$day=date("j",$item["dt"]);
				if($i<=4){
					$output['today'][]=array(
						"date"=>$item["dt"],
						"code"=>$item["weather"][0]->id,
						"temp"=>round($item["main"]->temp,1).'°C',
						"feel"=>round($item["main"]->feels_like,1).'°C',
						"min"=>round($item["main"]->temp_min,0).'°C',
						"max"=>round($item["main"]->temp_max,0).'°C',
						"humidity"=>$item["main"]->humidity.'%',
						"clouds"=>$item["clouds"]->all.'%',
						"winds"=>$item["wind"]->speed.'m/s',
						"details"=>$item["weather"][0]->description,
						"snow"=>(($item["snow"])?$item["snow"]["3h"]*100:''),
						"rain"=>(($item["rain"])?$item["rain"]["3h"]*1000:'')
					);
					$i++;
				}
				if($day!=$today){
					$output['next'][$day]['date']=$item["dt"];
					if($item["weather"][0]->id!="800") $output['next'][$day]['code'][substr($item["weather"][0]->id,0,1)]++;
					else $output['next'][$day]['code'][0]++;
					if($item["main"]->temp_min<$output['next'][$day]['min'] || $output['next'][$day]['min']=="") $output['next'][$day]['min']=round($item["main"]->temp_min,1);
					if($item["main"]->temp_max>$output['next'][$day]['max'] || $output['next'][$day]['max']=="") $output['next'][$day]['max']=round($item["main"]->temp_max,1);
					if(is_numeric($item["snow"]["3h"])) $output['next'][$day]['snow']=($output['next'][$day]['snow']+($item["snow"]["3h"]*100));
					if(is_numeric($item["rain"]["3h"])) $output['next'][$day]['rain']=($output['next'][$day]['rain']+($item["rain"]["3h"]*1000));
				}
			}
			echo '<h3>'.translateText("TODAY").'<br><small>'.translateDate(date("l, j F",$today["date"])).'</small></h3><div class="mainWeatherTable"><div class="weatherToday">';
			foreach($output['today'] as $today) {
				echo '<div class="todayBox">
					<span class="todayTime">'.date("H",$today["date"]).'h00</span>
					<div class="weatherRow">
						<span class="todayIcon"><i class="fas fa-'.getWeatherIcon($today['code']).' '.getWeatherColor($today['code']).'"></i></span>
						<span class="todayTemp">'.$today['temp'].'</span>
						<span class="todayFeel grey">('.$today['feel'].')</span>
					</div>
					<div class="weatherRow">
						<span class="todayTempMin"><i class="fas fa-temperature-low blue"></i> '.$today['min'].'</span>
						<span class="todayTempMax"><i class="fas fa-temperature-high red"></i> '.$today['max'].'</span>
					</div>
					<div class="weatherRow">
						<span class="todayHumidity"><i class="fas fa-tint blue"></i> '.$today['humidity'].'</span>
						<span class="todayWinds"><i class="fas fa-wind grey"></i> '.$today['winds'].'</span>
						<span class="todayClouds"><i class="fas fa-cloud grey"></i> '.$today['clouds'].'</span>
					</div>
					<span class="todayDetails darkblue">'.$today['details'].'</span>
					'.(($today['snow']>0)?'<span class="todaySnow"><i class="fas fa-snowflake white"></i> '.$today['snow'].'cm</span>':'').'
					'.(($today['rain']>0)?'<span class="todayRain"><i class="fas fa-cloud-rain blue"></i> '.$today['rain'].'mm</span>':'').'
				</div>';
			}
			echo '</div></div><h3>'.translateText("FORECAST").'</h3>
			<div class="mainWeatherTable">
			<div class="weatherNextdays">';
			foreach($output['next'] as $nextday) {
				$t=0;
				foreach($output['code'] as $inc){
					$t=($t+$inc);
				}
				$code=null;
				foreach($output['code'] as $name=>$inc){
					if($inc>=($inc/count($output['code']))) $code=(($name=="0")?"800":$name."02");
				}
				if(!$code) $code=800;
				echo '<div class="nextdayBox">
					<span class="nextdayTime">'.translateDate(date("l",$nextday["date"])).'<br/>'.translateDate(date("j F",$nextday["date"])).'</span>
					<span class="nextdayIcon"><i class="fas fa-'.getWeatherIcon($code).' '.getWeatherColor($code).'"></i></span>
					<div class="weatherRow">
						<span class="nextdayTempMin"><i class="fas fa-temperature-low blue"></i>  '.$nextday['min'].'°C</span>
						<span class="nextdayTempMax"><i class="fas fa-temperature-high red"></i> '.$nextday['max'].'°C</span>
					</div>
					'.(($tnextday['snow']>0)?'<span class="nextdaySnow"><i class="fas fa-snowflake white"></i> '.$tnextday['snow'].'cm</span>':'').'
					'.(($tnextday['rain']>0)?'<span class="nextdayRain"><i class="fas fa-cloud-rain blue"></i> '.$nextday['rain'].'mm</span>':'').'		
				</div>';
				
			}
			echo '</div></div>';
		break;
		case "ping":
			echo remotePing($_GET['h']);
			exit;
		break;
		case "state":
			echo remoteState($_GET['h'],$_GET['p']);
			exit;
		break;
		case "time":
			echo date("H:i",time());
			exit;
		break;
		case "date":
			echo translateDate(date("l, j F, Y",time()));
			exit;
		break;
		case "mail":
			$mbox = imap_open('{'.$cfg['mailbox']['host'].':'.$cfg['mailbox']['port'].'/imap/ssl/novalidate-cert}INBOX', $cfg['mailbox']['user'], $cfg['mailbox']['pass']);
			if(empty($mbox)) {
				echo "ERROR: ".imap_last_error();
			}
			else {
				$output=array();
				$unread=imap_search($mbox, 'UNSEEN');
				if(empty($unread)) $output["unread"]=0;
				else $output["unread"]=count($unread);
				if($mail = imap_check($mbox)) $output["total"]=$mail->Nmsgs;
				else $output["total"]=0;
				$output["read"]=($output["total"]-$output["unread"]);
				if($output['total']==0) {
					echo '<span class="mailEmpty"><i class="fas fa-inbox"></i></span>';
				}
				else{
					if($output['unread']>0){
						echo ' <span class="mailUnread"><i class="fas fa-envelope"></i>'.$output['unread'].'</span>';
					}
					if($output['read']>0){
						echo ' <span class="mailRead"><i class="fas fa-envelope-open"></i>'.$output['read'].'</span>';
					}
				}
			}
			imap_close($mbox);			
			exit;
		break;
		default:
			die("");
	}