<?php
	// RSS
	if(!isset($cfg) || !is_array($cfg)) die("");
	
	$data_xml=remoteUrl($view['url']);
	$data_json=json_encode((array) simplexml_load_string($data_xml, 'SimpleXMLElement', LIBXML_NOCDATA));
	$datas = json_decode($data_json, 1);
	$data_info=array(
		"title"=>$datas['channel']['title'],
		"link"=>$datas['channel']['link'],
		"description"=>$datas['channel']['description'],
		"language"=>$datas['channel']['language']
	);
	$data_items=$datas['channel']['item'];		
	$data_items=array_reverse($data_items);
	echo '<h1>'.$data_info['title'].'</h1><p class="message">'.$data_info['description'].'</p><ul>';
	if(!empty($data_items['title'])) {
		$tmp=$data_items;
		unset($data_items);
		$data_items[]=$tmp;
	}
	for($x=0;($x<10 && $x<count($data_items));$x++){
		$item=$data_items[$x];
		echo '<li><h3>'.((strlen($item['title'])>60)?substr($item['title'],0,60)."...":$item['title']).'</h3><small>'.translateDate(date("l, j F, Y - H:i",strtotime($item['pubDate']))).'</small></li>';
	}	
	echo '</ul>';