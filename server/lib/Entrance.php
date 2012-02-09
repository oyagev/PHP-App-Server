<?php

namespace PHAS\Lib;

class Entrance{
	protected $config,$client;
	function __construct(ServerConfig $config){
		$this->config = $config;
		$this->client= new \GearmanClient();
 
		# Add default server (localhost).
		$this->client->addServer($config->get('server.gearman.host'));
		
	}
	
	function go(){
		$params = json_encode(array(
			'post' => $_POST,
			'get' => $_GET,
			'server' => $_SERVER,
			'cookie' => $_COOKIE,
			'files' => $_FILES,		
		));
		
		return $result = $this->client->do('serve',$params);
		
	}
	
}