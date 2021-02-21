<?php
	// LANG FILE - ENGLISH
	function translateDate($txt){
		return $txt;
	}
	function translateText($txt){
		switch($txt){
			case 'NODATA':
				return "No data found.";
			break;
			case 'NOMAIL':
				return "No new email.";
			break;
			case 'NEWMAIL':
				return "new email";
			break;
			case 'NEWMAILS':
				return "new emails";
			break;
			case 'MAIL':
				return "email";
			break;
			case 'MAILS':
				return "emails";
			break;
			case 'TODAY':
				return "Today";
			break;
			case 'FORECAST':
				return "Forecast";
			break;
			case 'POWEROFF':
				return "Shutdown the Dashboard, goodbye!";
			break;
			case 'REBOOT':
				return "Rebooting the Dashboard, I come back shortly!";
			break;
			case 'TIME_MIDNIGHT':
				return "It is currently midnight.";
			break;
			case 'TIME_ONEHOUR':
				return "It is currently one o'clock.";
			break;
			case 'TIME_DINER':
				return "It is currently noon.";
			break;
			case 'TIME_CURRENT':
				return "The time is now %HOUR% o'clock.";
			break;
			case 'MAIL_YOUHAVEXNEW':
				return "You have %UNREAD% new email.";
			break;
			case 'TIME_YOUARENOW':
				return "We made it on";
			break;
			case 'MAIL_ERRORGET':
				return "Impossible to retrieve emails.";
			break;
			case 'MAIL_NOMAIL':
				return "You have no mail.";
			break;
			default:
				return "";
		}
	}