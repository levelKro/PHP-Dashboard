<?php
	// CAMERA
	if(!isset($cfg) || !is_array($cfg)) die("");
	
	echo '<h1>'.$view['title'].'</h1><img src="'.$view['url'].'" class="camera"/>';