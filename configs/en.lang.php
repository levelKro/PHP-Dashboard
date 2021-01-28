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
			default:
				return "";
		}
	}