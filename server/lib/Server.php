<?php
namespace PHAS\Lib;

use PHAS\Vendor\Thread;

class Server {
	protected $config;
	protected $workers = array(),$workersStats=array(), $workersCount = 0;
	
	
	function __construct(ServerConfig $config){
		$this->config = $config;
		$this->startNewWorker();
		$this->startNewWorker();
		$this->startNewWorker();
		$this->run($config);
	}
	
	function startNewWorker(){
		if( ! Thread::available() ) {
		    die( 'Threads not supported' );
		}
		$t = new Thread( 'PHAS\Lib\Server\runWorker' );
		
		$this->workers[$this->workersCount] = $t;
		$this->workersStats[$this->workersCount] = array(
			'status' => Worker::STATUS_BOOTING,
			'cycles_count' => 0,
			'time_pending' => 0,
			'time_started' => 0
		);
		
		$t->start($this->config,$this, $this->workersCount++);
		
		
 
	}
	
	
	
	function run($config){
		//$worker = new Worker($config);
		while(1){
			sleep(1);
		}
	}
	
	
	function workerReportStatus($worker_id, $status){
		$tmp = $this->config->get('server.tmpfolder');
		switch($status){
			case Worker::STATUS_ALIVE :
				`echo -n > {$tmp}/worker_{$worker_id}`;
				break;
			case Worker::STATUS_TERMINATED :
				`rm -f {$tmp}/worker_{$worker_id}`;
		}
		
	}
	function workerReportCycle($worker_id){
		$time = microtime(true);
		$tmp = $this->config->get('server.tmpfolder');
		`echo $time >> {$tmp}/worker_{$worker_id}`;
	}
}

namespace PHAS\Lib\Server;

use PHAS\Lib\Worker;

function runWorker($config,$server,$worker_id){
	$worker = new Worker($config,$server,$worker_id);
}