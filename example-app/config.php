<?php
$serverConfig = array(
	'server.gearman.host' => '127.0.0.1',
	'server.tmpfolder' => '/tmp/phas',

	'app.name' => 'App Name',
	'app.script.bootstrap' => PHAS_ABSPATH.'../example-app/boot.php',
	'app.script.loop' => PHAS_ABSPATH.'../example-app/loop.php',
	
);
