<?php
/**
 * ������ ����� ������� ��. start_timing.php
 *
 */

// ������ ������ �����
$t2 = microtime();
$t2 = explode(' ', $t2);
$t2 = $t2[1] + $t2[0];

// ������ �������
$dif = $t2 - $t1;
require_once 'lib/v/viewer.php';
Viewer::echoCreatePgeTime($dif);