<?php
namespace PHAS;

use PHAS\Lib\Server;

use PHAS\Lib\ServerConfig;



define('PHAS_ABSPATH',__DIR__.'/');
define('PHAS_CONFIG_PATH',PHAS_ABSPATH.'config/');
define('PHAS_LIB_PATH',PHAS_ABSPATH.'lib/');
define('PHAS_VENDOR_PATH',PHAS_ABSPATH.'vendor/');

function autoload($name){
	$file = false;
	if (strpos($name, 'PHAS\\Lib\\')===0){
		$file = PHAS_LIB_PATH . str_replace('PHAS\\Lib\\', '', $name).'.php';
	}elseif(strpos($name, 'PHAS\\Vendor\\')===0){
		$file = PHAS_VENDOR_PATH . str_replace('PHAS\\Vendor\\', '', $name).'.php';
	}
	
	if ($file && file_exists($file)){
		require_once $file;
	}
}
spl_autoload_register('PHAS\autoload');

require_once(PHAS_CONFIG_PATH.'server.php');
$config = new ServerConfig($serverConfig);



