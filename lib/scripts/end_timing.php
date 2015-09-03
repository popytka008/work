<?php
/**
 * вторая часть скрипта см. start_timing.php
 *
 */

// засечь второе время
$t2 = microtime();
$t2 = explode(' ', $t2);
$t2 = $t2[1] + $t2[0];

// узнать разницу
$dif = $t2 - $t1;
require_once 'lib/v/viewer.php';
Viewer::echoCreatePgeTime($dif);