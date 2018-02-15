<?php

class Log {

	var $time;
	var $error_level;
	var $pid;
	var $client_ip;
	var $message;
	var $referer;

	function __construct(array $data)
	{
		foreach ($data as $key => $val) {
			$this->$key = $val;
		}
	}

	function filter($text)
	{
		return preg_match('/'.preg_quote($text).'/', $this->message);
	}

	function getDateTime()
	{
		$ok = DateTime::createFromFormat('D M d H:i:s.u Y', $this->time);
		if (!$ok) {
			throw new InvalidArgumentException($this->time);
		}
		return $ok;
	}

	function getDate()
	{
		$copy = clone $this->getDateTime();
		return $copy->setTime(0, 0, 0);
	}

	function log()
	{
		//echo implode("\t", (array)$this), PHP_EOL;
		print_r($this);
	}

}
