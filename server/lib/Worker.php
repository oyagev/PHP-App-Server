<?php
namespace PHAS\Lib;

class Worker{
	const 
		STATUS_BOOTING = 0,
		STATUS_ALIVE = 1,
		STATUS_TERMINATED = 2
	;
	
	protected $config,$worker,$server,$worker_id;
	function __construct(ServerConfig $config, Server $server, $worker_id){
		$this->config = $config;
		$this->server = $server;
		$this->worker_id = $worker_id;
		$this->worker = new \GearmanWorker();
		$this->worker->addServer($config->get('server.gearman.host'));
		$this->worker->addFunction('serve',array($this,'workApp'));
		
		$this->bootApp();
	}
	
	
	function bootApp(){
		$this->server->workerReportStatus($this->worker_id, self::STATUS_ALIVE);
		$app = $this->config->get('app.script.bootstrap');
		if (file_exists($app))	require_once $app;
		
		while (1)
		{
			
		 
		  $ret= $this->worker->work();
		  $this->server->workerReportCycle($this->worker_id);
		  if ($this->worker->returnCode() != GEARMAN_SUCCESS)
		    break;
		}
	}
	
	function workApp($job){
		
		
		
		try{
			$request = Request::fromJSON($job->workload());
			
			$process = new VirtualProcess($this->config, $request);
			
			
			$process->exec();
			$response = $process->getResponse();
			unset($process);
		}catch (Exception $e){
			$response = new Response();
		}
		return $response->toJSON();
	}
	
	
	
	
}
