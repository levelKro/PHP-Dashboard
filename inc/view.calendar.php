<?php
	// CALENDAR
	
	$today=array(
		"day"=>date("j",time()), // date
		"day_pos"=>date("w",time()), // position in week
		"day_num"=>date("z",time()), // position in the year
		"week"=>date("W",time()), // position of the week
		"month"=>date("n",time()), // month
		"month_day"=>date("t",time()), // total day in the month
		"year"=>date("Y",time()), // year
		"unix"=>time()
	);
	function getTableMonth($month,$year){
		$return=array(
			"month"=>$month,
			"year"=>$year,
			"unix"=>strtotime($month.'/13/'.$year),
			"total"=>date("t",strtotime($month.'/13/'.$year)),
			"days"=>array()
		);
		for($i=1;$i<=$return['total'];$i++){
			$unix=strtotime($month.'/'.$i.'/'.$year);
			$return['days'][$i]=array(
				"unix"=>$unix,
				"day"=>date("j",$unix), // date
				"day_pos"=>date("w",$unix), // position in week
				"day_num"=>date("z",$unix), // position in the year
				"week"=>date("W",$unix), // position of the week
				"month"=>date("n",$unix), // month
				"month_day"=>date("t",$unix), // total day in the month
				"year"=>date("Y",$unix), // year
			);
		}
		return $return;
	}
	function pasteTableMonth($work,$today){
		echo '<div class="calendar">
			<div class="daynames">
				<div class="dayname weekend">'.translateDate("Sunday").'</div>
				<div class="dayname workday">'.translateDate("Monday").'</div>
				<div class="dayname workday">'.translateDate("Tuesday").'</div>
				<div class="dayname workday">'.translateDate("Wednesday").'</div>
				<div class="dayname workday">'.translateDate("Thursday").'</div>
				<div class="dayname workday">'.translateDate("Friday").'</div>
				<div class="dayname weekend">'.translateDate("Saturday").'</div>
			</div>';
		if($work['days'][1]['day_pos']!=0){
			echo '<div class="week">';
			for($i=0;$i<$work['days'][1]['day_pos'];$i++){
				echo '<div class="day previous"></div>';
			}
		}
		foreach($work['days'] as $day){
			if($day['day']==1 && $day['day_pos']==0) echo '<div class="week">';
			else if($day['day_pos']==0) echo '</div><div class="week">';
			echo '<div class="day'.(($day['day']==$today['day'] && $day['month']==$today['month'] && $day['year']==$today['year'])?' active':'').'"><span class="num">'.$day['day'].'</span>';
			echo '<span class="notes"><span class="title">'.translateDate(date("l, j F Y",$day['unix'])).'</span>';
			$fileday="configs/calendar/".$day['month']."-".$day['day']."-".$day['year'].".txt";
			if(file_exists($fileday)){
				if($file=fopen($fileday,"r")){
					$i=0;
					while(!feof($file)) {
						$line = fgets($file);
						if($line!="") echo $line."<br/>";
						$i++;
					}
					fclose($file);
				}				
			}
			$fileday="configs/calendar/".$day['month']."-".$day['day'].".txt";
			if(file_exists($fileday)){
				if($file=fopen($fileday,"r")){
					$i=0;
					while(!feof($file)) {
						$line = fgets($file);
						if($line!="") echo $line."<br/>";
						$i++;
					}
					fclose($file);
				}				
			}			
			echo '</span></div>';
		}
		if($work['days'][$work['total']]['day_pos']!=6){
			for($i=($work['days'][$work['total']]['day_pos']+1);$i<7;$i++){
				echo '<div class="day next"></div>';
			}
		}		
		echo '</div>
		</div>';
	}
	$gm=null;
	$gy=null;
	if(isset($_GET['m'])) $gm=$_GET['m'];
	if($gm>=1 && $gm<=12) $m=$gm;
	else $m=$today['month'];
	if(isset($_GET['y'])) $gy=$_GET['y'];
	if($gy>=1 && $gy<=12) $y=$gy;
	else $y=$today['year'];
	if(($m-1)<=0) { $yp=($y-1); $mp=12; }
	else { $yp=$y; $mp=($m-1); }
	if(($m+1)>=13) { $yn=($y+1); $mn=1; }
	else { $yn=$y; $mn=($m+1); }
	$work=getTableMonth($m,$y);
	echo '<div class="calendarTitle"><a onclick="goView(\'calendar&y='.$yp.'&m='.$mp.'\')" class="prevMonth"><i class="fas fa-chevron-left"></i></a><span class="titleDate">'.translateDate(date("F",$work['unix'])).'<small>'.$work['year'].'</small></span><a onclick="goView(\'calendar&y='.$yn.'&m='.$mn.'\')" class="nextMonth"><i class="fas fa-chevron-right"></i></a></div>';
	pasteTableMonth($work,$today);