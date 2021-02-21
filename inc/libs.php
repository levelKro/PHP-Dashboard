<?php
	// LIBS FILE
	if(!isset($cfg) || !is_array($cfg)) die("");
	
	function remoteUrl($url,$array=false,$json=false){
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.0.3) Gecko/20060426 Firefox/1.5.0.3");
		if(is_array($array)){
			curl_setopt($ch, CURLOPT_POST, 1);
			if($json===true) curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($array));
			else {
				$out="@@@";
				foreach($array as $n=>$v) $out."&".$n."=".$v;
				curl_setopt($ch, CURLOPT_POSTFIELDS,str_replace("@@@&","",$out));
			}
		}
		curl_setopt($ch,CURLOPT_TIMEOUT,100000);
		$result = curl_exec($ch);
		return $result; 
		curl_close($ch);
	}	
	function remotePing($ip){
		$ping = exec("ping -c 1 $ip"); 
		$ping=explode("=",$ping); 
		if(!$ping[1]) return "offline";
		else return "online";	
	}
	function remoteState($host,$port){
	  	if($fp=@fsockopen($host, $port, $errno, $errstr, 20)){ $rep="online"; } 
		else{ $rep="offline"; }
		return($rep); 
	  	@fclose($fp);
	}	
	function getWeatherIcon($code,$h=null){
		if(!is_numeric($h) || $h==null) $h=date("H");
		elseif($h>24) $h=24;
		elseif($h<0) $h=0;
		$icons=array(
			"300"=>"smog",
			"301"=>"smog",
			"302"=>"smog",
			"310"=>"cloud-rain",
			"311"=>"cloud-rain",
			"312"=>"cloud-showers-heavy",
			"313"=>"cloud-showers-heavy",
			"314"=>"cloud-showers-heavy",
			"321"=>"cloud-showers-heavy",
			"500"=>array("cloud-sun-rain","cloud-moon-rain"),
			"501"=>"cloud-rain",
			"502"=>"cloud-showers-heavy",
			"503"=>"cloud-showers-heavy",
			"504"=>"cloud-showers-heavy",
			"511"=>"cloud-mealtball",
			"520"=>"cloud-showers-heavy",
			"521"=>"cloud-showers-heavy",
			"522"=>"cloud-showers-heavy",
			"531"=>"cloud-showers-heavy",
			"600"=>"snowflake",
			"601"=>"snowflake",
			"602"=>"snowflake",
			"611"=>"cloud-rain",
			"612"=>"cloud-rain",
			"613"=>"cloud-showers-heavy",
			"615"=>"cloud-showers-heavy",
			"620"=>"cloud",
			"621"=>"cloud-rain",
			"622"=>"cloud-showers-heavy",
			"701"=>"smog",
			"711"=>"smog",
			"721"=>"smog",
			"731"=>"wind",
			"741"=>"smog",
			"751"=>"wind",
			"761"=>"wind",
			"762"=>"wind",
			"771"=>"wind",
			"781"=>"wind",
			"200"=>"bolt",
			"201"=>"bolt",
			"202"=>"bolt",
			"210"=>"bolt",
			"211"=>"bolt",
			"212"=>"bolt",
			"221"=>"bolt",
			"230"=>"bolt",
			"231"=>"bolt",
			"232"=>"bolt",
			"800"=>array("sun","moon"),
			"801"=>array("cloud-sun","cloud-moon"),
			"802"=>array("cloud-sun","cloud-moon"),
			"803"=>"cloud",
			"804"=>"cloud",
		);
		$icon=$icons[$code];
		if(is_array($icon)){ 
			if($h>=21 || $h<=4){ return $icon[1]; } 
			else{ return $icon[0]; } 
		}
		else{ return $icon;	}
	}	
	function getWeatherColor($code,$h=null){
		if(!is_numeric($h) || $h==null) $h=date("G");
		elseif($h>24) $h=24;
		elseif($h<0) $h=0;
		$colors=array(
			"300"=>"grey",
			"301"=>"grey",
			"302"=>"grey",
			"310"=>"grey",
			"311"=>"grey",
			"312"=>"grey",
			"313"=>"grey",
			"314"=>"grey",
			"321"=>"grey",
			"500"=>"blue",
			"501"=>"blue",
			"502"=>"blue",
			"503"=>"blue",
			"504"=>"blue",
			"511"=>"blue",
			"520"=>"blue",
			"521"=>"blue",
			"522"=>"blue",
			"531"=>"blue",
			"600"=>"white",
			"601"=>"white",
			"602"=>"white",
			"611"=>"white",
			"612"=>"white",
			"613"=>"white",
			"615"=>"white",
			"620"=>"white",
			"621"=>"white",
			"622"=>"white",
			"701"=>"red",
			"711"=>"red",
			"721"=>"red",
			"731"=>"red",
			"741"=>"red",
			"751"=>"red",
			"761"=>"red",
			"762"=>"red",
			"771"=>"red",
			"781"=>"red",
			"200"=>"orange",
			"201"=>"orange",
			"202"=>"orange",
			"210"=>"orange",
			"211"=>"orange",
			"212"=>"orange",
			"221"=>"orange",
			"230"=>"orange",
			"231"=>"orange",
			"232"=>"orange",
			"800"=>array("yellow","white"),
			"801"=>array("yellow","white"),
			"802"=>array("yellow","white"),
			"803"=>"grey",
			"804"=>"grey",
		);
		$color=$colors[$code];
		if(is_array($color)){ 
			if($h>=21 || $h<=4){ return $color[1]; } 
			else{ return $color[0]; } 
		}
		else{ return $color;	}
	}
	function getServicePort($service){
		$services=array(
			"ftp"=>"21",
			"ssh"=>"22",
			"dns"=>"53",
			"http"=>"80",
			"https"=>"443",
			"sc"=>"8000",
			"tnet"=>"31457",
			"webmin"=>"10000",
			"sql"=>"3306",
			"source"=>"27015",
			"smtp"=>"25",
			"pop"=>"995",
			"rtmp"=>"1935",
			"mc"=>"25565",
			"mcpe"=>"19132",
			"smb"=>"445",
			"netb"=>"139",
			"proxy"=>"3128"
		);	
		return $services[$service];
	}
	/*
		Ultra mini Database like a Ram for current session
		This is for manage process on the machine, like speaking, for not made multiple time if more than one client is connected on dashboard UI
	*/
	function DBRamInit($cache){
		$dh=opendir($cache);
		while (false !== ($filename = readdir($dh))) {
			if($filename!="." && $filename!=".." && !is_dir($d.$filename)){
				@unlink($d.$filename);
			}
		}		
	}
	function DBRamSave($cache,$name,$value){
		$f=$cache.$name.".dbr";
		if(file_exists($f) && ($value=="" || $value==false)) unlink($f);
		else {
			$fp=fopen($f, 'w+');
			fwrite($fp,'<?php $value="'.$value.'";');
			fclose($fp);		
		}
	}
	function DBRamRead($cache,$name){
		$f=$cache.$name.".dbr";
		if(file_exists($f))	{
			include($f);
			return $value;
		}
		else return false;
	}
	// Speak
	function speak($cache,$txt,$lang="en"){
		$txt=strip_tags(html_entity_decode($txt));
		$fp = fopen($cache."talk.txt", 'a+'); fwrite($fp, $lang."||".$txt."\r\n");	fclose($fp);
	}