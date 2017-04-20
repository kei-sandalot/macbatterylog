<?php
date_default_timezone_set('Asia/Tokyo');

$data = array();

$data[] = date('Y-m-d G:i');
$data[] = explode('=', shell_exec('ioreg -l | grep MaxCapacity'))[1];
$data[] = explode('=', shell_exec('ioreg -l | grep CurrentCapacity'))[1];
$data[] = explode('=', shell_exec('ioreg -l | grep DesignCapacity'))[1];
$data[] = explode('=', shell_exec('ioreg -l | grep CycleCount | grep -v Design'))[1];

echo implode(",", array_map('trim', $data)) . PHP_EOL;
