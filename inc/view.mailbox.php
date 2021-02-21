<?php
	// DASHBOARD
	if(!isset($cfg) || !is_array($cfg)) die("");
	
	if($cfg['speak']['enable']) speak($cfg['cache'],$view['title'],$cfg['speak']['lang']);
	echo '<h1>'.$view['title'].'</h1>';
	$mbox = imap_open('{'.$view['host'].':'.$view['port'].'/imap/ssl/novalidate-cert}INBOX', $view['user'], $view['pass']);
	if(empty($mbox)) {
		echo '<p class="message red">'.imap_last_error().'</p>';
		if($cfg['speak']['enable']) speak($cfg['cache'],translateText("MAIL_ERRORGET"),$cfg['speak']['lang']);
	}
	else {
		$unread=imap_search($mbox, 'UNSEEN');
		if(empty($unread)) $unread=array();
		if($mail = imap_check($mbox)){
			if($mail->Nmsgs==0) {
				echo '<p class="message orange">'.translateText("NOMAIL").'</p>';
				if($cfg['speak']['enable']) speak($cfg['cache'],translateText("MAIL_NOMAIL"),$cfg['speak']['lang']);
			}
			else {
				echo '<div class="mailCount"><span class="unread">'.count($unread).'</span>/<span class="total">'.$mail->Nmsgs.'</span> '.(($mail->Nmsgs<=1)?translateText("MAIL"):translateText("MAILS")).'</div>';
				if(count($unread)>=1){
					echo '<h3>'.count($unread).((count($unread)<=1)?translateText("NEWMAIL"):translateText("NEWMAILS")).'</h3><ul style="width:90%;">';
					if($view['reorder']==true) rsort($unread);
					foreach($unread as $unread_id) {
						$overview = imap_fetch_overview($mbox,$unread_id,0);
						echo '<li><marquee class="mailSubject">'.((strlen(imap_utf8($overview[0]->subject))>250)?substr(imap_utf8($overview[0]->subject),0,250).'...':imap_utf8($overview[0]->subject)).'</marquee>
						<div class="mailInfo"><span class="mailFrom">'.$overview[0]->from.'</span> - <span class="mailDate">'.translateDate(date("l, j F, Y - H:i",strtotime($overview[0]->date))).'</span></div></li>';
					}
					echo '</ul>';
					if($cfg['speak']['enable']) speak($cfg['cache'],str_replace("%UNREAD%",count($unread),translateText("MAIL_YOUHAVEXNEW")),$cfg['speak']['lang']);
				}
				else{
					echo '<p class="message orange">'.translateText("NOMAIL").'</p>';
					if($cfg['speak']['enable']) speak($cfg['cache'],translateText("MAIL_NOMAIL"),$cfg['speak']['lang']);
				}
			}
		}
		else {
			echo '<p class="message red">'.imap_last_error().'</p>';
			if($cfg['speak']['enable']) speak($cfg['cache'],translateText("MAIL_ERRORGET"),$cfg['speak']['lang']);
		}
	}
	imap_close($mbox);
	echo '</div><link rel="stylesheet" href="inc/mailbox.css">';