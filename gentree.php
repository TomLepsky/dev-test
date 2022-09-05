<?php

use App\App;
use App\Autoloader;

define('ROOT', dirname(__FILE__));

require_once ROOT . '/App/Autoloader.php';

Autoloader::run();

App::run($argv);
