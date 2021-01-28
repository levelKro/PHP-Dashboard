<?php
	// DASHBOARD
	if(!isset($cfg) || !is_array($cfg)) die("");
	
	$i=0;
	$scan=array();
	echo'<h1>'.$view["title"].'</h1><ul style="width:90%;">';
	foreach($cfg[$view['list']] as $item){
		echo '<li><h3>'.$item['name'].'</h3><small>'.$item['ip'].'</small>';
		foreach($item['ports'] as $raw){
			if(count(explode(":",$raw))==2){ 
				$t=explode(":",$raw);
				$n=$t[0];						
				$p=$t[1];
			}
			else{
				$n=$raw;
				$p=getServicePort($raw);
			}
			$scan[]=array("name"=>"srv".$i,"ip"=>$item['ip'],"port"=>$p);
			echo '<div class="state"><i class="fas fa-spinner grey rotating" id="srv'.$i.'"></i> '.$n.' </div> ';
			$i++;
		}
		echo '</li>';
	}
	echo '</ul>';
?>
<script type="text/javascript">
	var ghs=new Array();
   function getHostState(host,port,id) { 
		 document.getElementById(id).setAttribute("class","fas fa-spinner grey rotating"); 	 
		if (window.XMLHttpRequest) { ghs[id]=new XMLHttpRequest(); }
		else { ghs[id]=new ActiveXObject("Microsoft.XMLHTTP"); }
		ghs[id].onreadystatechange=function() {
			if (ghs[id].readyState==4 && ghs[id].status==200) {
				if (ghs[id].responseText=="online") { document.getElementById(id).setAttribute("class","fas fa-check-circle green"); }
				else { document.getElementById(id).setAttribute("class","fas fa-times-circle red");  }
			}
		}
		ghs[id].open("GET","api.php?a=state&h="+host+"&p="+port+"&r="+Math.random(),true);
		ghs[id].send();	
	}
	<?php foreach($scan as $item) {	echo 'getHostState("'.$item['ip'].'","'.$item['port'].'","'.$item['name'].'"); '; } ?>
</script>