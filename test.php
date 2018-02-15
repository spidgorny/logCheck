<?php

$str = 'Fri Jan 05 13:30:21.729539 2018';

$time = DateTime::createFromFormat('D M d H:i:s.u Y', $str);
echo $time->format('Y-m-d H:i:s.u');
