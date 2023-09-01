<?php

use CloudCrm\sites\TestIP;

$loader = require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/index.php';

(new TestIP())->start();