<?php
	// CAMERA
	if(!isset($cfg) || !is_array($cfg)) die("");
	
	if($cfg['speak']['enable']) speak($cfg['cache'],$view['title'],$cfg['speak']['lang']);
	echo '<h1>'.$view['title'].'</h1><img src="'.$view['url'].'" class="camera"/><link rel="stylesheet" href="inc/camera.css">';