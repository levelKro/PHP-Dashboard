<?php
	// DASHBOARD
	if(!isset($cfg) || !is_array($cfg)) die("");
	echo '<h1>'.$view['title'].'</h1>';
	$mbox = imap_open('{'.$view['host'].':'.$view['port'].'/imap/ssl/novalidate-cert}INBOX', $view['user'], $view['pass']);
	if(empty($mbox)) echo '<p class="message red">'.imap_last_error().'</p>';
	else {
		$unread=imap_search($mbox, 'UNSEEN');
		if(empty($unread)) $unread=array();
		if($mail = imap_check($mbox)){
			if($mail->Nmsgs==0) echo '<p class="message orange">'.translateText("NOMAIL").'</p>';
			else {
				echo '<div class="mailCount"><span class="unread">'.count($unread).'</span>/<span class="total">'.$mail->Nmsgs.'</span> '.(($mail->Nmsgs<=1)?translateText("MAIL"):translateText("MAILS")).'</div>';
				if(count($unread)>=1){
					echo '<h3>'.((count($unread)<=1)?translateText("NEWMAIL"):translateText("NEWMAILS")).'</h3><ul style="width:90%;">';
					if($view['reorder']==true) rsort($unread);
					foreach($unread as $unread_id) {
						$overview = imap_fetch_overview($mbox,$unread_id,0);
						echo '<li><span class="mailSubject">'.((strlen(imap_utf8($overview[0]->subject))>80)?substr(imap_utf8($overview[0]->subject),0,80).'...':imap_utf8($overview[0]->subject)).'</span>
						<div class="mailInfo"><span class="mailFrom">'.$overview[0]->from.'</span> - <span class="mailDate">'.translateDate(date("l, j F, Y - H:i",strtotime($overview[0]->date))).'</span></div></li>';
					}
					echo '</ul>';
				}
				else{
					echo '<p class="message orange">'.translateText("NOMAIL").'</p>';
				}
			}
		}
		else {
			echo '<p class="message red">'.imap_last_error().'</p>';
		}
	}
	imap_close($mbox);
	echo '</div>';