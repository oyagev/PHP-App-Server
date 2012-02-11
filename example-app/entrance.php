<?php

use PHAS\Lib\ServerConfig;
use PHAS\Lib\Entrance;

require_once __DIR__.'/../server/bootstrap.php';

require_once 'config.php';
$config = new ServerConfig($serverConfig);


$entrance = new Entrance($config);
echo $entrance->go();

