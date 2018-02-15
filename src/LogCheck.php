<?php

use MVar\LogParser\LogIterator;

class LogCheck {

	var $logFile;

	var $parser;

	var $filter;

	var $log = true;

	/**
	 * @var callable[]
	 */
	var $actionList = [];

	function __construct($logFile)
	{
		$this->logFile = $logFile;
		$this->parser = new MyLogParser();
		// will choke on the date format we use
//		$this->parser->setTimeFormat(true);
	}

	function filter($text)
	{
		$this->filter = $text;
		return $this;
	}

	function groupByDay()
	{
		$this->actionList[] = [$this, 'groupByDayAction'];
		return $this;
	}

	function render()
	{
		$logIterator = new LogIterator($this->logFile, $this->parser);
		foreach ($logIterator as $line => $data) {
			if ($data) {
				$log = new Log($data);
				if ($log->filter($this->filter)) {
					$this->process($log);
				}
			} else {
				echo '===== ERROR =====', PHP_EOL;
				echo $line, PHP_EOL;
				break;
			}
		}
	}

	function process(Log $log)
	{
		$result = $log;
		foreach ($this->actionList as $function) {
			try {
				$result = $function($log);
			} catch (InvalidArgumentException $e) {
				return;
			}
		}
		if ($result && $this->log) {
			$result->log();
		}
	}

	function groupByDayAction(Log $log)
	{
		static $dayLog = [];
		static $today;

//		echo ' == ',
//			$today instanceof DateTime ? $today->format('Y-m-d') : $today,
//			"\t", $log->getDate()->format('Y-m-d'), PHP_EOL;

		if (!$today) {
			// first time
			$today = $log->getDate();
		} elseif ($today != $log->getDate()) {
			$return = new LogSet($today, $dayLog);

			$today = $log->getDate();
			$dayLog = [];
			$dayLog[] = $log;
			return $return;
		} else {
			$dayLog[] = $log;
			return null;
		}
	}

}
