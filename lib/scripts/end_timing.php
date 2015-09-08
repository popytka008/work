<?php
/**
 * вторая часть скрипта см. start_timing.php
 * вычисляет точку 2 во временном интервале t2
 * вычисляет разницу t2 - t1,
 * передает результат Видеопроектору
 */
$t2 = microtime(true) - $t1;

(new Viewer())->echoCreatePgeTime($t2);