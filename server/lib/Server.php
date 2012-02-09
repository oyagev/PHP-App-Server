<?php
namespace PHAS\Lib;

use PHAS\Vendor\Thread;

class Server {
	protected $config;
	function __construct(ServerConfig $config){
		$this->config = $config;
		$this->startNewWorker();
	}
	
	function startNewWorker(){
		if( ! Thread::available() ) {
		    die( 'Threads not supported' );
		}
		$t = new Thread( '\PHAS\Lib\run' );
		$t->start($this->config);
		
 
	}
	
	static function run($config){
		$worker = new Worker($config);
	}
}

function run($config){
	$worker = new Worker($config);
}