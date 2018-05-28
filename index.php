<!DOCTYPE html>
<?php

$functions = ['freeze', 'return', 'scale', 'travel'];
$time = isset($_GET['time'])?$_GET['time']:'1970-01-01 00:00:00';
$url = htmlspecialchars((isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'], ENT_QUOTES, 'UTF-8');

?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TimeCop</title>

    <link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGgAAABoBAMAAADvMqiSAAAAGFBMVEVHcEw6mVXgR1IDBgM0f0e+QUgfUy6DST/kPdT8AAAAAXRSTlMAQObYZgAAAaxJREFUWMPtmMFqwzAMhjUyehc1eQBfdjUo9DxT0/NwS3vtcMkbjL3+gDWxk9mO7YUujPyUYpd8yFIVIwkgJM3fIFsrlANt1EAHzc/uvvUyN6WkYkx2X5qf7N5P3SRKdMU0Pw1+QHUdMzjWTwjxdcA8YxLEBrZkGoR13JAfwmvUUADa22hjMsSipwtA9nxPJdB7BrSPxSEE9UHHHEhEgjcrxCgS8RCEj4NMkSVRYukXkJN6rLXS/Nyvo1BNVpof+3Xckh/azQ/VRPc/DyrNj11GT1ry3eWbCUjkQ3UJxJYNrT4t2CfnjjgkQ41TpgReDadyMSQAeIGWDl0un0Nd7uL8pVuOnvgAgEYyvH9CaaT6J5ihNctXn1af/odPbdeQbTQ/p13LiEx5Sjc5U723VIgeDWX2GgVQn9JFUE6ntu2grJ6wBDIdlNPn9jVDTkdtC4303n1roSYZMvbVrpLnEeTcB03i5MM4tRNUaTMWQy4EdJOTEDPkng6gol2rYpBSLdHQEEBFRDsyjjQ/utvv9ksMJ0c0ltsTdhLjGVUCJDzjsAlITA/h3J7w74aCXwzSsw37s73BAAAAAElFTkSuQmCC">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>

    <style>
        h1 img {
            height: 20vh;
            min-height: 4em;
        }
        .message-body pre {
            background-color: #f5f5f5;
        }
        .xdebug-var-dump {
            padding: 0;
        }
    </style>
</head>
<body>
<?php
    $enabled = class_exists('Timecop');
?>
<?php if ($enabled === false) : ?>
    <header class="hero has-text-centered">
        <div class="hero-body">
            <h1 class="title">PHP TimeCop is not (yet) enabled</h1>
            <p class="subtitle">Please contact your favorite sysops person to discuss how PHP TimeCop can be enabled for you!</p>
        </div>
    </header>
<?php else: ?>
    <header class="hero has-text-centered">
        <div class="hero-body">
            <h1 class="title">
                <img alt="PHP TimeCop Logo" src="data:image/png;base64,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"/>
            </h1>

            <blockquote class="subtitle">
                <p><em>&quot;There is never enough time.&quot;</em> ~ Max Walker</p>
            </blockquote>
        </div>
    </header>

    <section class="section">
        <article class="container">

            <div class="message">
                <h2 class="message-header title is-5">Introduction</h2>
                <div class="message-body">
                    <p>
                        The <a href="https://github.com/hnw/php-timecop">php-timecop</a> PHP extension
                        makes it possible to manipulate time as experienced by the PHP runtime.
                    </p>

                    <p>It provides "time travel" and "time freezing" capabilities.</p>

                    <p>This can be very useful when testing code that has time-sensitive functionality.</p>

                    <p>This project offers examples demonstrating how PHP TimeCop works.</p>
                </div>
            </div>

            <div class="message">
                <h2 class="message-header title is-5">Usage</h2>
                <div class="message-body">
                    <ol>
                        <li><a href="https://github.com/hnw/php-timecop#install-with-package-manager">Install php-timecop</a> on a PHP server of your choice.</li>
                        <li>Clone this repository to the same server.</li>
                        <li>Visit the <code>index.php</code> in a web browser.</li>
                        <li>Study the provided examples and their output.</li>
                        <li>...</li>
                        <li><a href="http://knowyourmeme.com/memes/profit">Profit!</a></li>
                    </ol>
                </div>
            </div>

            <div class="message">
                <h2 class="message-header title is-5">Features</h2>
                <div class="message-body">
                    <p>PHP TimeCop offers four functions to manipulate time.</p>
                    <br/>
                    <p>For the static class method a regular function is also available (execept for `return` as that is a reserved word in PHP):</p>

                    <ul>
                        <li><code>TimeCop::freeze($new_time)</code>  / <code>timecop_freeze($new_time)</code></li>
                        <li><code>timecop_return()</code></li>
                        <li><code>TimeCop::scale($scaling_factor)</code>  / <code>timecop_scale($scaling_factor)</code></li>
                        <li><code>TimeCop::travel($new_time)</code>  / <code>timecop_travel($new_time)</code></li>
                    </ul>

                    <br/>
                    <div class="box">
                        <h3 class="title">Freeze</h3>
                        <p>
                            Used to statically mock the concept of "now".
                        </p>
                        <p>
                            As the PHP runtime executes, <code>time()</code> will not change unless subsequent calls to freeze/return/scale/travel are made.
                        </p>
                    </div>
                    <div class="box">
                        <h3 class="title">Return</h3>
                        <p>Return the system to a normal state. Effectively "turn off" php-timecop</p>
                    </div>
                    <div class="box">
                        <h3 class="title">Scale</h3>
                        <p>
                            Make time move at an accelerated pace. With this function, long time spans can be emulated in a shorter time.
                        </p>
                    </div>
                    <div class="box">
                        <h3 class="title">Travel</h3>
                        <p>
                            Computes an offset between the currently think <code>time()</code> and the time passed in.
                            It uses this offset to simulate the passage of time.
                        </p>
                    </div>
                </div>
            </div>

            <div class="message">
                <h2 class="message-header title is-5">Examples</h2>
                <div class="message-body">
                    <form action="" method="get">
                        <label class="label">The result of these examples can be seen below. The results can be altered by providing a time:</label>
                        <div class="field has-addons">
                            <div class="control">
                                <a class="button is-static">
                                    <?=$url?>?time=
                                </a>
                            </div>
                            <div class="control is-expanded">
                                <input class="input" name="time" type="datetime-local" value="<?=date('Y-m-d\\TH:i:s', strtotime($time));?>" placeholder="1970-01-01 00:00:00"/>
                            </div>

                            <div class="control">
                                <button class="button is-info">Submit</button>
                            </div>

                        </div>
                    </form>

                    <br/>
                    <?php foreach($functions as $function): ?>
                        <div class="box">
                            <h3 class="title"><?= ucfirst($function)?></h3>
                            <pre><code class="php"><?= htmlentities(file_get_contents(__DIR__.'/examples/'.$function.'.php'))?></code></pre>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>

            <div class="message">
                <h2 class="message-header title is-5">Example Output</h2>
                <div class="message-body">
                    <p>
                        Below is the output of the examples mentioned above.
                    </p>
                    <?php foreach($functions as $function): ?>
                        <div class="box">
                            <h3 class="title"><?= ucfirst($function)?></h3>
                            <?php require __DIR__.'/examples/'.$function.'.php' ?>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>

        </article>
    </section>
    <script>hljs.initHighlightingOnLoad();</script>
<?php endif;?>
</body>
</html>
