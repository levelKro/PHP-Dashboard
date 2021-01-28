<?php
	// NETWORK
	if(!isset($cfg) || !is_array($cfg)) die("");
	
	$c=false;
	$i=0;
	$scan=array();
	$s=false;
	echo'<h1>'.$view["title"].'</h1>
	<table class="table">';
	foreach($cfg[$view['list']] as $item){
		$i++;
		if($s==false) { echo '<tr>'; }
		echo '<th style="width:30%">'.$item['name'].'<small>'.$item['info'].'</small></th>
			<td style="text-align:left; width:20%; white-space:nowrap;">'.
			((!empty($item['lan']))?'<div class="state"><i class="fas fa-spinner grey rotating" id="lan'.$i.'"></i> '.$item['lan'].'</div>':'').
			((!empty($item['wifi']))?'<div class="state"><i class="fas fa-spinner grey rotating" id="wifi'.$i.'"></i> '.$item['wifi'].'</div></td>':'');
		if($s==false) { $s=true; }
		else { 
			echo '</tr>';	
			$s=false; 
		}
		if(!empty($item['lan'])) $scan[]=array("name"=>"lan".$i,"ip"=>$item['lan']);
		if(!empty($item['wifi'])) $scan[]=array("name"=>"wifi".$i,"ip"=>$item['wifi']);
	}	
	echo '</table>';
?>
<script type="text/javascript">
	var ghs=new Array();
	function getHostState(host,id) { 
		 document.getElementById(id).setAttribute("class","fas fa-spinner grey rotating"); 	 
		if (window.XMLHttpRequest) { ghs[id]=new XMLHttpRequest(); }
		else { ghs[id]=new ActiveXObject("Microsoft.XMLHTTP"); }
		ghs[id].onreadystatechange=function() {
			if (ghs[id].readyState==4 && ghs[id].status==200) {
				if (ghs[id].responseText=="online") { document.getElementById(id).setAttribute("class","fas fa-check-circle green"); }
				else { document.getElementById(id).setAttribute("class","fas fa-times-circle red");  }
			}
		}
		ghs[id].open("GET","api.php?a=ping&h="+host+"&r="+Math.random(),true);
		ghs[id].send();	
	}
	<?php foreach($scan as $item) {	echo 'getHostState("'.$item['ip'].'","'.$item['name'].'"); '; } ?>
</script>