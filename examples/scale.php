<?php

$new_time = isset($_GET['time'])?strtotime($_GET['time']):0;

Timecop::freeze(new DateTime('@' . $new_time));

var_dump((new DateTime())->format('Y-m-d H:i:s'));

Timecop::scale(86400); // time passes at one day per second

sleep(1);

var_dump((new DateTime())->format('Y-m-d H:i:s'));

sleep(1);

var_dump((new DateTime())->format('Y-m-d H:i:s'));
