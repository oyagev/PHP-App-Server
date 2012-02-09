<?php

use PHAS\Lib\Entrance;
require_once 'bootstrap.php';

$entrance = new Entrance($config);
echo $entrance->go();

