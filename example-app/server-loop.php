<?php

use PHAS\Lib\ServerConfig;
use PHAS\Lib\Server;

require_once __DIR__.'/../server/bootstrap.php';

require_once 'config.php';
$config = new ServerConfig($serverConfig);

new Server($config);