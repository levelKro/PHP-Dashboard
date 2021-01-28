	/*
		JAVASCRIPTS FILE
	*/
	var ga=new Array();
	function goDash(){
		document.getElementById("loading").style.display="block";
		document.getElementById("frameA").setAttribute("class","frameContent animate__animated animate__fadeOut animate__slower");
		setTimeout("window.location.href='index.php';",1000);
	}
	function goView(id){
		document.getElementById("loading").style.display="block";
		document.getElementById("frameA").setAttribute("class","frameContent animate__animated animate__fadeOut animate__slower");
		setTimeout("window.location.href='index.php?v="+id+"';",1000);
	}	
	function getApi(id,action,values) { 
		if(!values) values=""; //&name=value&name=value
		if (window.XMLHttpRequest) { ga[id]=new XMLHttpRequest(); }
		else { ga[id]=new ActiveXObject("Microsoft.XMLHTTP"); }
		ga[id].onreadystatechange=function() {
			if (ga[id].readyState==4 && ga[id].status==200) {
				document.getElementById(id).innerHTML=ga[id].responseText;
			}
		}
		ga[id].open("GET","api.php?a="+action+values+"&r="+Math.random(),true);
		ga[id].send();	
	}
	function setMaxsize(id){
		document.getElementById(id).style.width=screen.width+"px";
		document.getElementById(id).style.height=screen.height+"px";
		document.getElementById(id).style.maxWidth=screen.width+"px";
		document.getElementById(id).style.maxHeight=screen.height+"px";
	}	