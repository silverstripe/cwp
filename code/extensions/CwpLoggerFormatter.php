<?php
class CwpLoggerFormatter extends SS_LogErrorFileFormatter {

	protected function getClientIP() {
		$ipaddress = '';
		if(@$_SERVER['HTTP_CLIENT_IP']) $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		elseif(@$_SERVER['HTTP_X_FORWARDED_FOR']) $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		elseif(@$_SERVER['HTTP_X_FORWARDED']) $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		elseif(@$_SERVER['HTTP_FORWARDED_FOR']) $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		elseif(@$_SERVER['HTTP_FORWARDED']) $ipaddress = $_SERVER['HTTP_FORWARDED'];
		elseif(@$_SERVER['REMOTE_ADDR']) $ipaddress = $_SERVER['REMOTE_ADDR'];
		else $ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

	public function format($event) {
		return sprintf('%s %s', $this->getClientIP(), $event['message']['errstr']) . PHP_EOL;
	}

}
