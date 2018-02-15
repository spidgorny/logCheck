<?php

require_once __DIR__.'/vendor/autoload.php';

//(new LogCheck('/var/log/apache2/dci.nintendo.de-error_log'))
(new LogCheck('php://stdin'))
	->filter('open files')
//	->filter('sslmode')
	->groupByDay()
	->render();
