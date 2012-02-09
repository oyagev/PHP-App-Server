<?php
var_dump($_GET,$_POST,$_SERVER);
$u = new User();
var_dump($u);
echo memory_get_usage(true);