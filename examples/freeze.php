<?php

$new_time = isset($_GET['time'])?strtotime($_GET['time']):0;

var_dump(date('Y-m-d H:i:s')); // todays date

Timecop::freeze($new_time);

var_dump(date('Y-m-d H:i:s'));

