<?php

use MVar\Apache2LogParser\ErrorLogParser;

class MyLogParser extends ErrorLogParser {

	protected function getPattern()
	{
		$pattern = '/\[(?<time>.+)\] \[(?<error_level>.+)\] \[pid\ (?<pid>.+)].+\[client (?<client_ip>.+)] (?<message>.+(?=, referer)|.+)(, referer: (?<referer>.+))?/';
		$pattern = '/\[(?<time>.+?)\] \[(?<error_level>.+?)\]( \[pid\ (?<pid>.+)])?.+\[client (?<client_ip>.+)] (?<message>.+(?=, referer)|.+)(, referer: (?<referer>.+))?/';

		return $pattern;
	}

}
