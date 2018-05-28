<?php

$new_time = isset($_GET['time'])?strtotime($_GET['time']):0;

Timecop::freeze($new_time);

var_dump(date('Y-m-d H:i:s'));

sleep(1);

var_dump(date('Y-m-d H:i:s'));

Timecop::travel($new_time);

sleep(1);

var_dump(date('Y-m-d H:i:s'));
