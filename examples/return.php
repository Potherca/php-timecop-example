<?php

$new_time = isset($_GET['time'])?strtotime($_GET['time']):0;

Timecop::freeze($new_time);

sleep(1);

var_dump(date('Y-m-d H:i:s'));

timecop_return(); // "turn off" php-timecop

sleep(1);

var_dump(date('Y-m-d H:i:s'));
