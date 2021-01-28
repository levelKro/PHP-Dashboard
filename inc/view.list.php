<?php
	// LIST
	if(!isset($cfg) || !is_array($cfg)) die("");
	
	echo '<h1>'.$view["title"].'</h1>';
	if ($file = fopen("configs/".$view["file"], "r")) {
		echo '<ul>';
		$i=0;
		while(!feof($file)) {
			$line = fgets($file);
			echo '<li>'.$line.'</li>';
			$i++;
		}
		if($i==0 || ($i==1 && empty($line))) {
			echo '<li><i>'.translateText("NODATA").'</i></li>'; 
		}
		fclose($file);
		echo '</ul>';
	}
	else { 
		echo '<p class="Message"><center><i>'.translateText("NODATA").'</i></center></p>'; 
	}