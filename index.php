<?php
	// PHP Dashboard
	// 2021-01
	// By Mathieu Légaré (levelKro)
	
	// INDEX FILE
	error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_STRICT & ~E_DEPRECATED);
	ini_set("display_errors", 1);
	date_default_timezone_set("America/Montreal");
	setlocale(LC_MONETARY, 'en_US');
	
	require_once("configs/config.php");
	require_once("inc/libs.php");
	if(file_exists("configs/".$cfg['lang'].".lang.php")) require_once("configs/".$cfg['lang'].".lang.php");
	else require_once("configs/en.lang.php");
	$view=$cfg['dashboard'];
	if(isset($_GET['v'])){
		if(!is_numeric($_GET['v']) && $_GET['v']!="" && is_array($cfg[$_GET['v']]) && file_exists("inc/view.".$cfg[$_GET['v']]['view'].".php")){ 	
			$view=$cfg[$_GET['v']];
		}
		else if(is_array($cfg['links'][$_GET['v']])){
			if(file_exists("inc/view.".$cfg['links'][$_GET['v']]['view'].".php")){
				$view=$cfg['links'][$_GET['v']];
			}
		}
	}
	
	// HTML output
	echo '
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>PHP Dashboard</title>
		<link rel="stylesheet" href="inc/fontawesome/css/all.css">
		<link rel="stylesheet" href="inc/animate.min.css">
		<link rel="stylesheet" href="inc/styles.css">
		<meta name="google" content="notranslate">
		<script src="inc/libs.js"></script>
		<style>.frameBG { background-image:url(configs/bg/'.$view['background'].'); }</style>
	</head>
	<body>
		<div class="frameBG">
			<div class="frameWrapper">
				<div id="loading" class="loading rotating" style="display:none;"><i class="fas fa-spinner"></i></div>
				<div id="frameA" class="frameContent animate__animated animate__fadeIn animate__slower">
					<div id="buttonBack" class="buttonBack" onclick="goDash();"><i class="fas fa-chevron-circle-left"></i></div>
					<div id="frameB" class="content" >';
					// Loading output module
					include_once("inc/view.".$view['view'].".php");
				echo '</div>					
				</div>
			</div>
		</div>
		<script src="inc/run.js"></script>
	</body>
</html>';	