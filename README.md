## Usage

```xzcat -f /var/log/apache2/dci.nintendo.de-error_log* | php www/slawa/logCheck/lc.php```

```{ zcat /var/log/apache2/dci.nintendo.de-error_log* ; cat /var/log/apache2/dci.nintendo.de-error_log ; } | php www/slawa/logCheck/lc.php```

```{ xzcat /var/log/apache2/dci.nintendo.de-error_log* ; cat /var/log/apache2/dci.nintendo.de-error_log ; } | grep "open files" | php www/slawa/logCheck/lc.php```

## Code in lc.php

```
(new LogCheck('php://stdin'))
	->filter('open files')
	->groupByDay()
	->render();
```

## Result

```
LogSet 2016-10-13: [2]
LogSet 2017-07-21: [1]
LogSet 2017-07-25: [31]
LogSet 2017-07-26: [13]
LogSet 2017-08-14: [2]
LogSet 2017-09-06: [2]
LogSet 2017-09-07: [1]
LogSet 2017-10-05: [2]
LogSet 2017-10-27: [2]
LogSet 2017-11-02: [1]
LogSet 2017-11-03: [3]
LogSet 2017-11-08: [1]
LogSet 2017-11-28: [2]
LogSet 2017-12-01: [1]
LogSet 2017-12-05: [3]
LogSet 2017-12-08: [235]
LogSet 2018-01-04: [1]
LogSet 2018-01-23: [6]
LogSet 2018-01-24: [6]
LogSet 2018-01-30: [16]
LogSet 2018-02-12: [29]
LogSet 2018-02-13: [4]
```
