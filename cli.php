<?php
	// CLI File
	error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_STRICT & ~E_DEPRECATED);
	ini_set("display_errors", 1);
	date_default_timezone_set("America/Montreal");
	setlocale(LC_MONETARY, 'en_US');
	
	require_once("configs/config.php");
	require_once("inc/libs.php");	
	
	// Init first time, clean up cache
	DBRamInit($cfg['cache']);
	start:
	if ($file= fopen($cfg['cache']."talk.txt", "r")) {
		while(!feof($file)) {
			$line = fgets($file);
			if($line!=""){
				$sector=explode("||",$line);
				if($sector[1]!="" || !$sector[1]) {
					echo "*** (".str_replace(" ","+",$sector[0]).") ".$sector[1]."\n";
					if($cfg['icon']['enable']) system($cfg['icon']['path'].' 5000 '.$cfg['icon']['speak']);
					shell_exec($cfg['speak']['script'].' "'.str_replace(" ","+",$sector[0]).'" "'.$sector[1].'"');
				}
			}
		}
		fclose($file);
		$fp = fopen($cfg['cache']."talk.txt", 'w+');
		fwrite($fp, "");
		fclose($fp);
	}					
	sleep(5);
	goto start;
