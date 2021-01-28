<?php
	// MESSAGE
	if(!isset($cfg) || !is_array($cfg)) die("");
	
	echo '<h1>'.$view["title"].'</h1>';
	if ($file = fopen("configs/".$view["file"], "r")) {
		echo '<p class="message">';
		$i=0;
		while(!feof($file)) {
			$line = fgets($file);
			echo $line;
			$i++;
		}
		if($i==0 || ($i==1 && empty($line))) {
			echo '<center><i>'.translateText("NODATA").'</i></center>'; 
		}
		fclose($file);
		echo '</p>';
	}
	else { 
		echo '<p class="message"><center><i>'.translateText("NODATA").'</i></center></p>'; 
	}
