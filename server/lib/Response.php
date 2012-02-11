<?php
namespace PHAS\Lib;

class Response {
	
	public $headers = array() , $body;
	
	
	/**
	 * Enter description here ...
	 * @param string $json
	 * @return \PHAS\Lib\Response
	 */
	static function fromJSON($json){
		if (is_string($json)){
			$json = json_decode($json);
		}
		return new static((array)$json);
	}
	
	function __construct($vars = array()){
		
		foreach(get_object_vars($this) as $name=>$val){
			if (isset($vars[$name])){
				$this->$name = $vars[$name];
			}
		}
	}
	
	
	function toJSON(){
		return json_encode($this);
	}

	public function getHeaders()
	{
	    return $this->headers;
	}

	public function setHeaders($headers)
	{
	    $this->headers = $headers;
	}
	
	public function addHeader($string){
		$this->headers[]=$string;
	}

	public function getBody()
	{
	    return $this->body;
	}

	public function setBody($body)
	{
	    $this->body = $body;
	}
}