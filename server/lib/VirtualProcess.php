<?php
namespace PHAS\Lib;

use PHAS\Lib\ServerConfig;
use PHAS\Lib\Request;
use PHAS\Lib\Response;


class VirtualProcess {
	
	static protected $current;
	
	protected $config, $request,$response;
	
	/**
	 * @return \PHAS\Lib\VirtualProcess
	 */
	static function current(){
		return self::$current;
	}
	function __construct(ServerConfig $config , Request $request){
		$this->setConfig($config)
			->setRequest($request)
			->setResponse(new Response())
		;
		
		self::$current = $this;
	}
	
	function setupEnvironment(){
		$_POST = (array)$this->request->getPost();
		$_GET = (array)$this->request->getGet();
		$_SERVER = (array)$this->request->getServer();
		$_FILES = (array)$this->request->getFiles();
		$_COOKIE = (array)$this->request->getCookie();
		$_REQUEST = array_merge($_GET,$_POST);
		
		
		
	}
	
	function exec(){
		$this->setupEnvironment();
		$app = $this->config->get('app.script.loop');
		ob_start();
		
		
		include $app;
		
		$this->getResponse()->setBody( ob_get_clean() );
		
		$this->terminate();
	}
	
	function terminate(){
		self::$current = NULL;
		
	}

	/**
	 * @return ServerConfig
	 */
	public function getConfig()
	{
	    return $this->config;
	}

	public function setConfig($config)
	{
	    $this->config = $config;
	    return $this;
	}

	/**
	 * @return Request
	 */
	public function getRequest()
	{
	    return $this->request;
	}

	public function setRequest($request)
	{
	    $this->request = $request;
	    return $this;
	}

	/**
	 * @return Response
	 */
	public function getResponse()
	{
	    return $this->response;
	}

	public function setResponse($response)
	{
	    $this->response = $response;
	    return $this;
	}
}