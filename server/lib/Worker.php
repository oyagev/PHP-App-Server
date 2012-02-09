<?php
namespace PHAS\Lib;

class Worker{
	protected $config,$worker;
	function __construct(ServerConfig $config){
		$this->config = $config;
		$this->worker = new \GearmanWorker();
		$this->worker->addServer($config->get('server.gearman.host'));
		$this->worker->addFunction('serve',array($this,'workApp'));
		$this->bootApp();
	}
	
	
	function bootApp(){
		$app = $this->config->get('app.script.bootstrap');
		if (file_exists($app))	require_once $app;
		
		while (1)
		{
		 
		 
		  $ret= $this->worker->work();
		  if ($this->worker->returnCode() != GEARMAN_SUCCESS)
		    break;
		}
	}
	
	function workApp($job){
		
		
		
		$params = json_decode($job->workload());
		$_POST = (array)$params->post;
		$_GET = (array)$params->get;
		$_SERVER = (array)$params->server;
		$_REQUEST = array_merge($_GET,$_POST);
		
		
		$app = $this->config->get('app.script.loop');
		ob_start();
		
		
		include $app;
		
		$buff = ob_get_clean();
		
		return $buff;
	}
	
	
	
	
}
