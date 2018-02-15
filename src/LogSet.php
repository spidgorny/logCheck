<?php

class LogSet {

	var $key;
	var $logs = [];

	function __construct($key, array $set)
	{
		$this->key = $key;
		$this->logs = $set;
	}

	function log()
	{
		$key = $this->key;
		if ($key instanceof DateTime) {
			$key = $key->format('Y-m-d');
		}
		echo __CLASS__.' '. $key .': ['.sizeof($this->logs).']', PHP_EOL;
	}

}
