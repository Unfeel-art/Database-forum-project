<?php
$logFile = '../../logs/logs.txt';
$ip = $_SERVER['REMOTE_ADDR'];
$page = $_SERVER['REQUEST_URI'];
$browser = $_SERVER['HTTP_USER_AGENT'];
$time = date('Y-m-d H:i:s');
$log = "$time | $ip | $page | $browser\n";
file_put_contents($logFile, $log, FILE_APPEND);
?>