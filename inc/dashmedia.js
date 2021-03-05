var radioPlayerID=document.getElementById("radioPlayer");
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
function radioPlayer(view) {  
	var id=document.getElementById("radioID").value;
	var host=document.getElementById("radioHost").value;
	var port=document.getElementById("radioPort").value;
	if (window.XMLHttpRequest) { radioPlayerCall=new XMLHttpRequest(); }
	else { radioPlayerCall=new ActiveXObject("Microsoft.XMLHTTP"); }
	radioPlayerCall.onreadystatechange=function() {
		if (radioPlayerCall.readyState==4 && radioPlayerCall.status==200) {
			var result=radioPlayerCall.responseText;		
			var values=JSON.parse(result);	
			if(!values.error){
				//document.getElementById("lvk_listen_now").innerText=values.listenNow;	
				//document.getElementById("lvk_listen_max").innerText=values.listenMax;	
				//document.getElementById("lvk_listen_peak").innerText=values.listenPeak;	
				if(values.title=="")
					document.getElementById("radioTitle").innerText="Internet Radio";
				else
					document.getElementById("radioTitle").innerText=values.title;	
				if(values.songTitle=="")
					document.getElementById("radioSong").innerText="~ no informations ~";
				else							
					document.getElementById("radioSong").innerText=values.songTitle;	
			}
			else{
				document.getElementById("radioSong").innerText="error when updating";
			}
		}
	}
	radioPlayerCall.open("GET","api.php?id="+id+"&h="+host+"&port="+port+"&a=radio&r="+Math.random(),true);
	radioPlayerCall.send();	
}	
function weatherUpdate(view) {  
	if (window.XMLHttpRequest) { weatherUpdateCall=new XMLHttpRequest(); }
	else { weatherUpdateCall=new ActiveXObject("Microsoft.XMLHTTP"); }
	weatherUpdateCall.onreadystatechange=function() {
		if (weatherUpdateCall.readyState==4 && weatherUpdateCall.status==200) {
			var result=weatherUpdateCall.responseText;		
			var values=JSON.parse(result);	
			if(!values.error){
				document.getElementById("weatherTemp").innerHTML=values.temp;
				document.getElementById("weatherFeel").innerHTML=values.feel;
				if(values.clouds) document.getElementById("weatherCloud").innerHTML='<i class="fas fa-cloud grey"></i> '+values.clouds+'%';
				else document.getElementById("weatherCloud").innerHTML='<i class="fas fa-cloud grey"></i> 0%';
				document.getElementById("weatherTempMin").innerHTML='<i class="fas fa-temperature-low blue"></i> '+values.min;
				document.getElementById("weatherTempMax").innerHTML='<i class="fas fa-temperature-high orange"></i> '+values.max;
				if(values.snow) document.getElementById("weatherRainSnow").innerHTML='<i class="fas fa-snowflake white"></i> '+values.snow+'cm';
				else if(values.rain) document.getElementById("weatherRainSnow").innerHTML='<i class="fas fa-cloud-rain blue"></i> '+values.rain+'mm';
				else document.getElementById("weatherRainSnow").innerHTML="";
				document.getElementById("weatherDetails").innerHTML=values.name;
				document.getElementById("weatherImage").innerHTML=values.image;
			}
			else{
				document.getElementById("weatherDetails").innerText="error when updating weather";
			}
		}
	}
	weatherUpdateCall.open("GET","api.php?a=currentWeather2&r="+Math.random(),true);
	weatherUpdateCall.send();	
}
function randomBall(){
	var ballArray = ['volleyball-ball','basketball-ball','baseball-ball','futbol',];
	var randomNumber = Math.floor(Math.random()*ballArray.length);
	return ballArray[randomNumber];
}
function countProperties(obj) {
    var count = 0;
    for(var prop in obj) {
        if(obj.hasOwnProperty(prop))
            ++count;
    }
    return count;
}
function mailboxUpdate(view) {  
	if (window.XMLHttpRequest) { mailboxUpdateCall=new XMLHttpRequest(); }
	else { mailboxUpdateCall=new ActiveXObject("Microsoft.XMLHTTP"); }
	mailboxUpdateCall.onreadystatechange=function() {
		if (mailboxUpdateCall.readyState==4 && mailboxUpdateCall.status==200) {
			var result=mailboxUpdateCall.responseText;		
			var values=JSON.parse(result);	
			if(!values.error){
				document.getElementById("mailUnread").innerHTML='<i class="fas fa-envelope"></i> '+values.unread;
				document.getElementById("mailRead").innerHTML='<i class="fas fa-envelope-open"></i> '+values.read;
				const latest = Object.values(values.latest);
				if(countProperties(latest)>=1) {
					document.getElementById("mailUnreadList").innerHTML="";
					latest.forEach(updateMailList);
				}
				else {
					var mailBox=document.getElementById("mailbox");
					document.getElementById("mailUnreadList").innerHTML='</dl><marquee direction="down" behavior="alternate" width='+mailBox.getBoundingClientRect().width+' height='+mailBox.getBoundingClientRect().height+' style="display:block;margin:-10px;"><marquee behavior="alternate"><i class="fas fa-'+randomBall()+' myBall"></i></marquee></marquee><dl>';
				}
			}
			else{
				document.getElementById("mailUnreadList").innerText="error when contacting mailbox";
			}
		}
	}
	mailboxUpdateCall.open("GET","api.php?a=mail2&r="+Math.random(),true);
	mailboxUpdateCall.send();	
}
function updateMailList(item,index,arr) {
	document.getElementById("mailUnreadList").innerHTML+='<dt>'+arr[index]['subject']+'</dt><dd><i class="fas fa-calendar-alt"></i> '+arr[index]['date']+' <i class="fas fa-user"></i> '+arr[index]['author']+'</dd>';
}

function playerState(){
	var playerRadioPlay = document.getElementById('radioPlayerPlay');
	var playerRadioPause = document.getElementById('radioPlayerPause');
	if(radioPlayerID.paused){
		playerRadioPause.style.display="none";
		playerRadioPlay.style.display="block";
	}
	else{
		playerRadioPlay.style.display="none";
		playerRadioPause.style.display="block";
	}
	return radioPlayerID.paused;
}
document.addEventListener('DOMContentLoaded', function(){
	var playerRadioPlay = document.getElementById('radioPlayerPlay');
	var playerRadioPause = document.getElementById('radioPlayerPause');
	playerRadioPlay.addEventListener('click', function() {
		radioPlayerID.load();
		radioPlayerID.play();
		playerState();
	});
	playerRadioPause.addEventListener('click', function() {
		radioPlayerID.pause();
		playerState();
	});
	radioPlayerID.addEventListener('play', function() {
		playerState();
	});
	radioPlayerID.addEventListener('pause', function() {
		playerState();
	});
	radioPlayerID.addEventListener('ended', function() {
		playerState();
	});
	radioPlayerID.addEventListener('timeupdate', function() {
		document.getElementById("radioTime").innerText=toHumanTime(radioPlayerID.currentTime);
	});	
});
var checkLinks="";
function goGrabLinks(myclass) {		
	const sliderLinks = document.querySelector(myclass);
	if(sliderLinks!=null) {			
		let isDownLinks = false;
		let startXLinks;
		let startYLinks;
		let scrollLeftLinks;
		let scrollTopLinks;		
		sliderLinks.addEventListener("mousedown", e => {
			isDownLinks = true;
			sliderLinks.classList.add("active");
			startXLinks = e.pageX - sliderLinks.offsetLeft;
			startYLinks = e.pageY - sliderLinks.offsetTop;
			scrollLeftLinks = sliderLinks.scrollLeft;
			scrollTopLinks = sliderLinks.scrollTop;
		});
		sliderLinks.addEventListener("mouseleave", () => {
			isDownLinks = false;
			sliderLinks.classList.remove("active");
		});
		sliderLinks.addEventListener("mouseup", () => {
			isDownLinks = false;
			sliderLinks.classList.remove("active");
		});
		sliderLinks.addEventListener("mousemove", e => {
			if (!isDownLinks) return;
			e.preventDefault();
			const xLinks = e.pageX - sliderLinks.offsetLeft;
			const yLinks = e.pageY - sliderLinks.offsetTop;
			const walkXLinks = xLinks - startXLinks;
			const walkYLinks = yLinks - startYLinks;
			sliderLinks.scrollLeft = scrollLeftLinks - walkXLinks;
			sliderLinks.scrollTop = scrollTopLinks - walkYLinks;
		});
	}
	else {
		checkLinks=setTimeout("goGrabLinks('"+myclass+"');",500);
	}				
}
var checkToday="";
function goGrabToday(myclass) {		
	const sliderToday = document.querySelector(myclass);
	if(sliderToday!=null) {			
		let isDownToday = false;
		let startXToday;
		let startYToday;
		let scrollLeftToday;
		let scrollTopToday;		
		sliderToday.addEventListener("mousedown", e => {
			isDownToday = true;
			sliderToday.classList.add("active");
			startXToday = e.pageX - sliderToday.offsetLeft;
			startYToday = e.pageY - sliderToday.offsetTop;
			scrollLeftToday = sliderToday.scrollLeft;
			scrollTopToday = sliderToday.scrollTop;
		});
		sliderToday.addEventListener("mouseleave", () => {
			isDownToday = false;
			sliderToday.classList.remove("active");
		});
		sliderToday.addEventListener("mouseup", () => {
			isDownToday = false;
			sliderToday.classList.remove("active");
		});
		sliderToday.addEventListener("mousemove", e => {
			if (!isDownToday) return;
			e.preventDefault();
			const xToday = e.pageX - sliderToday.offsetLeft;
			const yToday = e.pageY - sliderToday.offsetTop;
			const walkXToday = xToday - startXToday;
			const walkYToday = yToday - startYToday;
			sliderToday.scrollLeft = scrollLeftToday - walkXToday;
			sliderToday.scrollTop = scrollTopToday - walkYToday;
		});
	}
	else {
		checkToday=setTimeout("goGrabToday('"+myclass+"');",500);
	}				
}
document.getElementById("buttonBack").style.display="none";
getApi("time","time","");
getApi("date","date","");
getApi("links","links","");
weatherUpdate();
mailboxUpdate();
radioPlayer();
getApi("today","todayCalendar","");
var myTime=setInterval("getApi('time','time','');",30000);
var myDate=setInterval("getApi('date','date','');",305000);
var myLinks=setInterval("getApi('links','links','');",60500);
var myWeather=setInterval("weatherUpdate();",900500);
var myMailbox=setInterval("mailboxUpdate();",300500);
var myLinks=setInterval("getApi('today','todayCalendar','');",60500);
var radioPlayerUpdate=setInterval("radioPlayer();",60500);
setMaxsize("fix0");
document.getElementById("links").style.height=Math.floor(screen.height-60)+"px";
document.getElementById("links").style.maxHeight=Math.floor(screen.height-60)+"px";
