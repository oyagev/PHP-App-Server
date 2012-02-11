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
		
		$request = new Request(array(
			'post' => $_POST,
			'get' => $_GET,
			'server' => $_SERVER,
			'cookie' => $_COOKIE,
			'files' => $_FILES,		
		));
		
		
		$result = $this->client->do('serve',$request->toJSON());
		$response = Response::fromJSON($result);
		$headers = $response->getHeaders();
		foreach($headers as $header){
			header($header);
		}
		return $response->getBody();
		
	}
	
}