![PHP TimeCop Logo](logo-timecop.png)

> _"There is never enough time."_
> ~ Max Walker

[![Remix on Glitch](https://cdn.glitch.com/2703baf2-b643-4da7-ab91-7ee2a2d00b5b/remix-button.svg)](https://glitch.com/edit/#!/remix/php-timecop)

## Introduction

The [php-timecop](https://github.com/hnw/php-timecop) PHP extension
makes it possible to manipulate time as experienced by the PHP runtime.

It provides "time travel" and "time freezing" capabilities.

This can be very useful when testing code that has time-sensitive functionality.

This project offers examples demonstrating how PHP TimeCop works.

It can be seen in action at https://php-timecop.glitch.me/

To play around with it, [remix this project on Glitch](https://glitch.com/edit/#!/remix/php-timecop).

## Usage

1. [Install php-timecop](https://github.com/hnw/php-timecop#install-with-package-manager) on a PHP server of your choice.
2. Clone this repository to the same server.
3. Visit the `index.php` in a web browser.
4. Study the provided examples and their output.
5. ...
6. [Profit!](http://knowyourmeme.com/memes/profit)

## Features

PHP TimeCop offers four functions to manipulate time.

For the static class method a regular function is also available (execept for `return` as that is a reserved word in PHP):

-   `TimeCop::freeze($new_time)` / `timecop_freeze($new_time)`
-   `timecop_return()`
-   `TimeCop::scale($scaling_factor)` / `timecop_scale($scaling_factor)`
-   `TimeCop::travel($new_time)` / `timecop_travel($new_time)`

### Freeze

Used to statically mock the concept of "now".

As the PHP runtime executes, `time()` will not change unless subsequent calls to freeze/return/scale/travel are made.

### Return

Return the system to a normal state. Effectively "turn off" php-timecop

### Scale

Make time move at an accelerated pace. With this function, long time spans can be emulated in a shorter time.

### Travel

Computes an offset between the currently think `time()` and the time passed in. It uses this offset to simulate the passage of time.

## Examples

The result of these examples can be seen below.

### Freeze

```php
<?php
$new_time = isset($_GET['time'])?strtotime($_GET['time']):0;
var_dump(date('Y-m-d H:i:s')); // todays date
Timecop::freeze($new_time);
var_dump(date('Y-m-d H:i:s'));
```

### Return

```php
<?php
$new_time = isset($_GET['time'])?strtotime($_GET['time']):0;
Timecop::freeze($new_time);
sleep(1);
var_dump(date('Y-m-d H:i:s'));
timecop_return(); // "turn off" php-timecop
sleep(1);
var_dump(date('Y-m-d H:i:s'));
```

### Scale

```php
<?php
$new_time = isset($_GET['time'])?strtotime($_GET['time']):0;
Timecop::freeze(new DateTime('@' . $new_time));
var_dump((new DateTime())->format('Y-m-d H:i:s'));
Timecop::scale(86400); // time passes at one day per second
sleep(1);
var_dump((new DateTime())->format('Y-m-d H:i:s'));
sleep(1);
var_dump((new DateTime())->format('Y-m-d H:i:s'));
```

### Travel

```php
<?php
$new_time = isset($_GET['time'])?strtotime($_GET['time']):0;
Timecop::freeze($new_time);
var_dump(date('Y-m-d H:i:s'));
sleep(1);
var_dump(date('Y-m-d H:i:s'));
Timecop::travel($new_time);
sleep(1);
var_dump(date('Y-m-d H:i:s'));
```

## Example Output

Below is the output of the examples mentioned above.

### Freeze

```
string '2018-05-24 16:41:29' (length=19)
string '2008-07-31 00:00:00' (length=19)
```

### Return

```
string '2008-07-31 00:00:00' (length=19)
string '2018-05-24 16:41:31' (length=19)
```

### Scale

```
string '2008-07-31 00:00:00' (length=19)
string '2008-08-01 00:00:11' (length=19)
string '2008-08-02 00:00:37' (length=19)
```

### Travel

```
string '2008-07-31 00:00:00' (length=19)
string '2008-07-31 00:00:00' (length=19)
string '2008-08-01 00:00:12' (length=19)
```
