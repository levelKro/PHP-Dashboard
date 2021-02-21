<?php
	// Time module
	
	if($cfg['speak']['enable']) speak($cfg['cache'],$view['title'],$cfg['speak']['lang']);
	echo '<div class="mainWeather"><h1>'.$view['title'].'</h1><div id="forecast"></div></div>';
?>
<script>
	getApi("forecast","nextWeather","");
	var myWeather=setInterval("getApi('forecast','nextWeather','');",900000);
	var checkN="";
	var checkT="";
	function goGrabToday(myclass) {		
		const Tslider = document.querySelector(myclass);
		if(Tslider!=null) {			
			let TisDown = false;
			let TstartX;
			let TstartY;
			let TscrollLeft;
			let TscrollTop;		
			Tslider.addEventListener("mousedown", e => {
				TisDown = true;
				Tslider.classList.add("active");
				TstartX = e.pageX - Tslider.offsetLeft;
				TstartY = e.pageY - Tslider.offsetTop;
				TscrollLeft = Tslider.scrollLeft;
				TscrollTop = Tslider.scrollTop;
			});
			Tslider.addEventListener("mouseleave", () => {
				TisDown = false;
				Tslider.classList.remove("active");
			});
			Tslider.addEventListener("mouseup", () => {
				TisDown = false;
				Tslider.classList.remove("active");
			});
			Tslider.addEventListener("mousemove", e => {
				if (!TisDown) return;
				e.preventDefault();
				const Tx = e.pageX - Tslider.offsetLeft;
				const Ty = e.pageY - Tslider.offsetTop;
				const TwalkX = Tx - TstartX;
				const TwalkY = Ty - TstartY;
				Tslider.scrollLeft = TscrollLeft - TwalkX;
				Tslider.scrollTop = TscrollTop - TwalkY;
			});
		}
		else {
			checkT=setTimeout("goGrabToday('"+myclass+"');",500);
		}				
	}
	function goGrabNextdays(myclass) {		
		const Nslider = document.querySelector(myclass);
		if(Nslider!=null) {			
			let NisDown = false;
			let NstartX;
			let NstartY;
			let NscrollLeft;
			let NscrollTop;		
			Nslider.addEventListener("mousedown", e => {
				NisDown = true;
				Nslider.classList.add("active");
				NstartX = e.pageX - Nslider.offsetLeft;
				NstartY = e.pageY - Nslider.offsetTop;
				NscrollLeft = Nslider.scrollLeft;
				NscrollTop = Nslider.scrollTop;
			});
			Nslider.addEventListener("mouseleave", () => {
				NisDown = false;
				Nslider.classList.remove("active");
			});
			Nslider.addEventListener("mouseup", () => {
				NisDown = false;
				Nslider.classList.remove("active");
			});
			Nslider.addEventListener("mousemove", e => {
				if (!NisDown) return;
				e.preventDefault();
				const Nx = e.pageX - Nslider.offsetLeft;
				const Ny = e.pageY - Nslider.offsetTop;
				const NwalkX = Nx - NstartX;
				const NwalkY = Ny - NstartY;
				Nslider.scrollLeft = NscrollLeft - NwalkX;
				Nslider.scrollTop = NscrollTop - NwalkY;
			});
		}
		else {
			checkN=setTimeout("goGrabNextdays('"+myclass+"');",500);
		}		
	}
	goGrabToday(".weatherToday");
	goGrabNextdays(".weatherNextdays");
</script>
<link rel="stylesheet" href="inc/weather.css">