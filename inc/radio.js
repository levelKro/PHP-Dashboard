var korePlayer=document.getElementById("koreplayer");
function toHumanTime(secs) {
    var sec_num = parseInt(secs, 10); // don't forget the second param
    var hours   = Math.floor(sec_num / 3600);
    var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
    var seconds = sec_num - (hours * 3600) - (minutes * 60);

    if (hours   < 10) {hours   = "0"+hours;}
    if (minutes < 10) {minutes = "0"+minutes;}
    if (seconds < 10) {seconds = "0"+seconds;}
    return hours+':'+minutes+':'+seconds;
}
function radioLVK(view) {  
	var id=document.getElementById("radioID").value;
	var host=document.getElementById("radioHost").value;
	var port=document.getElementById("radioPort").value;
	if (window.XMLHttpRequest) { radioLVKCall=new XMLHttpRequest(); }
	else { radioLVKCall=new ActiveXObject("Microsoft.XMLHTTP"); }
	radioLVKCall.onreadystatechange=function() {
		if (radioLVKCall.readyState==4 && radioLVKCall.status==200) {
			var result=radioLVKCall.responseText;		
			var values=JSON.parse(result);	
			if(!values.error){
				document.getElementById("lvk_listen_now").innerText=values.listenNow;	
				document.getElementById("lvk_listen_max").innerText=values.listenMax;	
				document.getElementById("lvk_listen_peak").innerText=values.listenPeak;	
				if(values.title=="")
					document.getElementById("lvk_title").innerText="Unknown radio name";
				else
					document.getElementById("lvk_title").innerText=values.title;	
				if(values.songTitle=="")
					document.getElementById("lvk_song").innerText="- no informations -";
				else							
					document.getElementById("lvk_song").innerText=values.songTitle;	
			}
			else{
				document.getElementById("lvk_song").innerText="error when updating";
			}
		}
	}
	radioLVKCall.open("GET","api.php?id="+id+"&h="+host+"&port="+port+"&a=radio&r="+Math.random(),true);
	radioLVKCall.send();	
}	
document.addEventListener('DOMContentLoaded', function(){
	var Start_koreRadio = document.getElementById('StartkoreRadio');
	var Pause_koreRadio = document.getElementById('PausekoreRadio');
	var Stop_koreRadio = document.getElementById('StopkoreRadio');
	Start_koreRadio.addEventListener('click', function() {
		korePlayer.load();
		korePlayer.play();
	});
	Pause_koreRadio.addEventListener('click', function() {
		korePlayer.pause();
	});
	Stop_koreRadio.addEventListener('click', function() {
		korePlayer.pause();
	});
});
radioLVK();
setInterval("radioLVK();",60000);
setInterval(function(){	document.getElementById("playerTime").innerText=toHumanTime(korePlayer.currentTime);},1000);
